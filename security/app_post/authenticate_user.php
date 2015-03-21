<?php

	$user = $_POST['user'];
	$pwd = $_POST['pwd'];
       
	include_once ('db_connect.php'); 
	include_once ('../app_functions/hash_pwd.php'); 

	try{
	
		$pdo = PDODB::getInstance();
		$sql = "SELECT Pwd FROM user WHERE Username = :username";
		$stmt = $pdo->prepare($sql);
		$stmt->bindParam(':username', $user, PDO::PARAM_STR);
		$stmt->execute();
		$row = $stmt->fetch(PDO::FETCH_ASSOC);
		$hash_pass = $row['Pwd'];
		
		if (hash_pwd($pwd) == $hash_pass){
			echo "validated credentials";
			// Create session
			session_start();
			$_SESSION['user'] = $_POST['user'];
			$_SESSION['pwd'] = hash_pwd($_POST['pwd']);
		}
		else
			echo "invalid credentials";
	
	}
	catch (PDOException $ex){
		echo $ex->getMessage();
	}
	  
?>