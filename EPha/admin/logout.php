<?php

session_start();

require_once "core/init.php";

$admin = new Admin();

if($admin->IsLoggedIn())
{
	$admin->logout();
}
