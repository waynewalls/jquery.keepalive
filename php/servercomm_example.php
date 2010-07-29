<?PHP
/**
 * The script receives an ajax request for processing
 *
 * @author Wayne Walls wfwalls(at)gmail(dot)com
 */


define('SERVERCOMM', 1);


/**
 * authenticate here
 * invoke die("auth failure") if authentication fails
 */


// load utility functions
require_once('common.php');


// setup the database
require_once('database.php');

//setup a database connection
if (!$connection = @ mysql_connect($hostName, $databaseUser, $databasePassword)) {

    // showerror();
    die("database failure");
}

//select the database to be used in this script
if (!mysql_selectdb($databaseName, $connection)) {

    // showerror();
    die("database failure");
}


// remove magic quotes if magic quotes is ON
if (get_magic_quotes_gpc()) {
    if (!empty($_GET))     remove_magic_quotes($_GET);
    if (!empty($_POST))    remove_magic_quotes($_POST);
    if (!empty($_COOKIE))  remove_magic_quotes($_COOKIE);
    if (!empty($_REQUEST)) remove_magic_quotes($_REQUEST);

    //turn magic quotes off
    @ini_set('magic_quotes_gpc', 0);

    //let the rest of the script find out if quotes have been stripped
    define('MAGIC_QUOTES_STRIPPED', 1);
}


//decode elements of $_GET
if (!empty($_GET)) {
    decode_url($_GET);
}


// get $_GET ready for use
if (!empty($_GET)) {
    decode_url($_GET);
    check_for_html($_GET);
    trim_whitespace($_GET);
    clean_for_mysql($_GET);
}
// get $_POST ready for use
if (!empty($_POST)) {
    // if $_POST contains JSON process with ENT NOQUOTES to leave quotes intact
    foreach ($_POST as $key => $value)
    {
        $_POST[$key] = htmlspecialchars($_POST[$key], ENT_NOQUOTES);
    }
    // if there is no JSON then use ENT QUOTES
    //check_for_html($_POST);

    trim_whitespace($_POST);
    clean_for_mysql($_POST);
}


// get $_REQUEST ready for use
// don't let array indices in $_COOKIE interfere with $_REQUEST elements -- remove $_COOKIE from $_REQUEST
$_REQUEST = array_merge($_GET, $_POST);


// ensure that strings are strings HERE
// cast $var as a string using $var = (string) $var
if (isset($_REQUEST['test_value'])) {
    $_REQUEST['test_value'] = (string) $_REQUEST['test_value'];
}
else
{
    // if we don't have what we expect in $_POST then die
    die("POST failure");
}


// ensure that numbers are numbers HERE
// cast $var as an int using $var = (int) $var
if (isset($_REQUEST['test_id'])) {
    $_REQUEST['test_id'] = (int) $_REQUEST['test_id'];
}
else
{
    // if we don't have what we expect in $_POST then die
    die("POST failure");
}



// ****
// **** EXAMPLE MySQL QUERIES  AND RETURNS TO SERVERCOMM ****
// ****

//if ($_REQUEST['action'] == "add")
//{
//    $content['date']          = gmmktime();
//    $content['username']      = $USERINFO['user'];
//    $content['ft_exercise']   = $_REQUEST['ft_exercise'];
//    $content['response_text'] = $_REQUEST['response_text'];
//
//
//    // store the new response in the database
//    $query = "INSERT INTO freetext VALUES
//      ( NULL,
//       '{$content['date']}',
//       '{$content['username']}',
//       '{$content['ft_exercise']}',
//       '{$content['response_text']}')";
//
//
//    // Execute the query
//    if (!$result = @ mysql_query ($query, $connection))
//    {
//        die("database failure");
//    }
//    else
//    {
//        echo("success" . "|" . mysql_insert_id());
//    }
//}
//else if ($_REQUEST['action'] == "edit")
//{
//    $content['responseid']      = $_REQUEST['responseid'];
//    $content['response_text']   = $_REQUEST['response_text'];
//
//
//    // store the new response in the database
//    $query = "UPDATE freetext SET responseText = '{$content['response_text']}' WHERE responseID = '{$content['responseid']}'";
//
//
//    // Execute the query
//    if (!$result = @ mysql_query ($query, $connection))
//    {
//        die("database failure");
//    }
//    else
//    {
//        echo("success");
//    }
//}
//else if ($_REQUEST['action'] == "delete")
//{
//    $content['responseid']   = $_REQUEST['responseid'];
//
//
//    // store the new response in the database
//    $query = "DELETE FROM freetext WHERE responseID = '{$content['responseid']}'";
//
//
//    // Execute the query
//    if (!$result = @ mysql_query ($query, $connection))
//    {
//        die("database failure");
//    }
//    else
//    {
//        echo("success");
//    }
//}


exit;


?>
