	<!-- Logon Form - Left aligned -->
	<h1>Login</h1>
	<form action="" id="user_form">
		<table>
			<tr>
				<td class="label"><label for="user">Username:</label></td><td class="textbox"><input type="text" name="user" id="user"></td>
			</tr>
			<tr>
				<td class="label"><label for="pwd">Password:</label></td><td class="textbox"><input type="password" name="pwd" id="pwd"></td>
			</tr>
		</table>
	</form>
	<br />
	<a href="#" id="login" class="link">Login</a> | <a href="#" id="register" class="link">Register</a>
	
	<script>
		
		$('#login').click(function(){
			$.post( "../security/app_post/authenticate_user.php", $( "#user_form" ).serialize() )
				.done( function( data ) {
					$('#outercontent').load('../user/').fadeIn("slow");
				});
		});		
		
		$('#register').click(function(){
			$('#outercontent').load('../security/add_user.php').fadeIn("slow");
		});
		window.location.hash = 'login';

	</script>
	
	<style>
	.link{
		padding: 10px;
	}
	.label{
		text-align: right;
	}
	.textbox{
		text-align: left;
	}
	</style>