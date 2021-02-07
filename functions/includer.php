<?php

/**
 * Check existing php file
 *
 * @param string file name
 * @return boolean
 */
function has_file(string $file_name, string $directory = null) {
    if (!empty($directory)) {
        $directory = ltrim(rtrim($directory, '/'), '/');
        $directory .= '/';
    }

    $file = ROOT_PATH . $directory . $file_name . '.php';

    return file_exists($file) ? $file : false;
}

/**
 * Get file or include a file and send the data to the file if the data has been inserted 
 *
 * @param string file name
 * @param string directory
 * @param array data to be sent
 *
 * @return the file wich included by
 * include_once function.
 */
function get_file(string $file_name, string $directory = null, array $data = array()) { 
    $file_name = has_file($file_name, $directory);
    return !empty($file_name) ? include_once $file_name : printf('File <b>%s</b> tidak ditemukan', $file_name);
}
