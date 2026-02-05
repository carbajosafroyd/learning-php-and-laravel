<?php



require 'functions.php';

$uri = $_SERVER['REQUEST_URI'];



if ($uri === '/learning-php-and-laravel/php-for-beginners/dynamic-web-applications/php-router/') {
    require 'controllers/index.php';
} elseif ($uri === '/learning-php-and-laravel/php-for-beginners/dynamic-web-applications/php-router/about') {
    require 'controllers/about.php';
} elseif ($uri === '/learning-php-and-laravel/php-for-beginners/dynamic-web-applications/php-router/contact') {
    require 'controllers/contact.php';
} else {
    http_response_code(404);
    echo 'Page not found';
}