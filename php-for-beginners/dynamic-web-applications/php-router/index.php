<?php

require 'functions.php';
require 'Router.php';

// Define base path for this project
define('BASE_PATH', '/learning-php-and-laravel/php-for-beginners/dynamic-web-applications/php-router');

$router = new Router();

require 'routes.php';

$uri = parse_url($_SERVER['REQUEST_URI'])['path'];
$method = $_SERVER['REQUEST_METHOD'];

$router->route($uri, $method);