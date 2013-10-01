<?php

/*
 * Class To Instantiate db connection
 */



class dbCon {
	
	
	public $dbhost;
	
	public $dbuser;
	
	public $dbpass;
	
	public $db;
	
	public $STH;
	
	public $DBH;
	
	
	
	public function __construct()
	{
		
		include 'Config.php';
		$this->dbhost = $bt_host;
		$this->dbuser = $bt_user;
		$this->dbpass = $bt_pass;
		$this->db = $bt_db_name;
		try {
			
			$this->DBH = new PDO("mysql:host=$this->dbhost;dbname=$this->db", $this->dbuser, $this->dbpass);
			$this->DBH->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING );
			
		}
		catch(PDOException $e) {
		
    		 echo $e->getMessage();  
			 
			
		}
			
	}
	
	

}

?>