<?php
define("PATH_ROOT", __DIR__);
require_once(PATH_ROOT . "/app/config/config.inc");
require_once(PATH_ROOT . "/app/autoload.php");

session_start();
$redirect = ((isset($_GET['action'])) && ($_GET['action']!=''))?$_GET['action']:"products";

if(!isset($app)){
	$app = 'ShoppingCart';
	$redirect = "products";
}

if (!isset($_SESSION['SESSION_USER']) && $app !== 'ShoppingCart' && $app !== 'Security'){	
	header("location: ".URL_BASE);
	exit();
}

$controllerName = $app."Controller";
$controller = new $controllerName();

if(!method_exists ( $controller , $redirect )){
	$controller = new SecurityController();
	$redirect = "error404";
} 
$controller->$redirect();
?>