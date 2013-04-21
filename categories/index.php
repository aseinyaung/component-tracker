<?php
/*
 * Categories controller
 */

include '../includes/includes.inc.php';

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
    echo 'index';
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
function edit_action($id) 
{
    echo 'edit';
}

/**
 * Update action
 */
function update_action($id) 
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