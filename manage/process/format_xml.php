<?php

// Make sure its a post call from the website only
if( $_SERVER['HTTP_REFERER'] == "http://manage.selectmypicks.com/" ){

	$dom = new DOMDocument;
	$dom->preserveWhiteSpace = FALSE;
	$dom->loadXML(stripslashes($_POST['xml']));
	$dom->formatOutput = TRUE;
	echo $dom->saveXml();
	
}

?>