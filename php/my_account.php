<?php
include("connection.php");
include("mm_php_library.php");

server_connect();

session_start();
$userid = $_SESSION["userid"];
$username = $_SESSION["username"];

// DELETEME
//print("session id: ".$userid."<br/>");
/*
$query0  = "select isadmin, savedquiz, usercredit from user_profile p, user_data d where p.userid=d.userid and p.userid='".$userid."'";
$result0 = pdo_query($query0);    
$user_item  = $result0->fetch();
//DELETEME
//var_dump($user_item);
*/
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">

<html>
 <head>
 	<title>MY ACCOUNT</title>
	<script src="../js/source/jquery-1.10.2.min.js" type="text/javascript"></script>	
	<script src="../js/check_empty.js" type="text/javascript"></script>
 </head>
 <body>
 
 <header>
  <h1>SiQuoia - <?php print($username); ?>'s page</h1><hr>  
 </header>
 
 <div class="content">
 <h2>MY ACCOUNT</h2>
  <hr>
<!--LEADERBOARD-->
<div id='leaderboard'>
<h2>Leaderboard</h2>
	<?php
		$query0 = "select * from user_data d, user_profile p where d.userid = p.userid order by userpoint desc limit 10";
		$result0 = pdo_query($query0);
		$user_item = $result0->fetchAll(PDO::FETCH_ASSOC);
//		var_dump($user_item);
		$i = 0;
		$previous_user_point = 0;
		foreach($user_item as $auser){

			$current_user_point = $auser["userpoint"];

			if($previous_user_point != $current_user_point) {
				$i++;
			}
			print($i.": ".$auser["userpoint"]." ( ".$auser["username"]." )<br/>");		

			$previous_user_point = $auser["userpoint"];
		}
	?>

</div>
<!--PURCHASE HISTORY-->
<div id='purchase_history'>
<h2>Purchase History</h2>
</div>
<!--POINTS HISTORY-->
<div id='points_history'>
</div>

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

<!--
	$query1  = "select * from question where qid='".$curr_qid."'";
//DELETEME
//print("mm_library: ".$query1."<br/>");
	$result1 = pdo_query($query1);    
	$user_item = $result1->fetch(PDO::FETCH_ASSOC);

	print("<div id='question_content'><p>".$user_item['question']."</p>");

//Check if the question has media, and check what kind of media
	if($user_item['media'] != null) {
-->