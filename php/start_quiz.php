<?php
include("connection.php");
include("mm_php_library.php");
include("sq_currency.php");
server_connect();

session_start();
$userid = $_SESSION["userid"];
$quiztype = $_REQUEST["quiz_type"];
$_SESSION["quizid"] = $_REQUEST["category_select"];
$quizid = $_SESSION["quizid"];
//DELETEME
//print("QUIZ TYPE: ".$quiztype."<br/>");
  print("Qid: ".$quizid."<br/>");

//STATIC QUIZ
if(strcmp($quiztype, "static_quiz") == 0) {

	print("'static quiz' is selected.<br/>");
	$purchasetype = "STATI";
	$cost = $static_packet_cost;

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

	if($result1 == false) {
		print("Fail to add quiz set: ".pdo_errorInfo()."<br/>");
    }

// 3) Add packet information in purchase
	add_purchase_packet($userid, $quizid, $purchasetype, $cost);
	pdo_commit();
	
	print("<a href='take_quiz.php'>Take A Quiz</a>");

} elseif(strcmp($quiztype, "random_quiz") == 0) {

	print("'random quiz' is selected.<br/>");	
	
//1) Assign purchase type and cost to correspond to the quiz type
//2) Get 20 questions randomly

	/*MEMO: find_category($str, "all")
	if the string contains all, return true(or, 1)
	if the string doesn't contain, return false
	*/
	if (find_category($quizid, "s")) {
		// pick from topic
		print($quizid."<br/>");
		$purchasetype = "SUBJE";
		$cost = $subject_packet_cost;
		$query = "select qid from question 
		where subtopicid in (select subtopicid from (
		select sub.subtopicid, sub.st_name, t.topicid, t.subjectid, 
		t.t_name, s.s_name from topic t, subject s, subtopic sub 
		where t.subjectid = s.subjectid && t.topicid = sub.topicid ) 
		as st where subjectid = '".$quizid."') order by rand() limit 20";
	} elseif(find_category($quizid, "t")) {
		// pick from topic
		$purchasetype = "TOPIC";
		$cost = $topic_packet_cost;
		$query = "select qid, question, subtopicid from question 
		where subtopicid in (select subtopicid from (
		select sub.subtopicid, sub.st_name, t.topicid, t.subjectid, 
		t.t_name from topic t, subtopic sub 
		where t.topicid = sub.topicid ) 
		as st where topicid = '".$quizid."') order by rand() limit 20";
	} elseif(find_category($quizid, "st")) { 
		// pick from subtopic
		$purchasetype = "SUBTO";
		$cost = $subtopic_packet_cost;
		$query = "select qid from question where subtopicid='".
				$quizid."' order by rand() limit 20";

	} elseif(find_category($quizid, "easy")) {
		// special case that a packet will be random selection from entire question
		$purchasetype = "RANDM";
		$cost = $random_packet_cost;
		$query = "";		
	} elseif(find_category($quizid, "hard")) {
		// special case that a packet will be random selection from entire question
		$purchasetype = "RANDM";
		$cost = $random_packet_cost;
		$query = "";
	} else {
		print("Your choice is not available currently.<br/>");
	}
	$result = pdo_query($query);
	$question_id = $result->fetchAll(PDO::FETCH_ASSOC);

	
//3) Making json
	$quizset = array();
	$quizset_json_for_packet = array();
	
	foreach($question_id as $row) {
		//var_dump($row["qid"]);
		array_push($quizset_json_for_packet, $row["qid"]);
		array_push($quizset, array("id"=> $row["qid"], "correct" => false));
	}

	$combine = array("lastindex" => -1, "quiz_set" => $quizset);
	$combine_json = json_encode($combine);
	//var_dump($combine_json);
//3) Saved into packet
	$json_quizidset = json_encode($quizset_json_for_packet);
	$newid = get_max_id("packet");
	
	$query7 = "INSERT INTO packet VALUES ('"
	.$newid."','".$purchasetype."','', ".$json_quizidset;


//4) put the question set (json form) into the user's 'savedquiz'
	pdo_transactionstart();
	$stmt = pdo_prepare("update user_data set savedquiz = ? where userid = ?");
	$stmt->bindParam(1, $combine_json);
	$stmt->bindParam(2, $userid);
	$result1 = $stmt->execute();

	if($result1 == false) {
		print("Fail to add quiz set: ".pdo_errorInfo()."<br/>");
    }
//5) Assign packet id into quizid 
	$_SESSION["quizid"] = $newid;
	$quizid = $_SESSION["quizid"];
//6) Add packet information in purchase
	add_purchase_packet($userid, $quizid, $purchasetype, $cost);
	pdo_commit();
	
	print("<a href='take_quiz.php'>Take A Quiz</a>");

} else {
	print("something wrong at selecting quiz type.<br/>");
}

server_disconnect();
?>