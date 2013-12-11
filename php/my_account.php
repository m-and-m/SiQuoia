<?php
include("connection.php");
include("mm_php_library.php");
include("sq_currency.php");
server_connect();

session_start();
$userid = $_SESSION["userid"];
$username = $_SESSION["username"];

$memorabilia_locate = "../files/sq04/crown.jpg";

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
  <h1><?php include("../html/sq_logo.html"); print("&nbsp;&nbsp;&nbsp;".ucfirst($username)."'s page"); ?></h1><hr>  
 </header>
 
 <div class="content">
 <h2>MY ACCOUNT</h2>
  <hr>

<!--LEADERBOARD-->
<fieldset>
<legend><h2>Leaderboard</h2></legend>
<div id='leaderboard'>
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
				print($i.": ".ucfirst($auser["username"])." ( ".$auser["userpoint"]." points )<br/>");		

				$previous_user_point = $auser["userpoint"];
				// Show the ranking up to top 10
				if($i > 9) {
					break;
				}
		}
		
	?>
</div>
</fieldset>

<!--PURCHASE HISTORY-->
<fieldset>
<legend><h2>Purchase History</h2></legend>
<div id='purchase_history'>

	<?php
//Packet
		print("<b>Question Packets:</b><br/>");	

		$item_type = "STATI";		
		$featured_count = get_total_purchase_item($item_type, $userid);
		$featured_count = (isset($featured_count) ? $featured_count : 0);

		$item_type = "SUBJE";		
		$subject_count = get_total_purchase_item($item_type, $userid);
		$subject_count = (isset($subject_count) ? $subject_count : 0);
		
		$item_type = "TOPIC";		
		$topic_count = get_total_purchase_item($item_type, $userid);
		$topic_count = (isset($topic_count) ? $topic_count : 0);
		
		$item_type = "SUBTO";		
		$subtopic_count = get_total_purchase_item($item_type, $userid);
		$subtopic_count = (isset($subtopic_count) ? $subtopic_count : 0);
		
		$item_type = "BRAND";		
		$branded_count = get_total_purchase_item($item_type, $userid);
		$branded_count = (isset($branded_count) ? $branded_count : 0);
		
		$item_type = "MISCE";		
		$random_count = get_total_purchase_item($item_type, $userid);
		$random_count = (isset($random_count) ? $random_count : 0);

		print("Featured: ".$featured_count."<br/>");
		print("Subject: ".$subject_count."<br/>");
		print("Topic: ".$topic_count."<br/>");
		print("Subtopic: ".$subtopic_count."<br/>");
		print("Branded: ".$branded_count."<br/>");
		print("Miscelleneous: ".$random_count."<br/>");

		print("<br/>");
//Memorabilia
		print("<b>Memorabilia:</b><br/>");

		$item_type = "MEMOR";		
		$memora_count = get_total_purchase_item($item_type, $userid);
		
		for(;$memora_count > 0; $memora_count--) {
			print("<img src=".$memorabilia_locate." alt='memorabilia sticker' 
					height='50' width='50'>");	
		}
		print("<br/><br/>");
//Expenditure
		print("<b>Total Expenditure:</b><br/>");

		$query1 = "select sum(cost) from purchase where userid='".$userid."'";
		$result1 = pdo_query($query1);
		$row_cost = $result1->fetch(PDO::FETCH_ASSOC);
		$total_amount = $row_cost["sum(cost)"];
		
		print($total_amount." SQ credits<br/>");
	?>
</div>
</fieldset>

<!--POINTS HISTORY-->
<fieldset>
<legend><h2>Point History</h2></legend>
<div id='points_history'>
	<?php
// Total points	
		print("<b>Total Points Earned:</b><br/>");	
		$query10 = "select userpoint from user_data where userid = '".$userid."'";
		$result10 = pdo_query($query10);
		$row_point = $result10->fetch(PDO::FETCH_ASSOC);
		$total_point = $row_point["userpoint"];
		print($total_point." points<br/><br/>");

// By introducing a friend		
		print("<b>Points Earned By Referring Friends:</b><br/>
				(".$introduce_friend_point." SQ credit per a friend)<br/>");	
		$query11 = "select username, p.userid from user_profile p, user_data d
					where p.userid = d.userid and introducedby ='".$userid."'";
		$result11 = pdo_query($query11);
		$row_introduced = $result11->fetchAll(PDO::FETCH_ASSOC);

		print("The username you introduced: ");
		foreach($row_introduced as $oneid) {
			print($oneid["username"]."&nbsp;&nbsp;&nbsp;&nbsp;");
		}
		print("<br/>");
		$point_by_introduce = (count($row_introduced) * $introduce_friend_point);
		print("Total credits: ".$point_by_introduce."<br/><br/>");

// By submit a question
		print("<b>Points Earned By Submitting Questions:</b><br/>
				(".$submit_quiz_point." SQ credit per a question)<br/>");	
		$query12 = "select count(*) from question where submitedby = '".$userid."'";
		$result12 = pdo_query($query12);
		$row_submit = $result12->fetch(PDO::FETCH_ASSOC);
		$point_by_submission = $row_submit["count(*)"];
		print("Total credits: ".$point_by_submission."<br/><br/>");
	
	?>
</div>
</fieldset>

<br />
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
