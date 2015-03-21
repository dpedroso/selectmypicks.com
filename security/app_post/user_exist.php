<?php

	session_start();
	
	include_once ('db_connect.php'); 
	include_once ('../app_functions/hash_pwd.php'); 
	
	//if user does not exist and valid, add to session	
	
	try{
		$pdo = PDODB::getInstance();
		$sql = "SELECT * FROM user WHERE Username = :username";
		$stmt = $pdo->prepare($sql);
		$stmt->bindParam(':username', $_POST['user'], PDO::PARAM_STR);
		$stmt->execute();
		$total = $stmt->rowCount();
		
		if($total==0){
			
			$_SESSION['user'] = $_POST['user'];
			$_SESSION['pwd'] = hash_pwd($_POST['pwd']);
			
			$_SESSION['first'] = $_POST['first'];
			$_SESSION['last'] = $_POST['last'];
			$_SESSION['email'] = $_POST['email'];
		
			echo "no";
		}
		else
			echo "yes";
		
	}
	catch (PDOException $ex){
		echo $ex->getMessage();
	}

?>