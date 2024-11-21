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

//call dispatcher for url
new Dispatcher();