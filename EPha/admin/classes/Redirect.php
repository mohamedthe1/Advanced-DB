<?php

class Redirect
{
	public static function to($location,$time = 2)
	{
		header("refresh:$time;url=$location");
	}
}