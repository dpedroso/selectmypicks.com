<?php 
	session_start();
?>

<!DOCTYPE html>
<html>

    <head>
	
		<title>Main</title>
        <meta charset="UTF-8">
	
		<!-- Load Jquery -->
		<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>

	</head>
	
	<body>
	
		<div id="outercontent">

		</div>

<?php
	
	if(isset($_SESSION['user'])){
	
		?> 
		
		<script>
			
			// Load main php page here with .load
			$('#outercontent').append("Welcome <?php echo $_SESSION['user'];?>![<button id='logout'>Logout</button>]");
			
			$('#logout').click(function(){

				$.post( "../security/app_post/logout.php" )
					.done( function( data ) {
						$('#outercontent').load('security/login.php').fadeIn("slow");
					});

			});
			
		</script>
		
		<?php
	}
	else{
	
		?> 
	
		<script>
		
			$('#outercontent').load('../security/login.php').fadeIn("slow");
			
		</script>
		
		<?php
		
	}
?>
	</body>
	
	<style>
		
		body,button{
			font-family: arial;
		}
		button{
			padding: 10px;
			background: white;
			border: none;
		}
		
	</style>

</html>