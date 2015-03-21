<?php

	function hash_pwd($pass){
		
		$salt = "C45C!45tvGTb@g455Bdd";
		$pass =  $pass.$salt;
		return sha1($pass);
			
	}

?>


