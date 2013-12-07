<?php
include("connection.php");
include("mm_php_library.php");
server_connect();

session_start();
$userid = $_SESSION["userid"];
// Get user information
$query0  = "select username, savedquiz from user_profile p, user_data d where p.userid=d.userid and p.userid='".$userid."'";
$result0 = pdo_query($query0);    
$user_item  = $result0->fetch();



$packetid = $_REQUEST["packetid"];
$previouse_answer = isset($_REQUEST["answer"]) ? $_REQUEST["answer"] : "";

// if the previouse_answer doesn't have any value -> it means first question
if(!$previouse_answer) {
	// evaluate answer and display "(IN)CORRECT"
	
	//print($packetid);
	
} 

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">

<html>
 <head>
 <meta content="text/html;charset=utf-8" http-equiv="Content-Type">
 	<title></title>
	<script src="../js/source/jquery-1.10.2.min.js" type="text/javascript"></script>	
	<script src="../js/verify_answer.js" type="text/javascript"></script>
 </head>
 <body>
 
 <header>
  <h1>SiQuoia - <?php print($user_item["username"])?>'s page</h1><hr>  
 </header>
 
 <div class="content">
  <h2>TAKE A QUIZ</h2>
  <hr>
  <!--Display "(IN)CORRECT" here-->  
  	<div id="prev_q_result"></div> 

	<div id="question_content">
	1)	question here<br/>
	1: answer1<br/>
	2: answer2<br/>
	3: answer3<br/>
	4: answer4<br/>	
	</div>
	<div id="question_answer">
  <form action="take_quiz.php" id="select_answer">
	<input type="radio" name="answer" value="1"/>1
	<input type="radio" name="answer" value="2"/>2
	<input type="radio" name="answer" value="3"/>3
	<input type="radio" name="answer" value="4"/>4<br/><br/>
<!--FIXME-->
	<input type="hidden" id="questionid" value="q1"/>
	<input type="submit" value="CONTINUE"/><br/>
  </form>
	</div>
	<br/>
<!--  	
	<div style="visibility:hidden">
	<div><a href='take_quiz.php' >NEXT</a></div> 
-->
	<div><a href='menu.php'>QUIT QUIZ</a></div>
	</div> 
		 
	<br/>

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