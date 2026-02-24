<?php

function routeToController($uri, $routes)
{
    if (array_key_exists($uri, $routes)) {
        require $routes[$uri];
    } else {
        abort();
    }
}

$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

$routes = [
    '/php-for-beginners/dynamic-web-applications/database/' => 'controllers/index.php',
    '/php-for-beginners/dynamic-web-applications/database/about' => 'controllers/about.php',
    '/php-for-beginners/dynamic-web-applications/database/notes' => 'controllers/notes.php',
    '/php-for-beginners/dynamic-web-applications/database/note' => 'controllers/note.php',
    '/php-for-beginners/dynamic-web-applications/database/contact' => 'controllers/contact.php',
];

routeToController($uri, $routes);
