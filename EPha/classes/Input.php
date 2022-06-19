<?php

class Input
{
	public static function exists($request)
	{
		if(isset($_SERVER['REQUEST_METHOD']) && $_SERVER['REQUEST_METHOD'] === $request)
		{
			return true;
		}
		else if(isset($_SERVER['REQUEST_METHOD']) && $_SERVER['REQUEST_METHOD'] === $request)
		{
			return true;
		}
		else
		{
			return false;
		}
	}
	public static function get($attribute,$method = "POST")
	{

		if($method === "GET")
		{
			if(isset($_GET[$attribute]))
			return $_GET[$attribute];
		}
		else
		{
			if(isset($_POST[$attribute]))
			return $_POST[$attribute];
			
		}
		return "";
		
	}




	
}