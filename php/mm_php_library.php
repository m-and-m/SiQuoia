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

function dump_array_pretty($array) {

	print("<pre>");
	print_r($array);
	print("</pre>");

} // dump_array_pretty

function display_question_contents($quiz_set, $load_count, $isResume) {
	$curr_qid = $quiz_set[($load_count)]["id"];
	$query1  = "select * from question where qid='".$curr_qid."'";
	$result1 = pdo_query($query1);    
	$user_item = $result1->fetch(PDO::FETCH_ASSOC);

	print("<div id='question_content'><p>".$user_item['question']."</p>");
	if($user_item['media'] != null) {
		print("<p>".$user_item['media']."</p>");
	}
	print("</div>");
	
	print("<div id='question_answer'><form action='verify_answer.php' id='select_answer' method='post'>");
	print("<label><input type='radio' name='answer' value='1'/>&nbsp;".($user_item['answer1'])."</label><br/>");
	print("<label><input type='radio' name='answer' value='2'/>&nbsp;".($user_item['answer2'])."</label><br/>");
	print("<label><input type='radio' name='answer' value='3'/>&nbsp;".($user_item['answer3'])."</label><br/>");
	print("<label><input type='radio' name='answer' value='4'/>&nbsp;".($user_item['answer4'])."</label><br/><br/>");

	print("<input type='hidden' name='isResume' value='".($isResume)."'/>");
	print("<input type='hidden' name='load_count' value='".($load_count)."'/>");
	print("<input type='hidden' name='curr_qid' value='".($curr_qid)."'/>");
	print("<input type='submit' value='CONTINUE'/><br/></form></div>");

//DELETME
print("Current QID: ".$curr_qid."<br/>");
print("correct answer: ".$user_item["correct_answer"]."<br/><br/>");

} // display_question_contents

function display_prequestion_result($previous_answer) {
	print("<div id='prev_q_result'>");
  	// if the previous_answer doesn't have any value -> it means first question
	if(($previous_answer != null) && ($previous_answer == true)) {
		print("<p>In Previous Quiz, You Got <b>CORRECT!</b><br/><hr/>"); 
	} elseif (($previous_answer != null) && ($previous_answer == false)) {
		print("<p>In Previous Quiz, You Got <b>INCORRECT.</b><br/><hr/>"); 
	} else {
	}
	print("</p></div>");

} // display_prequestion_result

function check_trial_used($userid, $quizid){
/*
	// Get packet information
	$query9  = "select p_name from packet where packetid='".$quizid."'";
	$result9 = pdo_query($query9);    
	$packet_item = $result9->fetch(PDO::FETCH_ASSOC);
*/
	// if the packet is trial, check the usedtrial to true/1
	if($quizid == "p1") {
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