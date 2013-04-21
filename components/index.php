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
include '../includes/validator.inc.php';

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
    $data['name'] 
    = $data['description'] 
    = $data['notes'] 
    = '';

    $data['quantity_on_hand'] 
    = $data['quantity_on_order'] 
    = $data['reorder_level'] 
    = 0;

    $data['page_title'] = 'New Component';
    load_view('components.new', $data);
}

/**
 * Create action
 */
function create_action() 
{
    // Validates form fields.
    $errors = [];
    validates('name', ['presence' => true, 'length' => ['maximum' => 225]], $errors);
    validates('quantity_on_hand', ['presence' => true], $errors);
    validates('quantity_on_order', ['presence' => true], $errors);
    validates('reorder_level', ['presence' => true], $errors);
    
    // If validation fails
    if (!empty($errors)) {
        foreach ($_POST as $k => $v) {
            $data[$k] = $v;
        }
        $data['errors'] = $errors;
        $data['page_title'] = 'New Component';
        load_view('components.new', $data);
        exit();
    }

    // If validation passes, insert into database
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
function edit_action($id) 
{
    $sql = 'SELECT * FROM components WHERE id = :id';
    $r = query($GLOBALS['dbh'],
                $sql,
                [':id' => $id]
        );

    if ($r) {
        $data['id']             = $r[0]['id'];
        $data['name']           = $r[0]['name'];
        $data['description']    = $r[0]['description'];
        $data['notes']          = $r[0]['notes'];

        $data['quantity_on_hand']   =  $r[0]['quantity_on_hand'];
        $data['quantity_on_order']  =  $r[0]['quantity_on_order'];
        $data['reorder_level']      =  $r[0]['reorder_level'];

        $data['page_title'] = 'Edit Component';
        load_view('components.edit', $data);
    } else {
        $data['error'] = ['The specified component does not exist.'];
        load_view('templates.error', $data);
    } 
}

/**
 * Update action
 */
function update_action($id) 
{
    // Validates form fields.
    $errors = [];
    validates('name', ['presence' => true, 'length' => ['maximum' => 225]], $errors);
    validates('quantity_on_hand', ['presence' => true], $errors);
    validates('quantity_on_order', ['presence' => true], $errors);
    validates('reorder_level', ['presence' => true], $errors);
    
    // If validation fails
    if (!empty($errors)) {
        foreach ($_POST as $k => $v) {
            $data[$k] = $v;
        }
        $data['errors'] = $errors;
        $data['page_title'] = 'Edit Component';
        load_view('components.edit', $data);
        exit();
    }

    // If validation passes, insert into database
    $sql = 'UPDATE components 
            SET name = :name, description = :description, notes = :notes, 
            quantity_on_hand = :quantity_on_hand, quantity_on_order = :quantity_on_order, reorder_level = :reorder_level
            WHERE id = :id';
    $r = execute($GLOBALS['dbh'],
                $sql,
                [
                    ':name'              => $_POST['name'],
                    ':description'       => $_POST['description'],
                    ':notes'             => $_POST['notes'],
                    ':quantity_on_hand'  => $_POST['quantity_on_hand'],
                    ':quantity_on_order' => $_POST['quantity_on_order'],
                    ':reorder_level'     => $_POST['reorder_level'],
                    ':id'                => $id
                ]);
    if ($r === true) {
        header('Location: .');
    } else {
        $data['error'] = ['There was a problem editing the component.'];
        load_view('templates.error', $data);
    }
}

/**
 * Delete action
 */
function delete_action() 
{
    echo 'delete';
}