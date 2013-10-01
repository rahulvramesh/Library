<?php

/*
 * Session Handiler
 */

include 'dbCon.php';

class Session extends dbCon
{

	public function __construct()
	{
	 parent::__construct();
	 session_start();
	}

public function islogin()
{
	if(isset($_SESSION['hm_user']))
	{
		return 1;
	}
	else
		return 9;
}

public function login($user,$pass)
	{
		$pass = md5($pass);
		$STH = $this->DBH->prepare("SELECT *,COUNT(*) as valid FROM hm_account WHERE `email` = '$user' AND `password` = '$pass'"); 
		$STH->execute();
  
		$STH->setFetchMode(PDO::FETCH_OBJ); 
		$row = $STH->fetch();
		if($row->valid == 1)
		{
			$_SESSION['hm_user'] = $row->email;
			$_SESSION['hm_userid'] = $row->id;
			$_SESSION['hm_username'] = $row->name;
			return 1;
		}
		else 
		{
		 	return 0;
		}
		//print_r($row);
	
		

	}


}








?>