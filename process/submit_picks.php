<?php

if( !(strpos($_SERVER['HTTP_REFERER'], "selectmypicks.com") > 0) ){
	return false;
}

	$name = $_POST['name'];
	$email = $_POST['email'];
	$week = $_POST['week'];
	
	// Check for null values, back end
	if($name == "" || $email == "" || $week == "" ){
		echo "There is a problem, please try again!";
		return false;
	}
		
	$xml = new DOMDocument();
	$xml->load('../data/picks.xml');
	$xml->formatOutput = true;

	$base_node = $xml->getElementsByTagName('picks')->item(0);
	
	$new_pick = $xml->createElement("week".$week);

	$name_element= $xml->createElement("name");
	$name_element->nodeValue = $name;
	$new_pick->appendChild($name_element);
	$email_element = $xml->createElement("email");
	$email_element->nodeValue = $email;
	$new_pick->appendChild($email_element);

	// Handle picks
	$pick_elements = array();
	$picks = explode(",", $_POST['picks']);
	$i = 1;
	foreach($picks as $pick){
		if($pick != ""){
			$pick_elements[$i]= $xml->createElement("game".$i);
			$pick_elements[$i]->nodeValue = $pick;
			$new_pick->appendChild($pick_elements[$i]);
			$i++;
		}
	}
				
	$base_node->appendChild($new_pick);

	umask();
	$xml->save("../data/picks.xml");

	// Send email copy
	$from = 'submissions@selectmypicks.com';

	$subject = 'Week'.$week.' Pickems';

	$headers = "From: " . strip_tags($from) . "\r\n";
	$headers .= "Reply-To: ". strip_tags($from) . "\r\n";
	$headers .= "CC: ".$from."\r\n";
	$headers .= "MIME-Version: 1.0\r\n";
	$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";

	$message = "<html><body>";
	$message .= "<h1>Hello ".$name.",</h1>";
	$message .= "<h2>Here are your picks for week ".$week.". Good luck!</h2>";
	foreach($picks as $pick){
		$message .= $pick."<br />";
	}
	$message .= "</body></html>";

	mail($email, $subject, $message, $headers);

	echo "Your picks were submitted successfully!";

?>