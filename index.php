<?php
ini_set('display_errors', 0);
error_reporting(E_ALL);

define('ROOT', dirname(__FILE__));
require_once(ROOT.'/components/Router.php');
require_once(ROOT.'/components/bd.php');
session_start();
$router = new Router();
$router->run();