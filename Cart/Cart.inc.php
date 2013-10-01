<?php

/* Class For DB Connection  and cart
*  Rahulvramesh@hotmail.com
*/


include 'dbCon.php';

class Cart extends dbCon
{
	public function __construct()
	{
		 parent::__construct();
		 session_start();
		
	}



	public function pushCart($pckgid,$pckgid)
	{
		if(!isset($_SESSION['hm_user']))
		{
			return 9; // 9 - Not Login
		}
		else
		{
			try{
			$userid = $_SESSION['hm_user'];
	  		$STH = $this->DBH->prepare("INSERT INTO `cart`(`id`, `userid`, `pckgid`, `date`,`status`) VALUES (NULL,'$userid','$pckgid',CURDATE(),1)");  
			$STH->execute(); 
			$STH->setFetchMode(PDO::FETCH_OBJ); 
			$row = $STH->fetch();
			return 1;
			//echo "kkk";
			}
			catch (PDOException $e){
				return 0;
				//echo "sry";
			}
		}

		public function viewCart()
		{
			if(!isset($_SESSION['hm_user']))
		{
			return 9; // 9 - Not Login
		}
		else{
			$userid = $_SESSION['hm_user'];
			$STH = $this->DBH->prepare("SELECT * FROM `cart` WHERE userid = `$userid`");  
			$STH->execute(); 
			$STH->setFetchMode(PDO::FETCH_OBJ); 
			$row = $STH->fetch();
			return $row; // sent the entire row details
			}
		}
	
	}


}




?>