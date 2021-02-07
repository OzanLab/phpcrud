<?php

define('BASE_URL', $_SERVER['HTTP_HOST']);

function home_url() {
    $protocol = 'http';
    return $protocol . '://' . BASE_URL;
}

function get_server($key) {
    if (!empty($_SERVER[strtoupper($key)])) {
        $server = $_SERVER[strtoupper($key)];
    } else {
        $server = '';
    }

    return $server;
}

function redirect($url, $status_code = 303) {
    header('Location: ' . home_url() . $url, true, $status_code);
    die();
}

function register_route(array $routes) {
    $route_maps = array();
    foreach ($routes as $route) {
        $route_maps[] = formate_route($route);
    }

    return $route_maps;
}

function formate_route(string $route) {
    $route = remove_slash($route); 
    if ($route == '') {
        $route = '/';
    }

    return $route;
}

function remove_slash($string, $positions = 'rl') {
    switch ($positions) {
    case 'r':
        $trimed_string = rtrim($string, '/');
        break;
    case 'l':
        $trimed_string = ltrim($string, '/');
        break;
    case 'rl':
        $trimed_string = rtrim(ltrim($string, '/'), '/');
        break;
    }

    return $trimed_string;
}
