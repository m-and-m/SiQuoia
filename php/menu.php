<?php
include("connection.php");
include("mm_php_library.php");
include("sq_currency.php");

server_connect();

session_start();
$userid = $_SESSION["userid"];
$username = $_SESSION["username"];

$query0  = "select isadmin, savedquiz, usercredit from user_profile p, user_data d where p.userid=d.userid and p.userid='".$userid."'";
$result0 = pdo_query($query0);    
$user_item  = $result0->fetch();

//DELETEME
//var_dump($user_item);
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">

<html>
 <head>
 	<title>MENU</title>
	<script src="../js/source/jquery-1.10.2.min.js" type="text/javascript"></script>	
	<script src="../js/check_empty.js" type="text/javascript"></script>
 </head>
 <body>
 
 <header>
<!--  <h1>SiQuoia - <?php print($user_item["username"])?>'s page</h1><hr>  -->
  <h1>SiQuoia - <?php print($username); ?>'s page</h1><hr>  

 </header>
 
 <div class="content">
 <h2>MENU</h2>
  <hr>
<?php
// Check if the user has the saved quiz
if($user_item["savedquiz"] != null) {
	// the user has a saved quiz
	print("<div id='resume_quiz'>".
		  "<span><b>WARNING: You have one incomplete quiz.</b><br/>If you choose \"Choose Quiz\", the saved quiz and all progress will be automatically deleted. There is no way to undo this.</span><br/><br/>".
		  "<a href='resume_quiz.php'>Resume Quiz</a></div><br />");
} 
?>
	<div id="choose_quiz"><a href='choose_quiz.php'>Choose Quiz</a></div>
	<div id="submit_question"><a href='submit_question.php'>Submit A Question</a></div>
<?php
if($memorabilia_cost < $user_item["usercredit"]) {
	print("<div id='purchase_memorabilia'><a href='purchase_memorabilia.php'>Purchase Memorabilia</a></div>");
}	

?>
	<div id="my_account"><a href='my_account.php'>My Account</a></div>
<?php
// Check if the user has admin-flag
if($user_item["isadmin"]) {
	// the user is admin  
	print("<br/><div id='admin_menu'><a href='admin_menu.php'>Administration</a></div>");
}
?>
<br />
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