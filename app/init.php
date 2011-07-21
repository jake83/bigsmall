<?php

/*
	INIT
	Basic configuration settings
*/

// create application settings
define("SITE_PATH", "http://localhost/bigsmall/");
define("APP_PATH", str_replace("\\", "/", dirname(__FILE__)) . "/");

define("SITE_RESOURCES", "http://localhost/bigsmall/resources/");
define("APP_RESOURCES", "http://localhost/bigsmall/app/resources/");
define("SITE_CSS", "http://localhost/bigsmall/resources/css/style.css");

// database settings
$server = 'server';
$user = 'user';
$pass = 'pass';
$db = 'db';

// error reporting
mysqli_report(MYSQLI_REPORT_ERROR);	

// create FlightPath core object
require_once(APP_PATH . "core/core.php");
$FP = new FlightPath_Core($server, $user, $pass, $db);

// strip slashes
if (get_magic_quotes_gpc()) {
    function stripslashes_deep($value)
    {
        $value = is_array($value) ?
                    array_map('stripslashes_deep', $value) :
                    stripslashes($value);

        return $value;
    }

    $_POST = array_map('stripslashes_deep', $_POST);
    $_GET = array_map('stripslashes_deep', $_GET);
    $_COOKIE = array_map('stripslashes_deep', $_COOKIE);
    $_REQUEST = array_map('stripslashes_deep', $_REQUEST);
}
