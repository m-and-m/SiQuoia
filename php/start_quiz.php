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

	print("'static quiz' is selected.<br/>");
//DELETEME
	print($quizid."<br/>");

// 1) get question set from packet 
	$query0  = "select questionid_set from packet where packetid = '".$quizid."'";
	$result0 = pdo_query($query0);    
	$q_item  = $result0->fetch();
	// question set in json
	$questionidset = json_decode($q_item["questionid_set"], true);

	// Inserting additional key/value in the question set
	$quizset = array();
	foreach($questionidset as $row) {
		array_push($quizset, array("id"=> $row, "correct" => false));
	}
	$combine = array("lastindex" => -1, "quiz_set" => $quizset);
	$combine_json = json_encode($combine);

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
	

	/*MEMO: find_category($str, "all")
	if the string contains all, return true(or, 1)
	if the string doesn't contain, return false
	*/
	if (find_category($quizid, "s")) {
		// pick from topic
		print($quizid."<br/>");
		$purchasetype = "SUBJE";
		$cost = $subject_packet_cost;
		
	} elseif(find_category($quizid, "t")) {
		// pick from topic
		$purchasetype = "TOPIC";
		$cost = $topic_packet_cost;

	} elseif(find_category($quizid, "st")) { 
		// pick from subtopic
		$purchasetype = "SUBTO";
		$cost = $subtopic_packet_cost;

	} elseif(find_category($quizid, "all")) {
		// special case that a packet will be random selection from entire question
		$purchasetype = "RANDM";
		$cost = $random_packet_cost;

	} else {
		print("Your choice is not available currently.<br/>");
	}


		$query = "INSERT INTO purchase VALUES ('".$pid."','".$userid."','"
		.$packetid."','".$purchasetype ."','".$cost."',CURDATE()'";
		
		
		


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