<?php
/**
 * HTML helper functions
 */

/**
 * Convert applicable HTML characters to HTML entities.
 *
 * @param  string $input_string
 * @return string
 */
function e($input_string) {
    return htmlentities($input_string, ENT_QUOTES, 'UTF-8');
}