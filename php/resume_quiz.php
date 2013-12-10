<?php
session_start();

include("../html/take_quiz_head.html");
include("connection.php");
include("mm_php_library.php");
server_connect();


$userid = $_SESSION["userid"];
$username = $_SESSION["username"];
$quizid = $_SESSION["quizid"];

$previous_answer = isset($_REQUEST["rslt"]) ? $_REQUEST["rslt"] : null;

// Get user's saved quiz
$query0  = "select savedquiz from user_data where userid='".$userid."'";
$result0 = pdo_query($query0);    
$user_item  = $result0->fetch();

// Decode the saved quiz from json into array
$savedquiz = json_decode($user_item["savedquiz"], true);
$last_status = $savedquiz["lastindex"];
$quiz_set = $savedquiz["quiz_set"];
$total_question_count = count($quiz_set);
$total_left_question_count = ($total_question_count-1) - $last_status;
$load_count = isset($_REQUEST["load_count"]) ? $_REQUEST["load_count"] : ($last_status+1);

// Trace correct count
$correct_count = 0;
foreach ($quiz_set as $item) {
	if ($item['correct'] == true) {
	   $correct_count += 1;
	}
}

//DELETEME
	print("resume_quiz.<br/>Page load count: ".$load_count."<br/>Packet id: ".$quizid.
	  	  "<br/>Total # question: ".$total_question_count.
	 	  "<br/>Last status: ".$last_status."<br/>");

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">

<html>

 <body>
 
 <header>
	<h1>SiQuoia - <?php print($username);?>'s page</h1><hr>  
	<script src="../js/did_you_answer.js" type="text/javascript"></script>  
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
	
$isresume_quiz = true;	
// Get the question contents/answer/key using question id
if($load_count < $total_question_count) { 

	display_question_contents($quiz_set, $load_count, $isresume_quiz);
	print("<div><a href='menu.php'>QUIT QUIZ</a></div></div>");

} elseif($load_count == $total_question_count) {

	// Display score
	display_score($correct_count, $total_question_count);

	// Update usedtrial value to true
	check_trial_used($userid, $quizid);

	// Delete savedquiz if it exists
	delete_savedquiz($user_item, $userid);
}

?>
	<br/>

	<div id="menu"><a href='menu.php'>Menu</a></div>
	<div id="logout"><a href='logout.php'>Logout</a></div> <!--COMPLETE-->

 </div>

 <footer>
  <hr>
  <section>
   <div>created by SQ4</div>
  </section>
 </footer> 
 </body>
 
</html>
<?php
server_disconnect();
?>