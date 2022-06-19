<?php

class DB
{
	private $_pdo = NULL;
	private $_query;
	private $_result = array();
	private $_error = false;
	private $_count;

	public function __construct()
	{

		$this->connectDB();

	}

	public function connectDB()
	{
		try
		{

			$dsn = "mysql:host=127.0.0.1;dbname=pharmacy";
			$username = "root";
			$password = "";
			$option	= array(
				PDO::MYSQL_ATTR_INIT_COMMAND	=> "SET NAMES utf8"
			);
			
			$this->_pdo = new PDO($dsn,$username,$password,$option);
			$this->_pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

		}
		catch(PDOException $e)
		{
			die($e->getMessage());
		}


	}

	public function query($sqlQuery,$params = array())
	{
		if($this->_query = $this->_pdo->prepare($sqlQuery))
		{

			if(count($params) > 0)
			{

				$paramNumber = 1;

				foreach ($params as $param) {

					$this->_query->bindValue($paramNumber,$param);

					$paramNumber++;
				}
			}

			try
			{

				if($this->_query->execute())
				{

					if(strcmp(substr($sqlQuery, 0,6), "SELECT") == 0)
					{
						$this->_result = $this->_query->fetchAll();
						$this->_count = $this->_query->rowCount();

					}
				}
			}
			catch(PDOException $e)
			{
				die($e->getMessage());
				$this->_error = true;
			}
		}
		return $this;
	}

	public function getAllFrom($field, $table, $condition = NULL, $params = array())
	{
		$sqlQuery = "SELECT {$field} FROM {$table} {$condition}";

		return $this->query($sqlQuery,$params);
	}

	public function deleteFrom($table, $condition = NULL,$params = array())
	{
		$sqlQuery = "DELETE FROM {$table} {$condition}";
		return $this->query($sqlQuery,$params);
	}

	public function insertIn($table,$fields = array())
	{
		$keys = array_keys($fields);
		$keys = '(`' . implode('`,`', $keys) . '`)';

		$values = "(";
		for($i = 0 ; $i < count($fields) ; $i++)
		{
			$values .="?";
			if($i < count($fields) - 1)
				$values .= ",";
		}
		$values .=")";

		$sqlQuery = "INSERT INTO {$table}{$keys} VALUES {$values}";
		return $this->query($sqlQuery,$fields);
	}

	public function updateTable($table,$condition,$fields)
	{
		$str = "";
		$keys = array_keys($fields);

		for($i=0;$i<count($fields);$i++)
		{
			$str .= "`{$keys[$i]}` = ?";
			if($i < count($fields) - 1)
			{
				$str .= ", ";
			}
		}
		$sqlQuery = "UPDATE `{$table}` SET {$str} {$condition}";
		return $this->query($sqlQuery,$fields);
	}

	public function getResult()
	{
		return $this->_result;
	}

	public function getFirstResult()
	{
		return $this->getResult()[0];
	}


	public function getCount()
	{
		return $this->_count;
	}

	public function getError()
	{
		return $this->_error;
	}

}
