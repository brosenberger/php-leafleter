<?php
require '../vendor/autoload.php';
spl_autoload_register(function ($classname) {
    require (realpath(dirname(__FILE__)) . "/../classes/" . str_replace("\\", "/", $classname) . ".php");
}, false);

$config = array();
$config['displayErrorDetails'] = true;
$config['addContentLengthHeader'] = false;