<?php

class Admin
{
	private $_db;
	private $_data;
	private $_session = 'userSession';
	private $_cookie = 'userCookie';
	private $_isLoggedIn = false;

	public function __construct()
	{
		$this->_db = new DB();

		if(Session::exists($this->_session))
		{

			$admin = Session::get($this->_session);
			$this->_isLoggedIn = true;
			$data = $this->_db->getAllFrom("*","admins","WHERE Username = ?",array($admin));
			$this->_data = $data->getFirstResult();

		}
		//print_r($this->data());
	}

	public function login($username,$password,$remember = NULL)
	{
		if($this->find($username))
		{
			if($this->data()['Password'] === Hash::makeHash($password,$this->data()['salt']))
			{
				Session::set($this->_session,$this->data()['Username']);

				if($remember)
				{
					$hash = Hash::unique();

					$checkCookie = $this->_db->getAllFrom("*","admin_sessions","WHERE Username = ?",array($this->data()['Username']));

					if($checkCookie->getCount() > 0)
					{
						$hash = $checkCookie->getFirstResult()['Hash'];
					}
					else
					{
						$this->_db->insertIn("admin_sessions",array(
							"Username"	=> $this->data()['Username'],
							"Hash"		=> $hash
						));

					}

					Cookie::set($this->_cookie,$hash,604800);
					$this->_isLoggedIn = true;
				}

				return true;
			}
		}
		return false;
	}

	public function find($admin)
	{

		$data = $this->_db->getAllFrom("*","admins","WHERE Username = ?",array($admin));

		if($data->getCount() > 0)
		{

			$this->_data = $data->getFirstResult();

			return true;
		}
		return false;

	}

	public function data()
	{
		return $this->_data;
	}

	public function IsLoggedIn()
	{
		return $this->_isLoggedIn;
	}

	public function logout()
	{
		$this->_db->deleteFrom("admin_sessions","WHERE Username = ?",[$this->data()['Username']]);
		Cookie::destroy($this->_cookie);
		Session::destroy();
		header("Location:login.php");

	}

}
