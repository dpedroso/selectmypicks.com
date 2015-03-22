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
		echo "Unable to select mydbname: " . mysql_error();
		exit;
	}

	
	// Extract calls and args from URL
	$sp_name_args =  explode("?",$_SERVER[REQUEST_URI]);
	
	// Separate call and args
	$sp_name_args = explode("&",$sp_name_args[1]);
	
	// Assign stored procedure name
	$sp_name = $sp_name_args[0];
	
	// Build out argument array
	for($c=1;$c<sizeof($sp_name_args);$c++)
		$args[] = $sp_name_args[$c];
	
	// Call stored procedure from url
	call($sp_name, $args);

	
	
	// Close connection
	mysql_close($conn);
		
?>