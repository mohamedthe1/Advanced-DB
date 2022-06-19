<?php


error_reporting(0);
$cssRoute = "layout/css/";
$jsRoute = "layout/js/";

$tempRoute = "includes/temps/";

spl_autoload_register(function($class)
{
	require_once "classes/" . $class . ".php";
});

require_once $tempRoute . "header.php";

if(isset($navbar))
{
	require_once $tempRoute . "navbar.php";
}
