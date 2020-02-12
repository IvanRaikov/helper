<?php
ini_set('display_errors',1);
error_reporting(E_ALL);
define('ROOT',__DIR__);
require(ROOT.'/components/functions.php');
require(ROOT.'/components/autoload.php');
$router = new Router();
$router->run();
