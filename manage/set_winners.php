<?php// Make sure its a post call from the website onlyif( $_SERVER['HTTP_REFERER'] == "http://manage.selectmypicks.com/" || (strpos($_SERVER['HTTP_REFERER'], "localhost")>-1) ){	// Open file	$myfile = fopen("../data/settings.xml", "w") or die("Unable to open file!");		// Save xml output passed in, to a file	fwrite($myfile, stripslashes($_POST['output']));	echo "\nSuccessfully written!";	// Close file	fclose($myfile);}else{	// Attempted hack	echo "You must login first!";}?>