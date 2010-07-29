<?PHP
/**
 * This script receives a "keepalive" request from the jQuery keepalive
 * plugin
 *  
 * The purpose is to keep the session alive in case the user
 * spends more than 20 minutes engaged task
 *  
 * This will prevent subsequent page requests from being 
 * returned with a "you are logged out" error which then forces 
 * the user to sign in again.
 *
 * @author Wayne Walls wfwalls(at)gmail(dot)com
 *  
 */



// perform application-specific authentication HERE e.g., require('auth_check.php');
// or it you are not authenticating but just want to keep a session alive use...
// session_name();
// session_start();

// for this demo use...
session_name("keepalive");
session_start();



require_once('common.php');



// remove magic quotes if magic quotes is ON
if (get_magic_quotes_gpc())
{
    if (!empty($_GET))     remove_magic_quotes($_GET);
    if (!empty($_POST))    remove_magic_quotes($_POST);
    if (!empty($_COOKIE))  remove_magic_quotes($_COOKIE);
    if (!empty($_REQUEST)) remove_magic_quotes($_REQUEST);

    //turn magic quotes off
    @ini_set('magic_quotes_gpc', 0);

    //let the rest of the script find out if quotes have been stripped
    define('MAGIC_QUOTES_STRIPPED',1);
}



//decode elements of $_GET
if (!empty($_GET)) decode_url($_GET);



//check for any user supplied HTML and convert it to entities
if (!empty($_GET))     check_for_html($_GET);
if (!empty($_POST))    check_for_html($_POST);
if (!empty($_REQUEST)) check_for_html($_REQUEST);



//  ***************  trim $_POST elements that will go in the database here
if (!empty($_POST))    trim_whitespace($_POST);



// don't let array indices in $_COOKIE interfere with $_REQUEST elements
// remove $_COOKIE from $_REQUEST
$_REQUEST = array_merge($_GET, $_POST);



// create the BoP global arrays *********************************
// the $content array holds content and content informational elements
$content = array();

// the $page array holds information about the environment or state under
// which this page access is being processed
$page = array();


$content['id'] = $_REQUEST['id'];


echo("success");


exit;


?>