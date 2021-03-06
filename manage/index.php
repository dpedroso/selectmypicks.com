<!DOCTYPE html>
<html>
	
	<head>
		<title>Selectmypicks.com - Management</title>
		<!-- Load Jquery -->
		<link rel="stylesheet" href="http://code.jquery.com/ui/1.10.4/themes/smoothness/jquery-ui.css">
		<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
		<script src="http://code.jquery.com/ui/1.10.4/jquery-ui.js"></script>

		<!-- Load Custom JS -->
		<script src="js/loadxmlstring.js"></script>
		<script src="js/events.js"></script>

		<!-- Load Custom css -->
		<link rel="stylesheet" href="css/manage.css">
	</head>
	
	<body class="clearfix">

		<div class="form">
			<label for="week">Week:</label>
			<select id="week">
				<option>1</option>
				<option>2</option>
				<option>3</option>
				<option>4</option>
				<option>5</option>
				<option>6</option>
				<option>7</option>
				<option>8</option>
				<option>9</option>
				<option>10</option>
				<option>11</option>
				<option>12</option>
				<option>13</option>
				<option>14</option>
				<option>15</option>
				<option>16</option>
			</select>
			<label for="mask">Mask:</label>
			<select id="mask">
				<option>yes</option>
				<option>no</option>
			</select>
		</div>
		

		<!-- Load live games -->
		<div class='outterdivgames'>
			<?php 
			
			$i=1;
			$file = fopen("../data/games.txt", "r");
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

					$find = array("(At Toronto)","At ");
				
					// Define each part of the line data
					$team1 = str_replace($find,"",$games_lines_array[1]);
					$team2 = str_replace($find,"",$games_lines_array[3]);
			
					echo "<div class='games'>";
					echo "<br /><label id='lgame$i' for='game$i'>$team1</label><input type='radio' id='agame$i' name='game$i' value='$team1'>";
					echo "<br /><label id='lgame$i' for='game$i'>$team2</label><input type='radio' id='bgame$i' name='game$i' value='$team2'><br />";
					echo "</div>";
			
					$i++;
				}
			}
			// Close file
			fclose($file);
			
			?>
		</div>

		<!-- Data file preview -->
		<div class="outputdiv">
			<button id="set_winners">Set Winners</button><br /><br />
			<textarea id="toutput" rows="30" cols="100" readonly></textarea>
		</div>
	
		
	</body>
	
</html>