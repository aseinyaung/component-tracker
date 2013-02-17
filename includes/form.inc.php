<?php
/**
 * Form builder functions.
 */

/*
 * Open a form.
 *
 * @param  string $action
 * @param  string $method
 * @param  array  $attributes
 * @return string
 */
function open($action = '', $method = 'GET', $attributes = []) 
{
    if ($method != 'GET' || $method != 'POST') {
        $method = 'GET';
    }
    $attributes = attributes($attributes);
    return '<form action="' . $action . '" method="' . $method . '"' . $attributes . '>
           ';
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