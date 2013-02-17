<?php
/*
 * Components controller
 */

include '../includes/config.inc.php';
include '../includes/db.inc.php';
include '../includes/controller.inc.php';
include '../includes/view.inc.php';
include '../includes/html.inc.php';

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
    $data['page_title'] = 'List Components';
    load_view('components.index', $data);
}

/**
 * New action
 */
function new_action() 
{
    echo 'new';
}

/**
 * Create action
 */
function create_action() 
{
    echo 'create';
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