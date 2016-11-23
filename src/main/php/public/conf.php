<?php
require '../vendor/autoload.php';
spl_autoload_register(function ($classname) {
    if (strtoupper(substr(PHP_OS, 0, 3)) === 'WIN') {
        // This is a server using Windows!
        // nothing to change
    } else {
        // This is a server not using Windows!
        $classname = str_replace("\\", "/", $classname);
    }
    require (realpath(dirname(__FILE__)) . "/../classes/" . $classname . ".php");
}, false);

$config = array();
$config['displayErrorDetails'] = true;
$config['addContentLengthHeader'] = false;
$config['default_token'] = '5fc142d6-509a-4b10-a765-1ced92a765ea';

function exception_error_handler($errno, $errstr, $errfile, $errline)
{
    throw new ErrorException($errstr, $errno, 0, $errfile, $errline);
}
set_error_handler("exception_error_handler");
try {
    include '../custom_conf.php';
} catch (ErrorException $e) {
    // ignore if no customer_conf exists
}