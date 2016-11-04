<?php
require '../vendor/autoload.php';
spl_autoload_register(function ($classname) {
    require ("../classes/" . $classname . ".php");
}, false);

$config = array();
$config['displayErrorDetails'] = true;
$config['addContentLengthHeader'] = false;