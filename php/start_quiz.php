<?php
include("connection.php");
include("mm_php_library.php");
server_connect();

session_start();
$userid = $_SESSION["userid"];

$quiztype = $_REQUEST["quiz_type"];

// Get user information
$query0  = "select username from user_profile where userid='".$userid."'";
$result0 = pdo_query($query0);    
$user_item  = $result0->fetch();

if(strcmp($quiztype, "static_quiz") == 0) {

	$selected_category = $_POST["category_select"];
	
	print("'staic quiz' is selected.<br/>");
// 1) get question set	
	$query0  = "select questionid_set from packet where packetid = '".$selected_category."'";
	$result0 = pdo_query($query0);    
	$q_item  = $result0->fetch();
	
// DELETEME
	
	$questionidset = json_decode($q_item["questionid_set"], true);

	//var_dump($q_item["questionid_set"]);
	foreach($questionidset as $row) {
		var_dump($row);
		print("<br/>");
	}
	
	
// 2) put the quiz set into the user's 'savedquiz'
	pdo_transactionstart();
	
	$stmt = pdo_prepare("update user_data set savedquiz = ? where userid = ?");
	$stmt->bindParam(1, $q_item["questionid_set"]);
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
	print("<a href='take_quiz.php?packetid=".$selected_category."'>Take A Quiz</a>");

// @) fix format for questionid_set (delete "answered", generate it automatically)

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
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">

<html>
 <head>
 	<title>BEFORE TAKE A QUIZ</title>
	<script src="../js/source/jquery-1.10.2.min.js" type="text/javascript"></script>	
	<script src="../js/check_empty.js" type="text/javascript"></script>
 </head>
 <body>
 
 <header>
  <h1>SiQuoia - <?php print($user_item["username"])?>'s page</h1><hr>  
 </header>
 
 <div class="content">
  <h2>BEFORE TAKE A QUIZ</h2>
  <hr>
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