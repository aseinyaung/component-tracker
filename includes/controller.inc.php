<?php
/**
 * controller-related functions
 */

/**
 * Determine the request method.
 *
 * @return void
 */
function find_request_method() {
    $method = 'GET';
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $method = 'POST';
        if (isset($_POST['_method']) &&
            ($_POST['_method'] == 'PUT' || $_POST['_method'] == 'DELETE')) {
            $method = $_POST['_method'];
        }
    }
    return $method;
}

/**
 * Check the request and call the appropriate action.
 *
 * @param  string $method
 * @param  string $get
 * @return void
 */
function load_action($method, $get) {
    // GET - /components
    if ($method == 'GET' && $get[0] == null) {
        index_action();
    } 
    // GET - /components/?new
    elseif ($method == 'GET' && $get[0] == 'new') {
        new_action();
    } 
    // POST - /components
    elseif ($method == 'POST' && $get[0] == null) {
        create_action();
    } 
    // GET - /components/?:id
    elseif ($method == 'GET' && is_numeric($get[0]) && !isset($get[1])) {
        show_action();
    } 
    // GET - /components/?:id&edit
    elseif ($method == 'GET' && is_numeric($get[0]) && $get[1] == 'edit') {
        edit_action($get[0]);
    } 
    // PUT - /components/?:id
    elseif ($method == 'PUT' && is_numeric($get[0])) {
        update_action();
    }
    // DELETE - /components/?:id
    elseif ($method == 'DELETE' && is_numeric($get[0])) {
        delete_action();
    }
}