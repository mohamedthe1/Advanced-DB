<?php

class Session
{
	public static function exists($session)
	{
		return isset($_SESSION[$session]);
	}

	public static function set($session,$value)
	{
		return $_SESSION[$session] = $value;
	}

	public static function destroy()
	{
		try
		{
			session_unset();
			session_destroy();
			return true;
		}
		catch(Exception $e)
		{
			die($e->getMessage());
		}
	}

	public static function get($session)
	{
		return $_SESSION[$session];
	}

}
