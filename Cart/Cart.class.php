<?php

/* Class For DB Connection  and cart
*  Rahulvramesh@hotmail.com
*/

class Cart
{
	private $dbhost; 
	
	private $dbuser;
	
	private $dbpass;
	
	private $db;
	
	private $STH;
	
	private $DBH;
	

	
	public function __construct()
	{
		include '../Config.php';
		$this->dbhost = $hm_host;
		$this->dbuser = $hm_user;
		$this->dbpass = $hm_pass;
		$this->db = $hm_db_name;
		//connectdb();
		//echo "hiii";
	}
	
	
	public function connectdb()
	{
		try {  
  			 // $DBH = new PDO("mysql:host=localhost;dbname=host_malabar", 'root', 'root'); 
            $this->DBH = new PDO("mysql:host=$this->dbhost;dbname=$this->db", $this->dbuser, $this->dbpass);  
			$this->DBH->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING ); 
			 //echo "done;";
			return 1;
			}  
		catch(PDOException $e) {  
    		 echo $e->getMessage();  
			 //file_put_contents('PDOErrors.txt', $e->getMessage(), FILE_APPEND);
			return 0;
			} 
			
		 
	}
	
	public function addcart($pkg)
	{
		 $userid = $_SESSION['hm_userid'];
		
		 try {
		 $DBH = new PDO("mysql:host=localhost;dbname=hostmala_account", 'hostmala_account', 'a&703115'); 
	  		$STH = $DBH->prepare("INSERT INTO `cart`(`no`, `userid`, `pkg`, `active`) VALUES (NULL,'$userid','$pkg',1)");  
			$STH->execute(); 
			$STH->setFetchMode(PDO::FETCH_OBJ); 
			$row = $STH->fetch();
			return 1;
			//header('Location: ../index.php?orderid='.$ord);
		}
		catch (PDOException $e){
			echo "Database error..!!";
		}
	}
	
	public function viewcart($userid,$cart)
	{
		$DBH=$this->DBH;
		$STH = $DBH->query("SELECT * FROM cart WHERE userid = $userid");   
		$STH->setFetchMode(PDO::FETCH_OBJ); 
		$row = $STH->fetch();
		echo $row->amount;
		//return $row;
		
	}
	
	public function getnumcart()
	
	{
		$userid = $_SESSION['hm_userid'];
		$DBH = new PDO("mysql:host=localhost;dbname=hostmala_account", 'hostmala_account', 'a&703115'); 
		//$STH = $DBH->query("SELECT COUNT(*) as num FROM cart WHERE userid = $userid");
                
                $STH = $DBH->prepare("SELECT COUNT(*) as num FROM cart WHERE userid = :id");
                $STH->bindValue(':id', $userid);
              
                $STH->execute();
				  $STH->setFetchMode(PDO::FETCH_OBJ);
                $result = $STH->fetch();
                return $result->num;
                
                
                
		//$STH->setFetchMode(PDO::FETCH_OBJ); 
		//$row = $STH->fetch();
		//return $row->num;
		
		//echo "0";
	}

	public function rmcart($orderid)
	{
		 $DBH=$this->DBH;
	 	 $sql = "DELETE FROM `cart` WHERE `orderid` = `$orderid`";
    	 $count = $DBH->exec($sql);
	}
	
	
	public function update($package,$userid,$amount)
	{
	
	}
	public function get_package($id)
	{
	   $DBH = new PDO("mysql:host=localhost;dbname=hostmala_account", 'hostmala_account', 'a&703115'); 
		//$STH = $DBH->query("SELECT COUNT(*) as num FROM cart WHERE userid = $userid");
                
                $STH = $DBH->prepare("SELECT * FROM hm_pkg WHERE pid = :id");
                $STH->bindValue(':id', $id);
              
                $STH->execute();
			    $STH->setFetchMode(PDO::FETCH_OBJ);
                $result = $STH->fetch();
				return $result;
				//print_r($result);
	}
	
	
	
	
	
};




?>