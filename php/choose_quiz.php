<?php
include("connection.php");
include("mm_php_library.php");
include("sq_currency.php");

server_connect();

session_start();
$userid = $_SESSION["userid"];
$username = $_SESSION["username"];

// Get user information
$query0  = "select userpoint, usedtrial, savedquiz from user_profile p, user_data d where p.userid=d.userid and p.userid='".$userid."'";
$result0 = pdo_query($query0);    
$user_item  = $result0->fetch();

// Delete savedquiz if it exists
delete_savedquiz($user_item, $userid);

// Get subject information
$query1  = "select * from subject";
$result1 = pdo_query($query1);    
$subject_item  = $result1->fetchAll(PDO::FETCH_ASSOC);
// Remove the 1st row of 2d array
array_shift($subject_item);

//DELETEME
//var_dump($subject_item);

// Get topic information
$query2  = "select topicid, t_name from topic";
$result2 = pdo_query($query2);    
$topic_item  = $result2->fetchAll(PDO::FETCH_ASSOC);
// Remove the 1st row of 2d array
array_shift($topic_item);

// Get subtopic information
$query3  = "select subtopicid, st_name from subtopic";
$result3 = pdo_query($query3);    
$subtopic_item  = $result3->fetchAll(PDO::FETCH_ASSOC);
// Remove the 1st row of 2d array
array_shift($subtopic_item);
//var_dump($subtopic_item);

// Get packet information
$query4  = "select * from packet";
$result4 = pdo_query($query4);    
$packet_item  = $result4->fetchAll(PDO::FETCH_ASSOC);
// Remove the 1st row of 2d array
array_shift($packet_item);
//var_dump($packet_item);

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
  <h1>SiQuoia - <?php print($username); ?>'s page</h1><hr>  
 </header>
 
 <div class="content">
 <h2>CHOOSE A QUIZ</h2>
  <hr>
  
  <!-- Show the total point -->
  <p>Your current point: <?php print($user_item["userpoint"]); ?> points<br/><br/></p>

    <!--Pre-existing question-->
	<div id='static_question'>
	<span>FEATURED QUIZ</span><br/>
	<?php print("<span>Cost: ".$static_packet_cost."</span>"); ?>
	
	<form action='start_quiz.php' method='post'>
    <select name="category_select" size="10">
		<?php    
			// Trial quiz
			if(!$user_item["usedtrial"]) {
				print("<optgroup label='TRIAL'>");
				print("<option value='p1'>FRIENDS(TV)</option>");
			}

		print("<optgroup label='ALL'>");
			foreach($packet_item as $row) {
				print("<option value='".$row["packetid"]."'>".strtoupper($row["p_name"])."</option>");
			}
		?>
		</optgroup>		
		</optgroup>
    </select>
    <input type="hidden" name="quiz_type" value="static_quiz"/>    
    <input type="submit" value="START"/>
  </form>
  </div>	
<br/>
<br/>
  <!--Random question-->
  <div id="random_question">
  <span>RANDOM QUIZ</span><br/>
  <?php print("<span>Cost: ".$static_packet_cost." (Subject), ".
  			$topic_packet_cost." (Topic), ".$subtopic_packet_cost." (SubTopic), ".
  			$random_packet_cost." (Random)</span>");
   ?>

  <form action='start_quiz.php' method='post'>
    <select name="category_select" size="20">
		<?php    
			// Trial quiz
			if(!$user_item["usedtrial"]) {
				print("<optgroup label='TRIAL'>");
				print("<option value='all'>RANDOM QUIZ</option></optgroup>");
			}
		?>
		<?php
			print("<optgroup label='SUBJECT'>");

			foreach($subject_item as $row) {
				print("<option value='".$row["subjectid"]."'>".strtoupper($row["s_name"])."</option>");
			}
		?>
		</optgroup>		
		<?php

			print("<optgroup label='TOPIC'>");
			foreach($topic_item as $row) {
				print("<option value='".$row["topicid"]."'>".strtoupper($row["t_name"])."</option>");
			}
		?>
		</optgroup>
		<?php

		print("<optgroup label='SUBTOPIC'>");
			foreach($subtopic_item as $row) {
				print("<option value='".$row["subtopicid"]."'>".strtoupper($row["st_name"])."</option>");
			}
		?>
		</optgroup>
		<optgroup label="RANDOM SELECTION">
			<option value="easy">EASY</option>
			<option value="hard">HARD</option>
		</optgroup>
		
    </select>
    <input type="hidden" name="quiz_type" value="random_quiz"/>        
    <input type="submit" value="START"/>
  </form>
  </div>
<br/>
<br/>
  <!--Branded Quiz-->
  <div id="branded_question">
  <span>BRANDED QUIZ</span><br/>
    <form action="verify_branded_code.php" id="register_form" method="post">

    	<label>Promotion Code*&nbsp;<input type="text" name="b_code" id="b_code"/></label>
    	<input type="submit" value="START"/>
  </form>
  </div>
<br /><br/>
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