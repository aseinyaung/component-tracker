<?php
/*
 * Components controller
 */

include '../includes/config.inc.php';
include '../includes/db.inc.php';
include '../includes/controller.inc.php';
include '../includes/view.inc.php';
include '../includes/html.inc.php';
include '../includes/form.inc.php';

// Connect to the database
$dbh = connect($db_config);

// If there is a query string, save $_GET array keys into $get array
$get = [null, null];
if (!empty($_GET)) {
    $get = array_keys($_GET);
}

// determine the request method and load appropriate action
$method = find_request_method();
load_action($method, $get);

/**
 * Index action
 */
function index_action() 
{
    $data['components'] = get_table($GLOBALS['dbh'], 'components');
    $data['page_title'] = 'Listing Components';
    load_view('components.index', $data);
}

/**
 * New action
 */
function new_action() 
{
    $data['page_title'] = 'New Component';
    load_view('components.new', $data);
}

/**
 * Create action
 */
function create_action() 
{
    $sql = 'INSERT INTO 
            components(name, description, notes, quantity_on_hand, quantity_on_order, reorder_level)
            VALUES(:name, :description, :notes, :quantity_on_hand, :quantity_on_order, :reorder_level)';
    $r = execute($GLOBALS['dbh'],
                $sql,
                [
                    ':name'              => $_POST['name'],
                    ':description'       => $_POST['description'],
                    ':notes'             => $_POST['notes'],
                    ':quantity_on_hand'  => $_POST['quantity_on_hand'],
                    ':quantity_on_order' => $_POST['quantity_on_order'],
                    ':reorder_level'     => $_POST['reorder_level']
                ]);
    if ($r === true) {
        header('Location: .');
    } else {
        $data['error'] = ['There was a problem adding the component into the database.'];
        load_view('templates.error', $data);
    }    
}

/**
 * Show action
 */
function show_action() 
{
    echo 'show';
}

/**
 * Edit action
 */
function edit_action() 
{
    echo 'edit';
}

/**
 * Update action
 */
function update_action() 
{
    echo 'update';
}

/**
 * Delete action
 */
function delete_action() 
{
    echo 'delete';
}