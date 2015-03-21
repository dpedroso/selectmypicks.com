$(document).ready(function(){
	
		// Add textarea updating for every control touched
		$("[id*='week']").click(function(){updateOutput();});
		$("[id*='mask']").click(function(){updateOutput();});
		$("[id*='game']").click(function(){updateOutput();});
		
		$("[id*='lgame']").click(function(){
			var g1 = 'a'+this.id.substring(1);
			var g2 = 'b'+this.id.substring(1);
			$('#'+g1).prop('checked', false);  
			$('#'+g2).prop('checked', false); 
			updateOutput();

		});

		function updateOutput(){

			$('.output').empty();

			
			var xml_file=loadXMLString("<games></games>");
			
			var game_start = 1;
			var i = 1;
			var game_over = false;
			var node_num = 0;
			var root_node;
			var winner = null;
			
			$('input[type=radio]').each(function () {
				//console.log(this.id);
				if(i%2!=0){
					if (this.checked) {
						game_over = true;
						winner = $(this).val();
					}
					else{
						loser = $(this).val();
					}
				}
				else{
					if(i%2==0){
						if (this.checked) {
							game_over = true;
							winner = $(this).val();
						}
						else{
							loser = $(this).val();
						}
						if(game_over){
						
							// Create element
							ele_game=xml_file.createElement("game");
							// Prepare Root Node
							root_node=xml_file.getElementsByTagName("games")[0];
							// Append Element To Root Node
							root_node.appendChild(ele_game);
							
							// Create element
							ele_winner=xml_file.createElement("winner");
							ele_loser=xml_file.createElement("loser");
							
							// Prepare Node
							node_game=xml_file.getElementsByTagName("game")[node_num];
							
							// Append Element to game node
							node_game.appendChild(ele_winner);
							node_game.appendChild(ele_loser);
							
							// Prepare Node
							node_winner=xml_file.getElementsByTagName("winner")[node_num];
							// Create Text Node
							txt_winner=xml_file.createTextNode(winner);
							// Append Text Node
							node_winner.appendChild(txt_winner);
							
							// Prepare Node
							node_loser=xml_file.getElementsByTagName("loser")[node_num];
							// Create Text Node
							txt_loser=xml_file.createTextNode(loser);
							// Append Text Node
							node_loser.appendChild(txt_loser);

							node_num++;
						}
						game_over = false;
						game_start++;
					}
				}
				i++;
			});
			if(winner==null){
				// Prepare Root Node
				root_node=xml_file.getElementsByTagName("games")[0];
			}
			
			// Create Element
			ele_mask=xml_file.createElement("mask");
			ele_week=xml_file.createElement("week");
			
			// Append Element To Root Node
			root_node.appendChild(ele_mask);
			root_node.appendChild(ele_week);
			
			// Prepare Node
			node_mask=xml_file.getElementsByTagName("mask")[0];
			// Create Text Node
			txt_mask=xml_file.createTextNode($('#mask').val());
			// Append Text Node
			node_mask.appendChild(txt_mask);
			
			// Prepare Node
			node_week=xml_file.getElementsByTagName("week")[0];
			// Create Text Node
			txt_week=xml_file.createTextNode($('#week').val());
			// Append Text Node
			node_week.appendChild(txt_week);

			$.post( "process/format_xml.php",  { xml : xml_to_string(xml_file) } )
				.done(function( data ) {
					$('#toutput').text(data);
				});
			
		}
		
		// Save/Write winners out to file
		$("#set_winners").click(function(){
			updateOutput();
			
			$.post( "set_winners.php",  { output : $('#toutput').text() } )
				.done(function( data ) {
					//alert(data);
				});
		});
		
		updateOutput();
});