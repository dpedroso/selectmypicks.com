<?
	header("Access-Control-Allow-Origin: *");
	include("stored_procedure_calls.php");

	
	// Setup database access
	$servername = "localhost";
	$username = "pickuplo_test";
	$password = "test1234";
	$dbname = "pickuplo_test";

	// Create connection
	$conn = mysql_connect($servername, $username, $password);

	if (!$conn) {
		echo "Unable to connect to DB: " . mysql_error();
		exit;
	}

	if (!mysql_select_db($dbname)) {
		echo "Unable to select dbname: " . mysql_error();
		exit;
	}

/*********Passing URL Stored Procedure *********/
	
	// Extract call from URL
	$pos = strpos($_SERVER[REQUEST_URI], "?")+1;
	$sp_name =  substr($_SERVER[REQUEST_URI],$pos);
	
	$args = array();
	foreach($_POST as $key => $value)
		$args[$key]=$value;

	// Call stored procedure from url
	call($sp_name, $args);

/********* END Passing URL Stored Procedure *********/
	
	// Close connection
	mysql_close($conn);
		
?>
