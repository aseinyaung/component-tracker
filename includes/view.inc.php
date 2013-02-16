<?php
/**
 * View-related functions
 */

/**
 * Load a view file.
 *
 * @param  string $path
 * @param  array  $data
 * @return void
 */
function load_view($path, $data = null) 
{
    if ($data) {
        extract($data);
    }

    $path = explode('.', $path);
    $path = '../views/' . $path[0] . '/' . $path[1] . '.html.php';

    if (!file_exists($path)) {
        $data = [];
        $data['error'] = ['Specified view file is not found.'];
        $path = '../views/templates/error.html.php';
    }

    include '../views/layout.html.php';
}