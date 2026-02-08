# PHP Router - Understanding How It Works

## 🎯 What is a Router?

A **router** is like a traffic director for your website. When someone visits a URL, the router decides which code (controller) should handle that request.

**Without a router:** You'd need separate PHP files for each page (index.php, about.php, contact.php)
**With a router:** One entry point (index.php) directs all requests to the right controller

---

## 📁 File Structure

```
php-router/
├── .htaccess           # Redirects all requests to index.php
├── index.php           # Entry point - receives ALL requests
├── Router.php          # Router class - the brain of routing
├── routes.php          # Route definitions - your URL map
├── functions.php       # Helper functions
├── controllers/        # Controllers - handle business logic
│   ├── index.php
│   ├── about.php
│   └── contact.php
└── views/             # Views - HTML templates
    ├── index.view.php
    ├── about.view.php
    ├── contact.view.php
    └── 404.view.php
```

---

## 🔄 The Request Flow

Let's trace what happens when someone visits `http://localhost/learning-php-and-laravel/php-for-beginners/dynamic-web-applications/php-router/about`:

### Step 1: .htaccess (Traffic Director)
```apache
RewriteEngine On
RewriteCond %{REQUEST_FILENAME} !-f    # If not a real file
RewriteCond %{REQUEST_FILENAME} !-d    # If not a real directory
RewriteRule ^ index.php [L]            # Send to index.php
```

**What it does:** 
- Intercepts ALL requests
- If the URL isn't a real file or folder, send it to `index.php`
- This is how `/about` gets handled by `index.php` instead of looking for `about.php`

### Step 2: index.php (Entry Point)
```php
<?php

require 'functions.php';
require 'Router.php';

// Define base path for this project
define('BASE_PATH', '/learning-php-and-laravel/php-for-beginners/dynamic-web-applications/php-router');

$router = new Router();        // Create router instance

require 'routes.php';          // Load route definitions

$uri = parse_url($_SERVER['REQUEST_URI'])['path'];  // Get path
$method = $_SERVER['REQUEST_METHOD'];               // Get method: GET

$router->route($uri, $method); // Match and execute
```

**What it does:**
- Defines `BASE_PATH` constant (the folder path on your server)
- Creates a `Router` object
- Loads all route definitions from `routes.php`
- Extracts the path and HTTP method (`GET`)
- Tells the router to find and execute the matching route

**Why `parse_url()`?**
```php
// Without parse_url:
$_SERVER['REQUEST_URI'] = '/about?name=john&age=25'

// With parse_url:
parse_url($_SERVER['REQUEST_URI'])['path'] = '/about'  // Clean!
```

**Why BASE_PATH?**
When you deploy to a subdirectory (like `/learning-php-and-laravel/...`), you need to handle the full path. `BASE_PATH` makes routes cleaner:

```php
// Instead of writing:
$router->get('/learning-php-and-laravel/.../about', 'controllers/about.php');

// You write:
$router->get('/about', 'controllers/about.php');
// The Router automatically adds BASE_PATH!
```

### Step 3: routes.php (The Map)
```php
<?php

// Clean, simple routes - BASE_PATH is automatically added!
$router->get('/', 'controllers/index.php');
$router->get('/about', 'controllers/about.php');
$router->get('/contact', 'controllers/contact.php');
```

**What it does:**
- Defines all available routes with clean URLs
- Maps URLs to controller files
- Specifies HTTP methods (GET, POST, etc.)
- Router class automatically adds `BASE_PATH` to each route

**Think of it like:** A restaurant menu - it lists what's available and where to get it

### Step 4: Router.php (The Brain)
```php
class Router
{
    protected $routes = [];  // Storage for all routes

    // Register a route with automatic BASE_PATH handling
    public function add($method, $uri, $controller)
    {
        // Automatically prepend BASE_PATH if defined
        if (defined('BASE_PATH')) {
            $uri = BASE_PATH . $uri;
        }
        
        $this->routes[] = [
            'uri' => $uri,
            'controller' => $controller,
            'method' => $method
        ];
    }

    // Register a GET route
    public function get($uri, $controller)
    {
        $this->add('GET', $uri, $controller);
    }

    // Find and execute matching route
    public function route($uri, $method)
    {
        foreach ($this->routes as $route) {
            if ($route['uri'] === $uri && $route['method'] === $method) {
                return require $route['controller'];  // Load controller
            }
        }
        
        $this->abort();  // No match? Show 404
    }

    // Show error page
    protected function abort($code = 404)
    {
        http_response_code($code);
        require "views/{$code}.view.php";
        die();
    }
}
```

**What it does:**

1. **Stores routes** in an array (with BASE_PATH automatically added)
2. **Matches incoming requests** against stored routes
3. **Loads the correct controller** when a match is found
4. **Shows 404 page** if no match

**The Magic:** 
When we call `$router->get('/about', 'controllers/about.php')`:
- The `add()` method checks if `BASE_PATH` is defined
- If yes, it becomes: `BASE_PATH . '/about'`
- Result: `/learning-php-and-laravel/.../php-router/about`

This is stored as:
```php
[
    'uri' => '/learning-php-and-laravel/.../php-router/about',
    'controller' => 'controllers/about.php',
    'method' => 'GET'
]
```

Later, when someone visits that full URL, it loops through all saved routes and finds this match!

### Step 5: Controller (Business Logic)
```php
// controllers/about.php
<?php

// You can add logic here:
// - Database queries
// - Form processing
// - Calculations

require 'views/about.view.php';
```

**What it does:**
- Prepares data for the view
- Handles business logic
- Loads the view template

### Step 6: View (Presentation)
```php
// views/about.view.php
<?php require 'partials/header.php'; ?>
<?php require 'partials/nav.php'; ?>

<h1>About Us</h1>
<p>This is the about page</p>

<?php require 'partials/footer.php'; ?>
```

**What it does:**
- Displays HTML to the user
- Uses data from the controller

---

## 🎓 Key Concepts Explained

### 1. Why a Router Class?

**Before (Messy):**
```php
if ($uri === '/learning-php-and-laravel/.../') {
    require 'controllers/index.php';
} elseif ($uri === '/learning-php-and-laravel/.../about') {
    require 'controllers/about.php';
}
// Imagine 50 pages... 😱
```

**After (Clean):**
```php
$router->get('/', 'controllers/index.php');
$router->get('/about', 'controllers/about.php');
// Easy to read and maintain! 😊
```

### 2. Why Separate routes.php?

- **Organization:** All routes in one place
- **Clarity:** Easy to see all available URLs
- **Maintenance:** Add/remove routes without touching index.php

### 3. HTTP Methods (GET, POST, DELETE, etc.)

```php
$router->get('/posts', 'controllers/posts/index.php');      // View all posts
$router->post('/posts', 'controllers/posts/store.php');     // Save new post
$router->delete('/posts', 'controllers/posts/destroy.php'); // Delete post
```

Different actions on the same URL using different HTTP methods!

### 4. MVC Pattern (Model-View-Controller)

- **Model:** Database/data logic (not shown yet)
- **View:** HTML templates (views/)
- **Controller:** Glue between model and view (controllers/)

This keeps code organized and maintainable.

---

## 🚀 How to Use It

### Adding a New Page

1. **Create the controller** (`controllers/services.php`):
```php
<?php
$heading = "Our Services";
require 'views/services.view.php';
```

2. **Create the view** (`views/services.view.php`):
```php
<?php require 'partials/header.php'; ?>
<h1><?= $heading ?></h1>
<p>Our amazing services...</p>
<?php require 'partials/footer.php'; ?>
```

3. **Add the route** (`routes.php`):
```php
$router->get('/services', 'controllers/services.php');
```

That's it! Visit `/services` and it works! 🎉

### Configuration for Different Environments

**Important:** Change the `BASE_PATH` in `index.php` based on where your project is:

```php
// Local development in subdirectory:
define('BASE_PATH', '/learning-php-and-laravel/php-for-beginners/dynamic-web-applications/php-router');

// Local development in root:
define('BASE_PATH', '');

// Production server:
define('BASE_PATH', '');  // Usually empty if at domain root
```

---

## 🔍 Debugging Tips

### Check what route is being requested:
```php
// Add to index.php temporarily
echo "Requested URI: " . $uri . "<br>";
echo "Method: " . $method . "<br>";
die();
```

### See all registered routes:
```php
// Add to Router.php route() method (before foreach)
echo "<pre>";
print_r($this->routes);
die();
```

---

## 💡 Benefits of This Approach

1. **Clean URLs:** `/about` instead of `/about.php`
2. **Single Entry Point:** All requests go through `index.php`
3. **Flexible BASE_PATH:** Works in subdirectories or root
4. **Organized:** Separation of concerns (routes/controllers/views)
5. **RESTful:** Support for different HTTP methods
6. **Scalable:** Easy to add new routes without clutter

---

## ✅ Testing Your Router

Visit these URLs in your browser:
- `http://localhost/learning-php-and-laravel/php-for-beginners/dynamic-web-applications/php-router/` - Home page
- `http://localhost/learning-php-and-laravel/php-for-beginners/dynamic-web-applications/php-router/about` - About page
- `http://localhost/learning-php-and-laravel/php-for-beginners/dynamic-web-applications/php-router/contact` - Contact page
- `http://localhost/learning-php-and-laravel/php-for-beginners/dynamic-web-applications/php-router/notfound` - 404 page

All should work! 🎉

---

## 🎯 Real-World Analogy

Think of your website as a hotel:

- **.htaccess** = Front gate (directs all visitors to reception)
- **index.php** = Reception desk (first point of contact)
- **BASE_PATH** = Hotel address (building location)
- **routes.php** = Hotel directory (room numbers and locations)
- **Router.php** = Concierge (reads directory and guides guests)
- **Controllers** = Room service staff (prepares what guests need)
- **Views** = Hotel rooms (where guests experience their stay)

When a guest asks for a room that doesn't exist, the concierge shows them the "404 Not Found" information!

---

## 🎓 Next Steps

1. Add more routes and practice
2. Learn about route parameters: `/posts/:id`
3. Add middleware (authentication, logging)
4. Implement a database (Model layer)
5. Add form validation

Happy coding! 🚀
