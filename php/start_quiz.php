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
print("QUIZ TYPE: ".$quiztype."<br/>");

if(strcmp($quiztype, "static_quiz") == 0) {

	$selected_category = $_POST["category_select"];
	
	print("'staic quiz' is selected.<br/>");
// 1) get question set	
	$query0  = "select questionid_set from packet where packetid = '".$quizid."'";
	$result0 = pdo_query($query0);    
	$q_item  = $result0->fetch();
		
	$questionidset = json_decode($q_item["questionid_set"], true);

// DELETEME
/*	var_dump($questionidset);

	foreach($questionidset as $row) {
		var_dump($row);
		print("<br/>");
	}
*/
	// Making complete json including "lastquestion" and "quizset"
	$quizset = array();
	foreach($questionidset as $row) {
		array_push($quizset, array("id"=> $row, "correct" => false));
	}
	$combine = array("lastindex" => -1, "quiz_set" => $quizset);
	$combine_json = json_encode($combine);
//DELETME
/*
	echo "<br /><pre>";
	echo json_encode($combine, JSON_PRETTY_PRINT);
	echo "</pre><br />";
*/
// 2) put the quiz set (json form) into the user's 'savedquiz'
	pdo_transactionstart();
	
	$stmt = pdo_prepare("update user_data set savedquiz = ? where userid = ?");
	$stmt->bindParam(1, $combine_json);
	$stmt->bindParam(2, $userid);
	$result1 = $stmt->execute();

	pdo_commit();

	if($result1 == false) {
		print("Fail to add quiz set: ".pdo_errorInfo()."<br/>");
    } else {
    	print("inserted q.set into the user_data!<br/>");
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