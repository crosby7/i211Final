<?php

/**
 * Author: Cameron Crosby
 * Date: 03/09/2024
 * Name: dispatcher.class.php
 * Description: application dispatcher responsible for dissecting in pieces the requested URI and
 * routing the request to the proper method of the matched controller.
 */

class Dispatcher {

    public function __construct() {
        self::dispatch();
    }

    //dispatch request to the appropriate controller/method
    public static function dispatch(): void
    {
        //split the uri into url and querystrings
        $uri_array = explode('?', trim($_SERVER['REQUEST_URI'], '/'));

        //extract components in url and store them in an array.
        $url_array = explode('/', $uri_array[0]);

        // Debug:
        //console_php('URL ARRAY:');
       // console_php($url_array);

        //remove the root folder name from the array if there is
        while (in_array(basename(getcwd()), $url_array)) {
            array_shift($url_array);
        }

        //strip off index.php or index from the beginning of url if present
        if (count($url_array) > 0 && ($url_array[0] == "index.php" or $url_array[0] == "index")) {
            array_shift($url_array);
        }

        // Debug:
       // console_php('URL ARRAY POST PROCESSED:');
       // console_php($url_array);

        //Now, the url_array contains controller name, followed by method name, and zero, one or more arguments
        //get controller name or assign the default controller "WelcomeController"
        $controllerName = !empty($url_array[0]) ? ucfirst($url_array[0]) . 'Controller' : 'BankAccountController';

//        var_dump($controllerName);
//        die();
        //create controller instance
        if (!class_exists($controllerName)) {
            $message = "Controller '$controllerName' does not exist.";
            //include 'error.php';
            exit();
        }
        $controller = new $controllerName();

        //get method name or assign the default method "index"
        $method = !empty($url_array[1]) ? $url_array[1] : 'index';

        // Debug:
        //console_php('METHOD:');
       // console_php($method);

        //remove .php from the method name if present
        if (strpos($method, '.')) {
            $method = substr($method, 0, strpos($method, '.'));
        }

        // Debug:
        //console_php('URL ARRAY PRE-METHOD:');
       // console_php($url_array);

        //get all arguments and store them in an array
        $args = array();
        if (count($url_array) > 2) {
            // Debug:
            //console_php('URL ARRAY IN ARGS CHECK:');
            //console_php($url_array);
            $args = array_slice($url_array, 2);
            // Debug:
            //console_php('ARGS IN CHECK');
            //console_php($args);
        }

        // Debug:
        //console_php('ARGS:');
        //console_php($args);

        var_dump($controller, $method, $args);
        //call a method with a variable number of arguments
        call_user_func_array(array($controller, $method), $args);
    }
}