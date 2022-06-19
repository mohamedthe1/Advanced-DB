<?php

class Hash
{
	public static function makeHash($password, $salt = NULL)
	{
		return SHA1($password . $salt);
	}

	public static function makeSalt()
	{
		return rand(1000000,100000000);
	}

	public static function unique()
	{
		return self::makeHash(self::makeSalt(),self::makeSalt());
	}
}
