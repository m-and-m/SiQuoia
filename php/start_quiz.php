<?php
include("connection.php");
include("mm_php_library.php");
server_connect();

session_start();
$userid = $_SESSION["userid"];
$quiztype = $_REQUEST["quiz_type"];
$_SESSION["quizid"] = $_REQUEST["category_select"];
$quizid = $_SESSION["quizid"];
//DELETEME
//print("QUIZ TYPE: ".$quiztype."<br/>");

//STATIC QUIZ
if(strcmp($quiztype, "static_quiz") == 0) {

	print("'staic quiz' is selected.<br/>");
	$selected_category = $_POST["category_select"];
	
// 1) get question set	
	$query0  = "select questionid_set from packet where packetid = '".$quizid."'";
	$result0 = pdo_query($query0);    
	$q_item  = $result0->fetch();
	// question set in json
	$questionidset = json_decode($q_item["questionid_set"], true);

// DELETEME
//dump_array_pretty($questionidset);

	// Inserting additional key/value in the question set
	$quizset = array();
	foreach($questionidset as $row) {
		array_push($quizset, array("id"=> $row, "correct" => false));
	}
	$combine = array("lastindex" => -1, "quiz_set" => $quizset);
	$combine_json = json_encode($combine);
//DELETME
//dump_array_pretty($combine_json);

// 2) put the question set (json form) into the user's 'savedquiz'
	pdo_transactionstart();
	
	$stmt = pdo_prepare("update user_data set savedquiz = ? where userid = ?");
	$stmt->bindParam(1, $combine_json);
	$stmt->bindParam(2, $userid);
	$result1 = $stmt->execute();

	pdo_commit();

	if($result1 == false) {
		print("Fail to add quiz set: ".pdo_errorInfo()."<br/>");
    }
    
// 3) Go to another page for actual 'taking-quiz' page
/* 	   => later, delete html part, and navigat to the next page
		header("Location: take_quiz.php");
	    exit;
*/
	print("<a href='take_quiz.php'>Take A Quiz</a>");

} elseif(strcmp($quiztype, "random_quiz") == 0) {
	print("'random quiz' is selected.<br/>");
	
	/*
	// DELETME
	 print($selected_question."<br/>"); //st0
	 print("'st': ".find_category($selected_category, "st")."<br/>");
	 print("'t': ".find_category($selected_category, "t")."<br/>");
	 print("'s': ".find_category($selected_category, "s")."<br/>");
	 print("'ts': ".find_category($selected_category, "ts")."<br/>");
	*/

	/*MEMO: find_category($str, "all")
	if the string contains all, return true(or, 1)
	if the string doesn't contain, return false
	*/
	if (find_category($selected_category, "s")) {
	// pick from topic
	} elseif(find_category($selected_category, "t")) {
	// pick from topic
	} elseif(find_category($selected_category, "st")) { 
	// pick from subtopic
	} elseif(find_category($selected_category, "all")) {
	// special case that a packet will be random selection from entire question
	} else {
		print("Your choice is not available currently.<br/>");
	}
	/*
		$query0  = "select questionid_set from packet where p_name in".
				   "(select st_name from subtopic where subtopicid ='st0')";
		$result0 = pdo_query($query0);    
		$q_item  = $result0->fetch();
		$questionid_json = json_decode($q_item["questionid_set"], true);
	*/

} else {
	print("something wrong at selecting quiz type.<br/>");
}

server_disconnect();
?>