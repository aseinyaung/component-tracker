<?php

/**
 * Validate a POST-ed input field against a set of specified rules.
 *
 * If the field does not pass a validation, an error message is added to the
 * $errors array which is passed by reference.
 * 
 * @param  string $field
 * @param  array  $rules
 * @param  array  &$errors
 * @return void
 */
function validates($field, $rules, &$errors) 
{
    foreach ($rules as $k => $v) {
        switch ($k) {
            case 'presence':
                validates_presence($field, $errors);
                break;
            case 'length':
                validates_length($field, $v, $errors);
                break;
        }
    }
}

/**
 * Validate that a POST-ed input field is not empty. 
 * 
 * @param  string $field
 * @param  array  &$errors
 * @return void
 */
function validates_presence($field, &$errors) 
{
    if (empty($_POST[$field]))  {
        $errors[] = humanize($field) . " can't be empty.";
    }
}

/**
 * Validate the length of a POST-ed input field.
 * 
 * @param  string $field
 * @param  array  $constraints
 * @param  array  &$errors
 * @return void
 */
function validates_length($field, $constraints, &$errors) 
{
    foreach ($constraints as $k => $v) {
        switch ($k) {
            case 'minimum':
                validates_minimum($field, $v, $errors);
                break;   
            case 'maximum':
                validates_maximum($field, $v, $errors);
                break;  
            case 'in':
                validates_in($field, $v, $errors);
                break;  
            case 'is':
                validates_is($field, $v, $errors);
                break;  
        }
    }
}

/**
 * Validate that the length of a POST-ed input field is more than the specified
 * length.
 * 
 * @param  string $field
 * @param  array  $constraint
 * @param  array  &$errors
 * @return void
 */
function validates_minimum($field, $constraint, &$errors) 
{
    if (strlen($_POST[$field]) < $constraint) {
        $errors[] = humanize($field) . " can't be less than $constraint characters.";
    }
}

/**
 * Validate that the length of a POST-ed input field is less than the specified
 * length.
 * 
 * @param  string $field
 * @param  array  $constraint
 * @param  array  &$errors
 * @return void
 */
function validates_maximum($field, $constraint, &$errors) 
{
    if (strlen($_POST[$field]) > $constraint) {
        $errors[] = humanize($field) . " can't be more than $constraint characters.";
    }
}

/**
 * Validate that the length of a POST-ed input field is between the specified 
 * interval.
 * 
 * @param  string $field
 * @param  array  $constraint
 * @param  array  &$errors
 * @return void
 */
function validates_in($field, $constraint, &$errors) 
{
    $length = strlen($_POST[$field]);
    if ($length < $constraint[0] || $length > $constraint[1]) {
        $errors[] = humanize($field) . " must be between $constraint[0] and $constraint[1] characters.";
    }
}

/**
 * Validate that the length of a POST-ed input field is equal to the specified
 * length.
 * 
 * @param  string $field
 * @param  array  $constraint
 * @param  array  &$errors
 * @return void
 */
function validates_is($field, $constraint, &$errors) 
{
    if (strlen($_POST[$field]) != $constraint) {
        $errors[] = humanize($field) . " must be $constraint characters.";
    }
}

/**
 * Capitalize the first word and turn underscores into spaces.
 * 
 * @param  string $value
 * @return string
 */
function humanize($value) 
{
    $value = str_replace('_', ' ', $value);
    return ucfirst($value);
}