<?php
include("connection.php");
include("mm_php_library.php");
include("sq_currency.php");

server_connect();

$qid = (isset($_REQUEST["qid"])) ? ($_REQUEST["qid"]) : "";

if($qid == "") {
	print("No Question ID!!<br/>");
	return;
} 
//DELETEME
/*
else {
	print("Question ID: ".$qid."<br/>");
}
*/
$decision = (isset($_REQUEST["accept"])) ? ($_REQUEST["accept"]) : ($_REQUEST["reject"]);

//DELETEME
//print("ADMIN DESICION: ".$decision."<br/>");

if(strcmp($decision, "ACCEPT") == 0) {
	pdo_transactionstart();
	// Update evaluatedby and give some point to the user
	$query1  = "update question set evaluatedby = 'admin' where qid='".$qid."'";
	$result1 = pdo_query($query1);
	if($result1 == false) {
		print("Failed to update the question.<br.>");
		pdo_rollback();
		return;
	} 

	// Award some point to the user
	$query2  = "update user_data set usercredit = usercredit+".$submit_quiz_point.
			   " where userid in (select submitedby from question where qid='".$qid."')";
	$result2 = pdo_query($query2);
	if($result2 == false) {
		print("Failed to update the question.<br.>");
		pdo_rollback();
		return;
	} 
	print("Update a question and userscore Successfully!<br/>");
	pdo_commit();
	
} elseif(strcmp($decision, "REJECT") == 0) {
	// Remove the question from question
	$query0  = "delete from question where qid='".$qid."'";
	$result0 = pdo_query($query0);
	if($result0 == false) {
		print("Failed to remove the question.<br.>");
	} else {
		print("Removed successfully!<br/>");
	}
} 

print("<a href='admin_eval_submission.php'>Back To Evaluate Submission</a>");

print("<br/><br/>");
print("<div id='menu'><a href='menu.php'>Menu</a></div>");
print("<div id='logout'><a href='logout.php'>Logout</a></div>");

server_disconnect();
?>