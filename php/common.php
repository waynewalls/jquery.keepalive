<?php
/**
 * SAMESIDE common php functions
 *
 * @author     Wayne Walls wfwalls(at)gmail(dot)com
 */


if (!defined('SERVERCOMM')) {
    die('Unauthorized access');
}


/**
 * remove magic quotes from an array
 *
 * @author     Wayne Walls <wwalls@anacapasciences.com>
 */
function remove_magic_quotes(&$array) {

    foreach ($array as $key => $value) {
        $array[$key] = stripslashes($array[$key]);
    }
}


/**
 * decode elements of an array the were passed in the URL
 *
 * @author     Wayne Walls <wwalls@anacapasciences.com>
 */
function decode_url(&$array) {

    foreach ($array as $key => $value) {
        $array[$key] = urldecode($array[$key]);
    }
}


/**
 * convert html special characters in an array element to html entities
 *
 * @author     Wayne Walls <wwalls@anacapasciences.com>
 */
function check_for_html(&$array) {

    foreach ($array as $key => $value) {
        $array[$key] = htmlspecialchars($array[$key], ENT_QUOTES);
    }
}


/**
 * trim all elements of an array of strings
 *
 * @author     Wayne Walls <wwalls@anacapasciences.com>
 */
function trim_whitespace(&$array) {

    foreach ($array as $key => $value) {
        $array[$key] = trim($array[$key]);
    }
}


/**
 * escape an array of strings for MySQL
 *
 * @author     Wayne Walls <wwalls@anacapasciences.com>
 */
function clean_for_mysql(&$array) {

    global $connection;

    foreach ($array as $key => $value) {
        $array[$key] = mysql_real_escape_string($array[$key], $connection);
    }
}


?>
