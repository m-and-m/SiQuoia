<?php
include("connection.php");
server_connect();

session_start();
$userid = $_SESSION["userid"];

// DELETE ME
print("session id: ".$userid."<br/>");

$query0  = "select username, userpoint, usedtrial from user_profile p, user_data d where p.userid=d.userid and p.userid='".$userid."'";
$result0 = pdo_query($query0);    
$user_item  = $result0->fetch();

//DELETE ME
var_dump($user_item);

$username = $user_item["username"];
$curr_point = $user_item["userpoint"];
$usedtrial = $user_item["usedtrial"];
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">

<html>
 <head>
 	<title>CHOOSE A QUIZ</title>
	<script src="../js/source/jquery-1.10.2.min.js" type="text/javascript"></script>	
	<script src="../js/check_empty.js" type="text/javascript"></script>
 </head>
 <body>
 
 <header>
  <h1>SiQuoia - <?php print($username)?>'s page</h1><hr>  
 </header>
 
 <div class="content">
 <h2>CHOOSE A QUIZ</h2>
  <hr>
<?php
// Show the total point
	print("Your current point: ".$curr_point." points<br/>");
// Trial quiz
	if(!$usedtrial) {
		print("here");
	}
// Pick one of category (subject, topic, subtopic)
// Select button and start game

?>
<br />
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