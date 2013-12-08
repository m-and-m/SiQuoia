<?php

/* Check the string if it has a certain string (needle)
return - true(or, 1) if the string has a needle
return - false if the string dosn't has a needle
*/
function find_category($hay, $needle){
 if($hay == null) {
	return false;
 }
$charlen_needle = strlen($needle);

$textpos = text_match($hay, $needle, $charlen_needle);
$numpos = is_numeric(substr($hay, $charlen_needle, 1));
 
 if($textpos && $numpos) {
 	return true;
 }
 
 return false;
} // find_category

/* Check if the string has numeric after category
return - true(or, 1) if the string has a needle
return - false if the string dosn't has a needle
*/
function text_match($hay, $needle, $charlen) {

 for($i = 0; $i < $charlen; $i++) {
	
	$needle_char = substr($needle, $i, 1);
	$hay_char = substr($hay, $i, 1);
	
	if($needle_char != $hay_char) {
		return false;
	}
 }
 return true;
} // text_match

function check_trial_used($userid, $quizid){
	// Get packet information
	$query9  = "select p_name from packet where packetid='".$quizid."'";
	$result9 = pdo_query($query9);    
	$packet_item = $result9->fetch(PDO::FETCH_ASSOC);

	// if the packet is trial, check the usedtrial to true/1
	$result = strcmp($packet_item["p_name"],"trial");
	if($result == 0) {
		$query10  = "update user_data set usedtrial = true where userid='".$userid."'";
		$result10 = pdo_query($query10);    
		if($result10 == false) {
			print("fail update usedtrial");
		}
	}

 } // check_trial_used
 
// If the user has the savedquiz, delete it
function delete_savedquiz($user_item, $userid) {
	if($user_item["savedquiz"] != null) {
		$query4  = "update user_data set savedquiz = null where userid='".$userid."'";
		$result4 = pdo_query($query4); 

		if($result4 == false) {
			print("Failed to delete the savedquiz.<br/>");
   	 }  
	}
} // delete_savedquiz

server_disconnect();
?>