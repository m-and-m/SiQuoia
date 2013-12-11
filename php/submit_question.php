<?php
include("connection.php");
server_connect();

session_start();
$userid = $_SESSION["userid"];
$username = $_SESSION["username"];

$query0  = "select isadmin, savedquiz, usercredit from user_profile p, user_data d where p.userid=d.userid and p.userid='".$userid."'";
$result0 = pdo_query($query0);    
$user_item  = $result0->fetch();
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">

<html>
 <head>
 	<title>SUBMIT A QUIZ</title>
	<script src="../js/source/jquery-1.10.2.min.js" type="text/javascript"></script>	
	<script src="../js/check_empty.js" type="text/javascript"></script>
 </head>
 <body>
 
 <header>
  <h1>SiQuoia - <?php print($username); ?>'s page</h1><hr>  
 </header>
 
 <div class="content">
 <h2>SUBMIT A QUIZ</h2>
  <hr>
  <form action="evaluate_submission.php" method="post" enctype="multipart/form-data">
  	<span><b>WARNING:</b> When you use apostrophe, type like this: <b>\'</b></span><br/><br/>
  	<span> 1) Create your question.</span><br/>
	<textarea name="text_question" rows="5" cols="50"></textarea>
    <br/><br/>
  	<span> [OPTIONAL] You can submit one multimedia file (Audio, Graphics, or Video)<br/> 
  	Filetype: .jpg, .png, .gif, .mp3, .mp4, or .flv, size must be < 6.5 MB</span><br/>
	<input type="hidden" name="MAX_FILE_SIZE" value="6815744"/><br/>
	<input type="file" name="multimedia_question" size="50"/><br/><br/>
  	<span> 2) Create 4 possible answers </span><br/>
	1st answer&nbsp;<input type="text" name="answer1" size="50"/><br/>
	2nd answer&nbsp;<input type="text" name="answer2" size="50"/><br/>
	3rd answer&nbsp;<input type="text" name="answer3" size="50"/><br/>
	4th answer&nbsp;<input type="text" name="answer4" size="50"/><br/><br/>
  	<span> 3) Choose correct answer </span><br/>
	<input type="radio" name="correct_answer" value="1"/>1
	<input type="radio" name="correct_answer" value="2"/>2
	<input type="radio" name="correct_answer" value="3"/>3
	<input type="radio" name="correct_answer" value="4"/>4<br/><br/>

	<input type="submit" value="SUBMIT"/><br/>
  </form>
  <br/>

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