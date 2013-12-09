<?php

    $host = "localhost";
    $user = "root";
    $pass = "";
    $database = "cs160";

	$connection = mysqli_connect($host, $user, $pass) or die('Could not connect: ' . mysql_error());
    	
/**
* function increments userpoint and usercredit by $point
* @return nothing
*/
	function addPoint($userid, $point)	{
		$query = "UPDATE user_data 
		SET suerpoint=userpoint + " . $point . ", usercredit=usercredit +" . $point
		. " WHERE userid='" . $userid . "'";	
		    $result = mysql_query($connection, $query);
		if (!$result) {
    		$message  = 'Invalid query: ' . mysql_error() . "\n";
    		$message .= 'Whole query: ' . $query;
    		die($message);
		}
	}
	
/**
* function decrements usercredit by $point
$ userpoint remains the same beacuse it is a running tally of total collected points
* @return nothing
*/
	function spendPoint($userid, $point){
		$query = "update user_data
		SET usercredit=usercredit - " . $point
		. " WHERE userid='" . $userid . "'";	
			    $result = mysql_query($connection, $query);
		if (!$result) {
    		$message  = 'Invalid query: ' . mysql_error() . "\n";
    		$message .= 'Whole query: ' . $query;
    		die($message);
		}
	}
