<?php

    // Used to call stored procedures
	function call($name, $args){
	
		$data = mysql_query("call ".$name."(".get_arg_values($args).")");
		
		if($data==true){
		
			// Build an array of data
			while($row = mysql_fetch_assoc($data)){
				$data_array[] = $row;
			}		
			
			// Output JSON string
			echo json_encode($data_array);
		}

	}
	
	function get_arg_values($args){
	
		if(sizeOf($args)==0)
			return "";
			
		$arg_str = "";
		foreach($args as $arg){
			$k_v = explode("=",$arg);
			$arg_str.=$k_v[1].",";
		}
		return rtrim($arg_str, ",");
	}
	
?>
