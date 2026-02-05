<?php

function isCurrentPage($path) {
    return $_SERVER['REQUEST_URI'] === $path ? 'border-b-2 border-indigo-500' : '';
}
