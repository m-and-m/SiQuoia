<?php
include("connection.php");
include("mm_php_library.php");

server_connect();

session_start();
$userid = $_SESSION["userid"];
$username = $_SESSION["username"];

$query0  = "select * from question where evaluatedby is NULL";
$result0 = pdo_query($query0);    
$user_item  = $result0->fetchAll();
//var_dump($user_item);
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">

<html>
 <head>
 	<title>ADMIN EVALUATE SUBMISSION</title>
	<script src="../js/source/jquery-1.10.2.min.js" type="text/javascript"></script>	
	<script src="../js/check_empty.js" type="text/javascript"></script>
 </head>
 <body>
 
 <header>
  <h1><?php include("../html/sq_logo.html"); print("&nbsp;&nbsp;&nbsp;".$username."'s page"); ?></h1><hr>  
 </header>
 
 <div class="content">
 <h2>ADMIN EVALUATE SUBMISSION</h2>
  <hr>
  <?php
  if($user_item == null) {
		print("There is no new submission.<br/>");
		print("<br/><br/>");
		print("<div id='menu'><a href='menu.php'>Menu</a></div>");
		print("<div id='logout'><a href='logout.php'>Logout</a></div>");

		return;
	} else {
//DELETEME	
		//dump_array2d_pretty($user_item);
	?>
	<table border="1">
 	 <tr>
  	  <th>Select</th>
  	  <th>Question Id</th>
   	  <th>Contents</th>
   	  <th>Media</th>   	  
   	  <th>Answer 1</th>   	  
   	  <th>Answer 2</th>
   	  <th>Answer 3</th>
   	  <th>Answer 4</th>
   	  <th>Correct Answer</th>
   	  <th>Submitted By</th>
 	 </tr>
  <form action="admin_submission_decision.php" id="multimedia_question_form" >
<?php

	foreach($user_item as $row) {

		$hasmedia = "No";
	
		if($row["media"] != null) {
			$hasmedia = "Yes";
		}
		
		print("<tr><td><input type='radio' name='qid' value='".$row["qid"]."'/></td>");

		print("<td>".$row["qid"]."</td><td>".$row["question"]."</td><td>".$hasmedia."</td>");
		print("<td>".$row["answer1"]."</td><td>".$row["answer3"]."</td><td>".$row["answer3"]."</td>");
		print("<td>".$row["answer4"]."</td><td>".$row["correct_answer"]."</td><td>".$row["submitedby"]."</td></tr>");
	}
?>	
	</table>
	<br/> 
	<input type="submit" name="accept" value="ACCEPT"/> 
	&nbsp;&nbsp; 
	<input type="submit" name="reject" value="REJECT"/>

  </form> 	 
<?php
	}
  ?>
  <br/><br/>
	
	<div id="menu"><a href='menu.php'>Menu</a></div>
	<div id="logout"><a href='logout.php'>Logout</a></div> <!--COMPLETE-->

 </div>

  <?php
	  include("../html/footer_group_logo.html");
  ?>
 </body>
 
</html>
<?php
server_disconnect();
?>