<?php

class Redirect
{
	public static function to($location,$time = 10)
	{
		header("refresh:$time;url=$location");
	}
}