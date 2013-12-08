<?php
include("connection.php");
include("mm_php_library.php");
server_connect();

session_start();

$userid = $_SESSION["userid"];
$username = $_SESSION["username"];
$quizid = $_SESSION["quizid"];

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



//DELETEME
	print("<br/>Page load count: ".$load_count."<br/>Packet id: ".$quizid.
	  "<br/>Total # question: ".$total_question_count.
//	  "<br/>Previouse qid: ".$previouse_qid.
	  "<br/>Last status: ".$last_status."<br/>");

echo "<pre><br/>";
//var_dump($savedquiz);
echo "</pre>";
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">

<html>
 <head>
 <meta content="text/html;charset=utf-8" http-equiv="Content-Type">
 	<title>QUIZ</title>
	<script src="../js/source/jquery-1.10.2.min.js" type="text/javascript"></script>	
 </head>
 <body>
 
 <header>
  <h1>SiQuoia - <?php print($username); ?>'s page</h1><hr>  
 </header>
 
 <div class="content">
<?php
if($load_count < $total_question_count) { 
	print("<h2>TAKE A QUIZ - ".($load_count+1)."/".($total_question_count)."</h2>");
} elseif($load_count == $total_question_count) {
	print("<h2>TAKE A QUIZ</h2>");
}
?>
  <hr>
	
<?php
//Display the result of preciouse quiz, (IN)CORRECT, here.
	print("<div id='prev_q_result'>");
  	// if the previous_answer doesn't have any value -> it means first question
	if(($previous_answer != null) && ($previous_answer == true)) {
		print("<p>In Previous Quiz, You Got <b>CORRECT!</b><br/><hr/>"); 
	} elseif (($previous_answer != null) && ($previous_answer == false)) {
		print("<p>In Previous Quiz, You Got <b>INCORRECT.</b><br/><hr/>"); 
	} else {
	}
	print("</p></div>");
  
	
// Get the question contents/answer/key using question id
if($load_count < $total_question_count) { 

	$curr_qid = $quiz_set[($load_count)]["id"];
	$query1  = "select * from question where qid='".$curr_qid."'";
	$result1 = pdo_query($query1);    
	$user_item = $result1->fetch(PDO::FETCH_ASSOC);

	print("<div id='question_content'><p>".$user_item['question']."</p></div>");

	print("<div id='question_answer'><form action='verify_answer.php' id='select_answer' method='post'>");
	print("<label><input type='radio' name='answer' value='1'/>&nbsp;".($user_item['answer1'])."</label><br/>");
	print("<label><input type='radio' name='answer' value='2'/>&nbsp;".($user_item['answer2'])."</label><br/>");
	print("<label><input type='radio' name='answer' value='3'/>&nbsp;".($user_item['answer3'])."</label><br/>");
	print("<label><input type='radio' name='answer' value='4'/>&nbsp;".($user_item['answer4'])."</label><br/><br/>");

	print("<input type='hidden' name='load_count' value='".($load_count)."'/>");
	print("<input type='hidden' name='curr_qid' value='".($curr_qid)."'/>");
	print("<input type='submit' value='CONTINUE'/><br/></form></div>");

//DELETME
print("Current QID: ".$curr_qid."<br/>");
print("correct answer: ".$user_item["correct_answer"]."<br/><br/>");

	print("<div><a href='menu.php'>QUIT QUIZ</a></div></div>");

} elseif($load_count == $total_question_count) {

	print("Question is done!!<br/>");
	print("<a href='quiz_report.php'>Quiz Report</a><br/><br/>");
}	
?>
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