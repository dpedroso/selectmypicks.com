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
	
	// Extract calls and args from URL
	$pos = strpos($_SERVER[REQUEST_URI], "?")+1;
	$sp_name_args =  substr($_SERVER[REQUEST_URI],$pos);

	$delimeter = "|";
	// Separate call and args
	$sp_name_args = explode($delimeter,$sp_name_args);
	
	// Assign stored procedure name
	$sp_name = $sp_name_args[0];

	// Build out argument array
	for($c=1;$c<sizeof($sp_name_args);$c++)
		$args[] = $sp_name_args[$c];
	
	// Call stored procedure from url
	call($sp_name, $args);

/********* END Passing URL Stored Procedure *********/
	
	// Close connection
	mysql_close($conn);
		
?>
