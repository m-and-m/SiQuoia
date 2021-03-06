<?php
session_start();

include("../html/take_quiz_head.html");
include("connection.php");
include("mm_php_library.php");
include("sq_currency.php");
server_connect();

$userid = $_SESSION["userid"];
$username = $_SESSION["username"];
$quizid = $_SESSION["quizid"];
$packet_type = $_SESSION["packet_type"];
//DELETEME
//print("Packet tyepe: ".$packet_type."<br/>");

$load_count = isset($_REQUEST["load_count"]) ? $_REQUEST["load_count"] : 0;
$previous_answer = isset($_REQUEST["rslt"]) ? $_REQUEST["rslt"] : null;

// Get user's saved quiz
$query0  = "select savedquiz from user_data where userid='".$userid."'";
$result0 = pdo_query($query0);    
$user_item = $result0->fetch();

// Decode the saved quiz from json into array
$savedquiz = json_decode($user_item["savedquiz"], true);
$last_status = $savedquiz["lastindex"];
$quiz_set = $savedquiz["quiz_set"];
$total_question_count = count($quiz_set);

// Check if the packet is branded quiz
$query1  = "select brandlogo from packet where packetid ='".$quizid."'";
$result1 = pdo_query($query1);
$packet_item  = $result1->fetch();
$isbranded_quiz = false;    
if($packet_item["brandlogo"] != false) {
	$isbranded_quiz = true;
}

// Trace correct count
$correct_count = 0;
foreach ($quiz_set as $item) {
	if ($item['correct'] == true) {
	   $correct_count += 1;
	}
}
//DELETEME
/*
	print("take_quiz.<br/>Page load count: ".$load_count."<br/>Packet id: ".$quizid.
	  	  "<br/>Total # question: ".$total_question_count.
	 	  "<br/>Last status: ".$last_status."<br/>");
*/
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">

<html>
 	<title>TAKE QUIZ</title>
 <body>
 
 <header>
  <h1><?php include("../html/sq_logo.html"); print("&nbsp;&nbsp;&nbsp;".ucfirst($username)."'s page"); ?>
  	 <?php
 		if($isbranded_quiz) {
 			print("&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<img src='../files/".$packet_item["brandlogo"].
 				  "' alt='brand logo' height='70' length='200'>");
 		}
 	?>
  </h1><hr>  
 </header>
 
 <div class="content">
<?php
if($load_count < $total_question_count) { 
	print("<h2>TAKE A QUIZ - ".($load_count+1)." of ".($total_question_count)." Questions</h2>");
	print("<h3>Your Score: ".$correct_count."/".$total_question_count."</h3>");
} elseif($load_count == $total_question_count) {
	print("<h2>TAKE A QUIZ</h2>");
}
?>
  <hr>
	
<?php
//Display the result of preciouse quiz, (IN)CORRECT, here.
display_prequestion_result($previous_answer);

$isresume_quiz = false;
// Get the question contents/answer/key using question id
if($load_count < $total_question_count) { 

	display_question_contents($quiz_set, $load_count, $isresume_quiz);
	print("<div><a href='menu.php'>QUIT QUIZ</a></div></div>");

} elseif($load_count == $total_question_count) {

	// Display score
	display_score($correct_count, $total_question_count);

    pdo_transactionstart();
	
	// Add score/point
	add_point($correct_count, $userid, $answer_correct_point);	
 
	// Update usedtrial value to true
	update_trial_used($userid, $quizid);

	// Delete savedquiz if it exists
	delete_savedquiz($user_item, $userid);	
	
	if(strcmp($packet_type, "TRIAL") != 0) {
		//Check referral, and give the points if the user is introduced by the other user
		update_referral($userid, $introduce_friend_point);
	}
	pdo_commit();
	
}	
?>
	<div id="menu"><a href='menu.php'>Menu</a></div>
	<div id="logout"><a href='logout.php'>Logout</a></div> <!--COMPLETE-->

 </div>

  <?php
	  include("../html/footer_group_logo.html");
  ?>
 </body>
 
</html>
<?php
server_disconnect();
?>