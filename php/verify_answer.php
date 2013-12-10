<?php
include("connection.php");
include("mm_php_library.php");
include("sq_currency.php");

server_connect();

session_start();
$userid = $_SESSION["userid"];

$isResume = $_REQUEST["isResume"];

$load_count = isset($_REQUEST["load_count"]) ? $_REQUEST["load_count"] : 0;
$previous_answer = isset($_REQUEST["answer"]) ? $_REQUEST["answer"] : "";
$curr_qid = isset($_REQUEST["curr_qid"]) ? $_REQUEST["curr_qid"] : "";

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

	$query2  = "select correct_answer from question where qid='".$curr_qid."'";
	$result2 = pdo_query($query2);    
	$pre_quiz_key = $result2->fetch(PDO::FETCH_ASSOC);

	$pre_question_result = false;
// Answered correctly on previous question
	if($pre_quiz_key["correct_answer"] == $previous_answer) {
		$pre_question_result = true;
		
		// update "correct" to true, "savedquiz" in user_data  
		$quiz_set[$load_count]["correct"] = $pre_question_result;

		pdo_transactionstart();
 
		// update "use_count" & "correct_count" in question, increment by 1
		$query4  = "UPDATE question SET use_count = use_count+1, correct_count = correct_count+1 WHERE qid = '".$curr_qid."'";
    	$result4 = pdo_query($query4);
	
		if($result4 == false) {
			print("Fail to update question: ".pdo_errorInfo()."<br/>");
			pdo_rollback();
   		} 
// Answered incorrectly on previous question		
	} elseif ($pre_quiz_key["correct_answer"] != $previous_answer) {

		pdo_transactionstart();

		// update "use_count" & "correct_count" in question, increment by 1
		$query5  = "UPDATE question SET use_count = use_count+1 WHERE qid = '".$curr_qid."'";
    	$result5 = pdo_query($query5);	

		if($result5 == false) {
			print("Fail to update question: ".pdo_errorInfo()."<br/>");
			pdo_rollback();
   		} 
	}

	// update savedquiz
	$combine = array("lastindex" => $load_count, "quiz_set" => $quiz_set);
	$combine_json = json_encode($combine);
	
	$stmt = pdo_prepare("update user_data set savedquiz = ? where userid = ?");
	$stmt->bindParam(1, $combine_json);
	$stmt->bindParam(2, $userid);
	$result1 = $stmt->execute();

	pdo_commit();
} 
	// INCREMENT load_count by 1
	if($isResume == true) {
		header("Location: resume_quiz.php?load_count=".($load_count+1).
			   "&rslt=".(int)$pre_question_result);
	} else {
		header("Location: take_quiz.php?load_count=".($load_count+1).
			   "&rslt=".(int)$pre_question_result);	
	}	
	exit;
?>