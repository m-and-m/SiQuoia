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

/* Display array with new space
*/
function dump_array_pretty($array) {

	print("<pre>");
	print_r($array);
	print("</pre>");

} // dump_array_pretty

/* Display 2d array with new space
*/
function dump_array2d_pretty($array2d) {
	
	print("<pre>");
	foreach($array2d as $row) {
		var_dump($row);
	}
	print("</pre>");

} // dump_array_pretty

/* Display question contents including text and multimedia
*/
function display_question_contents($quiz_set, $load_count, $isResume) {

	$curr_qid = $quiz_set[($load_count)]["id"];
	$query1  = "select * from question where qid='".$curr_qid."'";
//DELETEME
//print("mm_library: ".$query1."<br/>");
	$result1 = pdo_query($query1);    
	$user_item = $result1->fetch(PDO::FETCH_ASSOC);

	print("<div id='question_content'><p>".$user_item['question']."</p>");

//Check if the question has media, and check what kind of media
	if($user_item['media'] != null) {
//DELETEME
//print($user_item['media']);
		//print("<p>".$user_item['media']."</p>");
		$mediafile = "../files/" . $user_item['media'];
		$extension = strtolower(pathinfo($mediafile, PATHINFO_EXTENSION));
 		
 		if (strcmp($extension, "mp3") == 0) {
 		
 			print("\n<audio src=\"".$mediafile."\" autoplay=\"autoplay\" controls=\"controls\"> </audio>\n");
 		
 		} elseif (strcmp($extension, "mp4") == 0) {
 		
 		 print ("<video id='example_video_1' class='video-js vjs-default-skin' autoplay=\"autoplay\" controls=\"controls\"
 		  	preload='none' width='500' height='350' data-setup='{}'><source src='".$mediafile."' type='video/mp4' /></video>");
 		
 		} elseif (strcmp($extension, "jpg") == 0) {
 		
 			print( "<img src='".$mediafile."' >");
 		}

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
print("mm_php_library.<br/>");
print("Current QID: ".$curr_qid."<br/>");
print("correct answer: ".$user_item["correct_answer"]."<br/><br/>");

} // display_question_contents

/* Display precious question result
*/
function display_prequestion_result($previous_answer) {

	print("<div id='prev_q_result'>");

  	// if the previous_answer doesn't have any value -> it means first question
	if(($previous_answer != null) && ($previous_answer == true)) {
		print("<p>In Previous Question, You Got <b>CORRECT!</b><br/><hr/>"); 
	} elseif (($previous_answer != null) && ($previous_answer == false)) {
		print("<p>In Previous Question, You Got <b>INCORRECT.</b><br/><hr/>"); 
	} 

	print("</p></div>");

} // display_prequestion_result

/* Put the question set (json form) into the user's 'savedquiz'
*/
function add_json_in_savedquiz($combine_json, $userid){
	$stmt = pdo_prepare("update user_data set savedquiz = ? where userid = ?");
	$stmt->bindParam(1, $combine_json);
	$stmt->bindParam(2, $userid);
	$result1 = $stmt->execute();

	if($result1 == false) {
		print("Fail to add quiz set: ".pdo_errorInfo()."<br/>");
    }
/*     else {
    	print("add json in savedqui");
    }
*/
} // add_json_in_savedquiz

/* Add purchased packet information into purchase table	
*/
function add_purchase_information($userid, $packetid, $purchasetype, $cost) {

	// Fetch max purchase id
	$query7 = "select max(abs(purchaseid)) from purchase order by purchaseid";
	$result7 = pdo_query($query7); 
	$maxid = $result7->fetch();  
	$purchase_maxid = $maxid["max(abs(purchaseid))"];

	if($purchase_maxid == null) {
		// set initial value if the id doesn't exist
		$purchase_newid = 0;
	} else {
		$purchase_newid = $purchase_maxid+1;		
	}

//DELETEME
//	print("preid: ".$purchase_maxid."currid: ".$purchase_newid."<br/>");

	$query8 = "INSERT INTO purchase VALUES ('".$purchase_newid."','".$userid.
			  "','".$packetid."','".$purchasetype ."','".$cost."',CURDATE())";
	$result8 = pdo_query($query8);    
	
	if($result8 == false) {
		pdo_rollback();
	} else {
		
		//print("Added purchase information successfully!<br/>");
	}
} // add_purchase_information

/* Add the point to the userpoint
*/
function add_point($correct_count, $userid, $point){	
	$totalpoint = ($correct_count * $point);
	$query3  = "UPDATE user_data SET userpoint = userpoint+".$totalpoint.
			   ", usercredit=usercredit+".$totalpoint." WHERE userid = '".$userid."'";
    $result3 = pdo_query($query3);

	if($result3 == false) {
		print("Fail to update user_data: ".pdo_errorInfo()."<br/>");
		pdo_rollback();
	}
} // add_point
    
/* Subtract the credit the user used from usercredit
*/    
function use_credit($total_used_credit, $userid){
	$query0  = "update user_data set usercredit = (usercredit-".$total_used_credit.") where userid='".$userid."'";
	$result0 = pdo_query($query0);    
	if($result0 == false) {
		pdo_rollbakc();
	}
} // use_credit
    
/* Check if the user has used trial packet before
   If the user has not, check the value because the user just finished
   trial packet
   **packet id "p1" is trial packet  	
*/
function update_trial_used($userid, $quizid){

	// if the packet is trial, check the usedtrial to true/1
	if($quizid == "p1") {
		$query10  = "update user_data set usedtrial = true where userid='".$userid."'";
		$result10 = pdo_query($query10);    
		if($result10 == false) {
			print("fail update usedtrial");
		}
	}

 } // update_trial_used
 
/* If the user has the savedquiz, delete it
*/
function delete_savedquiz($user_item, $userid) {
	if($user_item["savedquiz"] != null) {
		$query4  = "update user_data set savedquiz = null where userid='".$userid."'";
		$result4 = pdo_query($query4); 

		if($result4 == false) {
			print("Failed to delete the savedquiz.<br/>");
   	 }  
	}
} // delete_savedquiz

function check_point($userid, $prefix) {
	$query1  = "select userid, usercredit, userpoint from user_data where userid ='".$userid."'";
	$result1 = pdo_query($query1);
	$user_item  = $result1->fetch();
	if($result1 == false) {
		print("Failed to check point. ".$prefix."<br/>");
	} else {
		print("check point. ".$prefix."<br/>");
		dump_array_pretty($user_item);
	}
} // check_point


/* Check if the user is introduced by the other user. 
Check if the combination of those two userid is in the referral table.
Give points to the "introduced" user if it is not in the table.
*/
function update_referral($userid, $point) {
	$query1  = "select introducedby from user_profile where userid ='".$userid."'";
	$result1 = pdo_query($query1);
	$user_item  = $result1->fetch();

	if($user_item["introducedby"] == null) {
		return;
	}
	
	$introducedby_userid = $user_item["introducedby"];

	$query2  = "select * from referral 
				where introducedby='".$introducedby_userid."'
				and introduced='".$userid."'";
	$result2 = pdo_query($query2);
	$referral_item  = $result2->fetch();

	if($referral_item != null) {
		return;
	}
//DELETEME
//	print("mm_library.<br/>newcombination!");

//1) add the combination
	$query3  = "insert into referral (introducedby, introduced) values
				('".$introducedby_userid."','".$userid."')"; 
	$result3 = pdo_query($query3);	
	if($result3 == false) {
		pdo_rollback();
	}
		
//2) update the user credit		 
	$query4  = "update user_data set usercredit = (usercredit+".$point.
		   ") where userid = '".$introducedby_userid."'";
	$result4 = pdo_query($query4);
	if($result4 == false) {
		pdo_rollback();
	} 
		
	return;
} // update_referral

/* Get max id in this format "q0000" 
*/
function get_max_id($table_name) {

	if(strcmp($table_name, "question") == 0) {
		$idname = "qid";
		// Number of char before the numeric value
		$identifier = "q";
	} elseif(strcmp($table_name, "user_profile") == 0) {
		$idname = "userid";
		// Number of char before the numeric value
		$identifier = "user";
	} elseif(strcmp($table_name, "packet") == 0) {
		$idname = "packetid";
		// Number of char before the numeric value
		$identifier = "p";
	}
	$identifier_count = strlen($identifier)+1; 

    $query1  = "select max(qidint+0) as max from ( SELECT ".$idname.
    			", SUBSTRING(".$idname.", ".$identifier_count.", 10) as qidint from ".$table_name.") as tmptable";
    $result1 = pdo_query($query1);
    $max_qid  = $result1->fetch();
    $id_numpart = $max_qid["max"];

    $curr_qid = $identifier.$id_numpart;
    $new_qid = $identifier.($id_numpart+1);

//DELETEME
//	print("cur: ".$curr_qid.", new: ".$new_qid."<br/>");

	return $new_qid;
} // get_max_id

/* Display the score at the end of a question set
*/
function display_score($correct_count, $total_question_count) {

	print("Quiz is done!!<br/>");
	print("Score: ".$correct_count." / ".$total_question_count."<br/><br/>");
	
//	print("<a href='quiz_report.php'>Quiz Report</a><br/><br/>");
} // display_score

/* Calculate the total number of memorabilia that the user can purchase
*/
function nummemora_availability($current_credit, $memora_cost) {
	$answer = floor($current_credit / $memora_cost);
	return $answer;
} // nummemora_availability

/* Get total number for a particular item
Refere purchase item from populate_schema
*/
function get_total_purchase_item($item_type, $userid) {
	$query1 = "select count(*) from purchase where userid='".$userid.
			  "' and purchase_type='".$item_type."' group by purchase_type";
	$result1 = pdo_query($query1);
	$row_count = $result1->fetch(PDO::FETCH_ASSOC);
	$item_count = $row_count["count(*)"];

	return $item_count;
} // get_total_purchase_item

server_disconnect();
?>