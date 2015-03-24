<?php

	// Inserts
	// webapi/?insert_new_user|name|email
	
	// Updates
	// webapi/?update_user_by_id|id|email
	
	// Selects
	// webapi/?select_user_by_id|id
	// webapi/?select_all_users

    // Used to call stored procedures
	function call($name, $args){

		$type = explode("_",$name);
	
 		switch($type[0]){
			case "insert":
				mysql_query("call ".$name."(".get_arg_values($args).")");
				$last_insert_id = mysql_fetch_row(mysql_query("select last_insert_id()"));
				echo $last_insert_id[0];
				break;			
			case "select":
				$data = mysql_query("call ".$name."(".get_arg_values($args).")");
				select_data($data);
				break;			
			case "update":
				mysql_query("call ".$name."(".get_arg_values($args).")");
				break;			
			case "delete":
				mysql_query("call ".$name."(".get_arg_values($args).")");
				break;
			default:
				return false;
			break;
		} 
		//echo mysql_error();
	}
	
	function select_data($data){
	
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
	
		// no args = return
		if(sizeOf($args)==0)
			return "";
			
		$arg_str = "";
		foreach($args as $arg){
			// ex. 'John Smith',
			$arg_str.="'".urldecode($arg)."'".",";
		}
		// Trim last comma from argument string
		return rtrim($arg_str, ",");
	}
	
?>
