<?php
include("connection.php");
include("mm_php_library.php");
include("sq_currency.php");

server_connect();

session_start();
$userid = $_SESSION["userid"];
$username = $_SESSION["username"];

// Get user information
$query0  = "select * from user_profile p, user_data d where p.userid=d.userid and p.userid='".$userid."'";
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
$query2  = "select * from topic";
$result2 = pdo_query($query2);    
$topic_item  = $result2->fetchAll(PDO::FETCH_ASSOC);
// Remove the 1st row of 2d array
array_shift($topic_item);

// Get subtopic information
$query3  = "select * from subtopic";
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

// Get all branded names
$query5  = "select st_name from subtopic where topicid in"
		  ." (select topicid from topic where t_name = 'branded')";
$result5 = pdo_query($query5);    
$branded_item  = $result5->fetchAll();
//var_dump($branded_item);
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">

<html>
 <head>
 	<title>CHOOSE A QUIZ</title>
	<script src="../js/source/jquery-1.10.2.min.js" type="text/javascript"></script>	
	<script src="../js/check_empty.js" type="text/javascript"></script>
	<script src="../js/did_you_answer.js" type="text/javascript"></script>

 </head>
 <body>
 
 <header>
  <h1><?php include("../html/sq_logo.html"); print("&nbsp;&nbsp;&nbsp;".ucfirst($username)."'s page"); ?></h1><hr>  
 </header>
 
 <div class="content">
 <h2>CHOOSE A QUIZ</h2>
  <hr>
  
<!-- Show the current SQ credit the user has -->
  <p>
  	<span>Your current SQ credit: <?php print($user_item["usercredit"]); ?></span><br/><br/>
 	<span>You can try <b>ONE</b> trial from 'Featured Quiz' or 'Random Quiz'</span><br/><br/>
  </p>

<!--Pre-existing question-->
	<div id='static_question'>
	<span><b>FEATURED QUIZ</b></span><br/>
	<?php print("<span>Required SQ credit: ".$static_packet_cost."</span>"); ?>
	
	<form action='start_quiz.php' id='featured_selection_form' method='post'>
    <select name="category_select" id="featured_selection" size="10">
		<?php    
			// Trial quiz
			if(!$user_item["usedtrial"]) {
				print("<optgroup label='TRIAL'>");
				print("<option value='p1'>FRIENDS(TV)</option>");
			}
		
		if($static_packet_cost <= $user_item["usercredit"]) {
			print("<optgroup label='ALL'>");
				foreach($packet_item as $row) {
					if($row["branded"] == ""){
						print("<option value='".$row["packetid"]."'>".strtoupper($row["p_name"])."</option>");
					}
				}
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
  <span><b>RANDOM QUIZ</b></span><br/>
  <?php print("<span>Required SQ credit: ".$subject_packet_cost." (Subject), ".
  			$topic_packet_cost." (Topic), ".$subtopic_packet_cost." (SubTopic), ".
  			$misc_packet_cost." (Misc)</span>");
   ?>

  <form action='start_quiz.php' id='random_select_form' method='post'>
    <select name="category_select" id="random_selection" size="20">
		<?php    
// TRIAL 
			if(!$user_item["usedtrial"]) {
				print("<optgroup label='TRIAL'>");
				print("<option value='all'>RANDOM QUIZ</option></optgroup>");
			}
// SUBJECT		
			if($subject_packet_cost <= $user_item["usercredit"]) {
				print("<optgroup label='SUBJECT'>");
				foreach($subject_item as $row) {
					if(strcmp($row["s_name"], "branded") != 0) {
						print("<option value='".$row["subjectid"]."'>".strtoupper($row["s_name"])."</option>");
					}
				}
				print("</optgroup>");
			}
// TOPIC
			if($topic_packet_cost <= $user_item["usercredit"]) {		
				print("<optgroup label='TOPIC'>");
				foreach($topic_item as $row) {
					if(strcmp($row["t_name"], "branded") != 0) {
						print("<option value='".$row["topicid"]."'>".strtoupper($row["t_name"])."</option>");
					}
				}
				print("</optgroup>");				
			}
// SUBTOPIC
			if($subtopic_packet_cost <= $user_item["usercredit"]) {		
				print("<optgroup label='SUBTOPIC'>");
				foreach($subtopic_item as $row) {
					foreach($branded_item as $abrand) {
						if(strcmp($abrand["st_name"], $row["st_name"]) != 0) {	
							print("<option value='".$row["subtopicid"]."'>".strtoupper($row["st_name"])."</option>");
						}		
					}
				}
				print("</optgroup>");				
			}
// MISCELLANEOUS
			if($misc_packet_cost <= $user_item["usercredit"]) {	
				print("<optgroup label='MISC'>");
				print("<option value='easy'>EASY</option>");
				print("<option value='hard'>HARD</option>");
				print("</optgroup>");
			}	
?>
		
		
    </select>
    <input type="hidden" name="quiz_type" value="random_quiz"/>        
    <input type="submit" value="START"/>
  </form>
  </div>
<br/>
<br/>
  <!--Branded Quiz-->
  <div id="branded_question">
  <span><b>BRANDED QUIZ</b></span><br/>
    <form action="start_quiz.php" id="branded_form" method="post">
    	<label>Promotion Code*&nbsp;<input type="text" name="b_code" id="b_code" autocomplete="off"/></label>
	    <input type="hidden" name="quiz_type" value="branded_quiz"/>        
    	<input type="submit" value="START"/>
  </form>
  </div>
<br /><br/>
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