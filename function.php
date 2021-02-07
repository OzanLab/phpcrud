<?php

if (!defined('FUNC')) {
    define('FUNC', 'functions');
}

// Load includer function
require_once FUNC . '/includer.php';

// Load database connection
get_file('connection', FUNC);

// Load database query
get_file('database', FUNC);

// Load dumper
get_file('dumper', FUNC);

// Load router
get_file('router', FUNC);

// include template function
get_file('template', FUNC);

// include alert 
get_file('alert', FUNC);

// include validation
get_file('validation', FUNC);
