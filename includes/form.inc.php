<?php
/**
 * Form builder functions.
 */

/*
 * Open a form.
 *
 * By default, the form submits to the current URL with POST method.
 * For PUT or DELETE methods, add a hidden input with name _method.
 *
 * @param  string $action
 * @param  string $method
 * @param  array  $attributes
 * @return string
 */
function open($action = null, $method = 'post', $attributes = []) 
{
    if (!empty($action)) {
        $action = ' action="' . $action . '"';
    } else {
        $action = '';
    }

    if (!in_array($method, ['get', 'post', 'put', 'delete'])) {
        $method = 'post';
    }

    if ($method == 'put' || $method == 'delete') {
        $method = 'post';
        $hidden_input = '<input type="hidden" name="_method" value="' . $method . '">
                        ';
    } else {
        $hidden_input = '';
    }

    $attributes = attributes($attributes);

    return '<form' . $action . ' method="' . $method . '"' . $attributes . '>
           ' . $hidden_input;
}

/*
 * Close a form.
 *
 * @return string
 */
function close() 
{
    return '</form>
           ';
}

/*
 * Create a label element.
 *
 * @param  string $for
 * @param  string $label
 * @param  array  $attributes
 * @return string
 */
function label($for, $label = null, $attributes = []) 
{
    if (!$label) {
        $exploded = explode('_', $for);
        foreach ($exploded as $exp) {
            $label .= ucfirst($exp) . ' ';
        }
    }

    $attributes = attributes($attributes);

    return '<label for="' . $for . '"' . $attributes . '>' . $label . '</label>
           ';
}

/**
 * Create an input element.
 *
 * @param  string $type
 * @param  string $name
 * @param  string $value
 * @param  array  $attributes
 * @return string
 */
function input($type, $name, $value, $attributes = [])
{
    $attributes = include_id_attribute($name, $attributes);
    $attributes = attributes($attributes);
    return '<input type="' . $type . '" value="' . $value . '"' . $attributes . '>
           ';
}

/**
 * Create a text input element.
 *
 * @param  string $name
 * @param  string $value
 * @param  array  $attributes
 * @return string
 */
function text($name, $value = null, $attributes = []) 
{
    return input('text', $name, $value, $attributes);
}

/**
 * Create a number input element.
 *
 * @param  string $name
 * @param  string $value
 * @param  array  $attributes
 * @return string
 */
function number($name, $value = null, $attributes = []) 
{
    return input('number', $name, $value, $attributes);
}

/**
 * Create a textarea input element.
 *
 * @param  string $name
 * @param  string $value
 * @param  array  $attributes
 * @return string
 */
function textarea($name, $value = null, $attributes = []) 
{
    $attributes = include_id_attribute($name, $attributes);
    $attributes = attributes($attributes);
    return '<textarea name="' . $name . '"' . $attributes . '>' . $value . '</textarea>
           ';
}

/*
 * Create a submit input element.
 *
 * @param  string $value
 * @param  string $name
 * @param  array  $attributes
 * @return string
 */
function submit($value = null, $name = null, $attributes = []) 
{
    $attributes = attributes($attributes);
    if(!empty($value)) {
        $attributes .= ' value="' . $value . '"';
    }
    if(!empty($name)) {
        $attributes .= ' name="' . $name . '"';
    }
    return '<input type="submit"' . $attributes . '>
           ';
}

/**
 * Change an array of form and form control attributes to a formatted string.
 *
 * @param  array  $attributes
 * @return string
 */
function attributes($attributes) 
{
    $ret = '';
    foreach ($attributes as $k => $v) {
        $ret .= ' ' . $k . '="' . $v . '"';
    }
    return $ret;
}

/**
 * Check if id attribute exists in the $attributes array. If not include it by
 * inferring from name attribute. 
 *
 * @param  name   $string
 * @param  array  $attributes
 * @return string
 */
function include_id_attribute($name, $attributes) 
{
    if (!array_key_exists('id', $attributes)) {
        $attributes['id'] = $name;
    }
    return $attributes;
}