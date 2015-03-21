<?php
	$file = fopen("../data/games.txt", "r");
	$datetime = fgets($file);
	fclose($file);

	$datetime_array = explode( " ", $datetime );
	$mmdd = explode( "/", $datetime_array[0] );
	$month = $mmdd[0];
	$day = $mmdd[1];
	date_default_timezone_set('America/New_York');
	$time = $datetime_array[1];


	// Sample $date1 = strtotime('2014-06-17 21:45:00');
	$date1 = strtotime('2015-'.$month.'-'.$day.' '.date("g:iA", strtotime($time.' pm')));
	$date2 = time();
	$subTime = $date1 - $date2;

	$y = ($subTime/(60*60*24*365));
	$d = ($subTime/(60*60*24))%365;
	$h = ($subTime/(60*60))%24;
	$m = ($subTime/60)%60;
	$s = $subTime % 60;

	if($d==0||$d<0)
		if($h==0||$h<0)
			if($m<=0||$h<0){
				echo "<br / >Sorry, You Missed Kick Off This Week!";
				return false;
			}

	echo "<p>".$d." day(s) ".$h." hour(s) ".$m." minute(s) ".$s." until kickoff</p>";
?>