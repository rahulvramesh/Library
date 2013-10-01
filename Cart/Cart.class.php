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

	}

	public function test()
	{
		print_r($this->DBH);
	}
}




?>