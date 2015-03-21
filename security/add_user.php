	<h1>Register</h1>
	<form action="" id="form">
		<table>
			<tr><td class="label"><label for="first">First Name:</label></td><td class="textbox"><input type="text" name="first" id="first"></td></tr>
			<tr><td class="label"><label for="last">Last Name:</label></td><td class="textbox"><input type="text" name="last" id="last"></td></tr>
			<tr><td class="label"><label for="email">Email Address:</label></td><td class="textbox"><input type="text" name="email" id="email"></td></tr>
			<tr><td class="label"><label for="user">Username:</label></td><td class="textbox"><input type="text" name="user" id="user"></td></tr>
			<tr><td class="label"><label for="pwd">Password:</label></td><td class="textbox"><input type="password" name="pwd" id="pwd"></td></tr>
		</table>
	</form>
	<div class="form_header" id="username_status"></div>
	<a href="#" id="login" class="link">Back to Login</a> | <a href="#" id="add_user" class="link">Add User</a>
	
	<script>
		$('#login').click(function(){
	
			$('#outercontent').load('../security/login.php').fadeIn("slow");
	
		});
		
		
		$('#add_user').click(function(){
		
			var fail = false;
			$.each($('input[type=text],input[type=password]'),function(){
				if($(this).val()==""){
					 $( '#' + this.id ).css( "background-color", "#FCD4D4" );
					fail = true;
				}
				else{
					$( '#' + this.id ).css( "background-color", "#BCF1D1" );
				}
			});
			
			if(fail){
				$('#username_status').html("<span class='notification'>You must fill out all fields!</span>");
				return false;
			}
			else{
				$('#username_status').html("");
			}
	
			$.post( "../security/app_post/user_exist.php", $( "#form" ).serialize() )
				.done(function( user_exist ) {
					user_exist = user_exist.trim();
					if( user_exist.indexOf("no") == 0 ){
						$.post( "../security/app_post/insert_user.php" )
							.done(function() {
								// If success, send to logout page or login them in with session
								$('#username_status').html("");
								$('#outercontent').load('../user/').fadeIn("slow");
							});
					}
					else{
						$('#username_status').html("<span class='notification'>Sorry, that username is already taken. Please try again!</span>");
						$('#user').val("");
						$('#pwd').val("");
					}
						
				});
		});
		window.location.hash = 'register';

	</script>
	
	<style>
		.notification{
			color: red;
			font-size: 13px;
		}
		#username_status{
			height: 20px;
		}
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