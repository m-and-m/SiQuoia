<?php
include("connection.php");
include("mm_php_library.php");
include("sq_currency.php");
server_connect();

session_start();
$userid = $_SESSION["userid"];
$quiztype = $_REQUEST["quiz_type"];
$select = (isset($_REQUEST["category_select"])) ? $_REQUEST["category_select"] : "";

//DELETEME
print("Select: ".$select."<br/>");

//STATIC QUIZ
if(strcmp($quiztype, "static_quiz") == 0) {

	print("'static quiz' is selected.<br/>");

	$_SESSION["quizid"] = $select;
	$quizid = $_SESSION["quizid"];
	//DELETEME
	print("Qid: ".$quizid."<br/>");
	
	if($quizid == "p1") {
		$purchasetype = "TRIAL";
		$cost = $trial_packet_cost;
	}
	
	$purchasetype = "STATI";
	$cost = $static_packet_cost;

//1) get question set from packet 
	$query0  = "select questionid_set from packet where packetid = '".$quizid."'";
//DELETEME
print("strt_quiz: ".$query0."<br/>");
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

	pdo_transactionstart();

//2) put the question set (json form) into the user's 'savedquiz'
	add_json_in_savedquiz($combine_json, $userid);

//3) update users credit
	use_credit($cost, $userid);
	
//4) Add packet information in purchase
	add_purchase_information($userid, $quizid, $purchasetype, $cost);

	pdo_commit();
	
	print("<a href='take_quiz.php'>Take A Quiz</a>");

} 
//RANDOM QUIZ
elseif(strcmp($quiztype, "random_quiz") == 0) {

	print("'random quiz' is selected.<br/>");	

	$_SESSION["quizid"] = $select;
	$quizid = $_SESSION["quizid"];
	//DELETEME
	print("Qid: ".$quizid."<br/>");

//1) Assign purchase type and cost, corresponding to the quiz type
//2) Get 20 questions randomly
	if(strcmp($quizid, "all") == 0) {
		// special case:

//DELETEME		print("all<br/>");
		// trial and random quiz packet(questions are chosen from entire question
		$purchasetype = "TRIAL";
		$cost = $trial_packet_cost;
		$query = "select qid from question order by rand() limit 20";		
		$packet_name = "random trial";
		
	} elseif (find_category($quizid, "s")) {
		// pick from subject
//DELETEME		print("subject<br/>");
		
		$purchasetype = "SUBJE";
		$cost = $subject_packet_cost;

		$query = "select qid from question 
		where subtopicid in (select subtopicid from (
		select sub.subtopicid, sub.st_name, t.topicid, t.subjectid, 
		t.t_name, s.s_name from topic t, subject s, subtopic sub 
		where t.subjectid = s.subjectid && t.topicid = sub.topicid ) 
		as st where subjectid = '".$quizid."') order by rand() limit 20";

		$packet_name = "random subject";
		
	} elseif(find_category($quizid, "t")) {
		// pick from topic
//DELETEME		print("topic<br/>");
		
		$purchasetype = "TOPIC";
		$cost = $topic_packet_cost;

		$query = "select qid, question, subtopicid from question 
		where subtopicid in (select subtopicid from (
		select sub.subtopicid, sub.st_name, t.topicid, t.subjectid, 
		t.t_name from topic t, subtopic sub 
		where t.topicid = sub.topicid ) 
		as st where topicid = '".$quizid."') order by rand() limit 20";

		$packet_name = "random topic";

	} elseif(find_category($quizid, "st")) { 
		// pick from subtopic
//DELETEME		print("subtopic<br/>");
		
		$purchasetype = "SUBTO";
		$cost = $subtopic_packet_cost;

		$query = "select qid from question where subtopicid='".
				$quizid."' order by rand() limit 20";

		$packet_name = "random subtopic";
		
	} elseif(find_category($quizid, "easy")) {
		// use question ranking <50%
		// special case that a packet will be random selection from entire question
		$purchasetype = "RANDM";
		$cost = $random_packet_cost;
		$query = "";		
	} elseif(find_category($quizid, "hard")) {
		// use question ranking >=50%
		// special case that a packet will be random selection from entire question
		$purchasetype = "RANDM";
		$cost = $random_packet_cost;
		$query = "";
	} else {
		print("Your choice is not available currently.<br/>");
	}
	
	$result = pdo_query($query);
	$question_id = $result->fetchAll(PDO::FETCH_ASSOC);
	
//3) Making 2 arrays for json: one is for packet and another is for user's savedquis
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

	$json_quizidset = json_encode($quizset_json_for_packet);
	$newid = get_max_id("packet");

//3) !! Changed not to save a question set into packet
//Saved into packet
/*	
	$query7 = "INSERT INTO packet VALUES ('"
	.$newid."','".$packet_name."','', '".$json_quizidset."','')";
	$result7 = pdo_query($query7);    

	if($result7 == false) {
		pdo_rollback();
	}
*/

	pdo_transactionstart();

//4) put the question set (json form) into the user's 'savedquiz'
	add_json_in_savedquiz($combine_json, $userid);

//5) Assign packet id into quizid 
	$_SESSION["quizid"] = $newid;
	$quizid = $_SESSION["quizid"];

//6) update users credit
	use_credit($cost, $userid);

//7) Add packet information in purchase
	add_purchase_information($userid, "", $purchasetype, $cost);

	pdo_commit();
	
	print("<a href='take_quiz.php'>Take A Quiz</a>");

} 
//BRANDED QUIZ
elseif(strcmp($quiztype, "branded_quiz") == 0) {

	$purchasetype = "BRAND";
	$cost = $branded_packet_cost;

	$code = $_REQUEST["b_code"];
//DELETEME	
	print("CODE: ".$code."<br/>");

//1) Get the question, which has the code from packet
	$query9  = "select packetid from packet where branded ='".$code."'";
	$result9 = pdo_query($query9);    
	$packetid  = $result9->fetch();
	$b_packetid = $packetid["packetid"];
//DELETEME
	print("B PID: ".$b_packetid."<br/>");
	$_SESSION["quizid"] = $b_packetid;
	$quizid = $_SESSION["quizid"];

// 1) get question set from packet 
	$query10  = "select questionid_set from packet where packetid = '".$quizid."'";
	$result10 = pdo_query($query10);    
	$q_item  = $result10->fetch();
	// question set in json
	$questionidset = json_decode($q_item["questionid_set"], true);

	// Inserting additional key/value in the question set
	$quizset = array();
	foreach($questionidset as $row) {
		array_push($quizset, array("id"=> $row, "correct" => false));
	}
	$combine = array("lastindex" => -1, "quiz_set" => $quizset);
	$combine_json = json_encode($combine);

	pdo_transactionstart();

// 2) put the question set (json form) into the user's 'savedquiz'
	add_json_in_savedquiz($combine_json, $userid);

// 3) Add packet information in purchase
	add_purchase_information($userid, $b_packetid, $purchasetype, $cost);

	pdo_commit();
	
	print("<a href='take_quiz.php'>Take A Quiz</a>");
	
} 
else {
	print("something wrong at selecting quiz type.<br/>");
}

server_disconnect();
?>