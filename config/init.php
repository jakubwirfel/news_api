<?php
// Start Session
session_start();
//Errors empty
$errors = [];
//Config file
require_once 'config.php';

//Include Helpers
require_once 'helpers/system_helper.php';

//Autoloader
function __autoload($class_name) {
    require_once 'lib/'.$class_name. '.php';
}