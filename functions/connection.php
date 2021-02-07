<?php

$db = include ROOT_PATH . 'config.php';

define('DB_HOST', $db['host']);
define('DB_USER', $db['user']);
define('DB_PASSWORD', $db['password']);
define('DB_NAME', $db['name']);
