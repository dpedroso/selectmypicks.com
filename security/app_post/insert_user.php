<?php

	session_start();

	if(!(isset($_SESSION['first']) && isset($_SESSION['last']) && isset($_SESSION['email']) && isset($_SESSION['user']) && isset($_SESSION['pwd']))){
		echo "Some fields were not filled out!";
		return false;
	}
		
	$first = $_SESSION['first'];
	$last = $_SESSION['last'];
	$email = $_SESSION['email'];
	$user = $_SESSION['user'];
	$pwd = $_SESSION['pwd'];
		
		
	include_once ('db_connect.php'); 

	try{
		$pdo = PDODB::getInstance();
		$sql = "INSERT INTO user (FirstName,LastName,Email,Username,Pwd) VALUES (:first,:last,:email,:user,:pwd)";
		$q = $pdo->prepare($sql);
		$q->execute(array(':first'=>$first,':last'=>$last,':email'=>$email,':user'=>$user,':pwd'=>$pwd));
		
		echo "User Added!";
	}
	catch (PDOException $ex){
		echo $ex->getMessage();
	}

?>