<?php
/**
 * Author: Alfred Acevedo-Rodriguez
 * Date: 11/20/2024
 * File: index.php
 * Description:
 */

// Start session if there isnt one
if (session_status() === PHP_SESSION_NONE)
{
    // start a session
    session_start();
}

// Config
require_once ('application/config.php');

//include code in vendor/autoload.php file
require_once ("vendor/autoload.php");

//create an object of UserController
$user_controller = new UserController();

//default action is to list all toys
$action = $_GET['action'] ?? 'index';

//invoke appropriate method depending on action value
if($action === 'index') {
    $user_controller->index();
}
else if($action === 'details') {
    $user_controller->register();
}
else if ($action === 'error'){
//display an error message
    $message = $_GET['message'] ?? 'We are sorry, but an error has occurred.';
    $user_controller->error($message);
}
else {
    $message = "Invalid action was requested.";
    $user_controller->error($message);
}