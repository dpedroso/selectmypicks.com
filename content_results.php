<?php 
	
	$xml=simplexml_load_file("data/picks.xml");
	$settings=simplexml_load_file("data/settings.xml");

	$week = "";
	$mask = "";
	$winners_array = array();
	$losers_array = array();
	foreach($settings->children() as $games) {
		switch($games->getName()){
		
			case "week":
				$week = $games;
			break;			
			case "mask":
				$mask = $games;
			break;			
			case "game":
				foreach($games as $game){
					switch($game->getName()){
						case "winner":
							$winners_array[] = $game;						
						break;			
						case "loser": 
							$losers_array[] = $game; 
						break;
					}
				}
			break;
		}
	} 
	
	echo "<div class='outer_results'>"; 

	foreach($xml->children() as $games) {
	    if($games->getName() == "week".$week){
			echo "<div class='results'>";
			$wins = 0;
		    foreach($games as $child) {
		   
				if($child->getName()=="name"){
					echo $child."<br/>";
					$name = $child;
				}
				if($child->getName()=="email"){
					$email = $child;
				}
			
				if(strpos($child->getName(),"game")>-1){
					if($mask =="yes")
						echo "<span style='color: #fff;'>*********</span><br/>";
					else{
						if(is_winner($child)== true){
							$wins++;
							echo "<span style='color: green;'>".$child."</span><br/>";
						}
						else if(is_loser($child)== true){
							echo "<span style='color: #EC5D4E;'>".$child."</span><br/>";
						}
						else{
							echo "<span style='color: #fff;'>".$child."</span><br/>";
						}
					}
				}
				
		    }
		    echo $wins."</div>";
	    }
	}
	echo "</div>";

	function is_winner($team){
	
		global $winners_array;
		
		foreach($winners_array as $w){
			if( strcmp($w,$team) == 0)
				return true;
		}
		return false;
	}
	
	function is_loser($team){
	
		global $losers_array;
		
		foreach($losers_array as $w){
			if( strcmp($w,$team) == 0)
				return true;
		}
		return false;
	}
?>
