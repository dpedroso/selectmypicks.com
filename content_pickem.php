	<div id="time"></div>	<div class="game" style="padding-bottom: 30px;">		<button id="randombutton" class="smbutton">Random Teams23</button><button id="favoredbutton" class="smbutton">Favored Teams</button><button id="homebutton" class="smbutton">Home Teams</button>	</div><br />
	<div class="game" style="padding-bottom: 30px;">
		<label for="name">Name: <input type="text" id="name" maxlength="20"></label>
		<label for="email">Email: <input type="text" id="email"></label>
	</div>	
	<?php
	$num = 0;
	$file = fopen("data/games.txt", "r");
	while(!feof($file)){
		// Read File
		$line = fgets($file);
		
		if(strpos($line, "WEEK:")){ 
			$week_line = explode(':', $line);
			$week = $week_line[1];
		}
		else{
			// Split the line into an array
			$games_lines_array = explode(',', $line);
			// Define each part of the line data
			$time = $games_lines_array[0];
			$team1 = $games_lines_array[1];
			$odds = $games_lines_array[2];
			$team2 = $games_lines_array[3];
			$overunder = $games_lines_array[4];
			$find = array();			$find[0] = "(At Toronto)";			$find[1] = "At ";
			// Add radio controls to form
			?>			
			<div class="time"><?php echo $time;?></div>
			<div class="game">
				<button class="notactive" id="game_button<?php echo $num;?>a" value="<?php echo str_replace($find,"",$team1);?>"><?php echo $team1;?> <?php echo $odds;?></button> 
				<button class="notactive" id="game_button<?php echo $num;?>b" value="<?php echo str_replace($find,"",$team2);?>"><?php echo $team2;?> <?php echo str_replace("-","+",$odds);?></button>
			</div>
			<?php
			$num++;
		}
	}	
	?>
		<script>						// Set the number of games			var num = <?php echo $num; ?>;						$("#randombutton").click(function(){									for (g = 0; g < num; g++) { 										// Clear game buttons					$( '#game_button'+g+'a').toggleClass( 'gameselected', false );					$( '#game_button'+g+'b').toggleClass( 'gameselected', false );										// Generate random Pick					random = Math.floor((Math.random() * 2) + 1); 					if(random==1)						$( '#game_button'+g+'a').toggleClass( 'gameselected', true );					else						$( '#game_button'+g+'b' ).toggleClass( 'gameselected', true );				}							});			$("#favoredbutton").click(function(){						for (g = 0; g < num; g++) { 										// Clear game buttons					$( '#game_button'+g+'a').toggleClass( 'gameselected', false );					$( '#game_button'+g+'b').toggleClass( 'gameselected', false );										$( '#game_button'+g+'a').toggleClass( 'gameselected', true );				}							});						$("#homebutton").click(function(){						for (g = 0; g < num; g++) { 										// Clear game buttons					$( '#game_button'+g+'a').toggleClass( 'gameselected', false );					$( '#game_button'+g+'b').toggleClass( 'gameselected', false );										var teama = $('#game_button'+g+'a').text();					var teamb = $('#game_button'+g+'b').text();					if(teama.indexOf("At")>-1)						$( '#game_button'+g+'a').toggleClass( 'gameselected', true );										if(teamb.indexOf("At")>-1)						$( '#game_button'+g+'b').toggleClass( 'gameselected', true );				}							});			
			$("[id*='game_button']").click(function(){								//$('.content').children('div').children('button').each(function () {
					// Remove active class from all elements
					$( '#' + this.id.substring(0,this.id.length-1) + 'a' ).toggleClass( 'gameselected', false );
					$( '#' + this.id.substring(0,this.id.length-1) + 'b' ).toggleClass( 'gameselected', false );
					// Set the element that was clicked to active
					$( '#' + this.id ).toggleClass( 'gameselected', true );				//});				
			});
		</script>
	<?php
		
	// Close file
	fclose($file);
	echo '<br /><div class="game"><button id="submit" class="button">Submit</button></div><br />';
	?>	
	<!-- Submit Form Here -->
	<script>		
		$("#submit").click(function(){	
			var i = 0; var picks = new Array();
			$('.content').children('div').children('button').each(function () {
				if(this.className=='notactive gameselected'){
					picks[i]=this.value;
					i++;
				}	
			});
			<!-- validation -->
			var pass = true;
			var message='';
			var error_color = '#E6ACB5';

			<!-- Check email filled out -->
			var email = $('#email').val();
			var atpos = email.indexOf("@");
			var dotpos = email.lastIndexOf(".");
			if (atpos< 1 || dotpos<atpos+2 || dotpos+2>=email.length) {
				message = message + '\nNot a valid e-mail address';
				$('#email').css('background', error_color);
				pass = false;
				$( '#email' ).focus();
			}
			else
				$('#email').css('background', '#fff');
			<!-- Check name filled out -->
			if($('#name').val() == ''){
				message = message + '\nPlease enter your name!';
				$('#name').css('background', error_color);
				pass = false;
				$( '#name' ).focus();
			}
			else
				$('#name').css('background', '#fff');
				
			<!-- Check that all games were picked -->
			var number = <?php echo $num ?>;
			var num_games = picks.length;

			if(number != num_games){
				message = message + '\nYou only picked '+num_games+' of '+number+' games. Please chose a winner for all games!';
				pass = false;
			}
			
			<!-- Display any error messages and abort -->
			if(pass == false){
				alert(message);
				$('html, body').animate({ scrollTop: 0 }, "slow");
				return false;
			}
			<!-- end validation -->
		
			$.post( "process/submit_picks.php",  { status : $('#time').html(), picks : picks.toString(), week : <?php echo $week; ?>, name : $('#name').val(), email : $('#email').val() } )
				.done(function( data ) {
					if(data=="Your picks were submitted successfully!"){
						$('.content').load("content_results.php");
						$( "#results-button" ).trigger( "click" );						$( "*" ).scrollTop( 0 );
					}
					else
						alert(data);
				});
		});
	</script>
	
	
