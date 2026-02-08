<?php

function isCurrentPage($path) {
    $currentPath = parse_url($_SERVER['REQUEST_URI'])['path'];
    return $currentPath === $path ? 'border-b-2 border-indigo-500' : '';
}
