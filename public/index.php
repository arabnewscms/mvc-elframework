<?php

// Define ROOT Directory path
define('ROOT_PATH', dirname(__FILE__));


/**
 *  Run Composer Autoloader
 */
require_once __DIR__ . '/../vendor/autoload.php';


/**
 * Run The Framework
 */
(new \Iliuminates\Application)->start();




// echo "<pre>";
// var_dump($router->routes());
