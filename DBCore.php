<?php

class DBCore
{
	private $db, $dbName, $dbAddr, $dbPort, $dbUser, $dbPassword;
	
	public function DBCore()
	{
		include('dbcd.php');
		$this->dbAddr = $_dbhost . ":".  $_dbport;
		$this->dbPassword = $_dbpass;
		$this->dbName = $_db;
		$this->dbUser = $_dbuser;
	}
	
	public function Connect()
	{
		try
		{
			$this->db = new PDO("mysql:host={$this->dbAddr};dbname={$this->dbName};charset=utf8", $this->dbUser, $this->dbPassword, array(PDO::ATTR_PERSISTENT => true));  
			$this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		}
		catch(PDOException $e)
		{
			echo "Internal Database Error";
			die();
		}
	}
	
	public function FetchData($query, $query_params = array())
	{
		try
		{
			$stmt = $this->db->prepare($query); 
			
			if(count($query_params) > 0)
				$stmt->execute($query_params); 
			else
				$stmt->execute();
			
				return $stmt->fetchAll();
		}
		catch(PDOException $e)
		{
			echo "Internal Database Error" ;
			die();
		}
	}
	
	public function RunQuery($query, $query_params = array())
	{
		try
		{
			$stmt = $this->db->prepare($query); 
			
			if(count($query_params) > 0)
				$result = $stmt->execute($query_params); 
			else
				$result = $stmt->execute();
			return  $result;
		}
		catch(PDOException $e)
		{
			echo "Internal Database Error";
			die();
			
		}
	}		
}

?>
