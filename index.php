<?php

if (!defined('ROOT_PATH')) {
    define('ROOT_PATH', __DIR__ . DIRECTORY_SEPARATOR);
}

// Load the core function
require_once ROOT_PATH . 'function.php';

template('index');
