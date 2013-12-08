<?php
include("connection.php");
include("mm_php_library.php");
server_connect();

session_start();
$userid = $_SESSION["userid"];

$load_count = isset($_REQUEST["load_count"]) ? $_REQUEST["load_count"] : 0;
$previous_answer = isset($_REQUEST["answer"]) ? $_REQUEST["answer"] : "";
$previouse_qid = isset($_REQUEST["curr_qid"]) ? $_REQUEST["curr_qid"] : "";

// Get user's saved quiz
$query0  = "select savedquiz from user_data where userid='".$userid."'";
$result0 = pdo_query($query0);    
$q_item = $result0->fetch();

// Decode the saved quiz from json into array
$savedquiz = json_decode($q_item["savedquiz"], true);
//$last_status = $savedquiz["lastindex"];
$quiz_set = $savedquiz["quiz_set"];
//$total_question_count = count($quiz_set);

// if there is previouse answer, evaluate the answer and changed "answered" value
if($previous_answer != null) { 

	$query2  = "select correct_answer from question where qid='".$previouse_qid."'";
	$result2 = pdo_query($query2);    
	$pre_quiz_key = $result2->fetch(PDO::FETCH_ASSOC);

	$pre_question_result = false;
	// Answered correct on previous question
	if($pre_quiz_key["correct_answer"] == $previous_answer) {
		$pre_question_result = true;
		// update "correct" to true
		$quiz_set[$load_count]["correct"] = $pre_question_result;

		// update "correct" to true, savedquiz value 
		$quiz_set[$load_count]["correct"] = $pre_question_result;
		// update "userpoint" 
		// update "correct" to true, savedquiz value 
		
	}

	$combine = array("lastindex" => $load_count, "quiz_set" => $quiz_set);
	$combine_json = json_encode($combine);

//DELETME
/*
	echo "<br /><pre>This JSON will be inserted<br/>";
	echo json_encode($combine, JSON_PRETTY_PRINT);
	echo "</pre><br />";
*/
	pdo_transactionstart();
	
	$stmt = pdo_prepare("update user_data set savedquiz = ? where userid = ?");
	$stmt->bindParam(1, $combine_json);
	$stmt->bindParam(2, $userid);
	$result1 = $stmt->execute();

	pdo_commit();

//FIXME
} //elseif (($previous_answer == null) && ($last_status != -1)) {
	//print("You didn't answer the previouse question.<br/>");
//} else {

//}

		header("Location: take_quiz.php?load_count=".($load_count+1).
			   "&rslt=".(int)$pre_question_result);
	    exit;
?>