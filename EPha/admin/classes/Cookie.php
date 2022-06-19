<?php

class Cookie
{
	public static function set($cookie,$value,$expire)
	{
		return (setcookie($cookie,$value, time() + $expire,'/'));
	}

	public static function get($cookie)
	{
		return ($_COOKIE[$cookie]);
	}

	public static function exists($cookie)
	{
		return (isset($_COOKIE[$cookie]));
	}

	public static function destroy($cookie)
	{
		return (self::set($cookie, '', -604800));
	}


}
