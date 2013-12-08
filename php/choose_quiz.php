<?php
include("connection.php");
server_connect();

session_start();
$userid = $_SESSION["userid"];
$username = $_SESSION["username"];

// Get user information
$query0  = "select userpoint, usedtrial from user_profile p, user_data d where p.userid=d.userid and p.userid='".$userid."'";
$result0 = pdo_query($query0);    
$user_item  = $result0->fetch();

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
<?php
	// Show the total point
	print("Your current point: ".$user_item["userpoint"]." points<br/><br/>");

	//Drop Down option from packet list
	print("<div id='static_question'><p>STATIC(?) QUIZ</p><form action='start_quiz.php' method='post'>");
?>
    <select name="category_select" size="10">
		<?php    
			// Trial quiz
			if(!$user_item["usedtrial"]) {
				print("<optgroup label='TRIAL'>");
				print("<option value='p1'>FRIENDS(TV)</option>");
			}
		?>
		<optgroup label="ALL">
		<?php
		/*
			foreach($subject_item as $row) {
				print("<option value='".$row["subjectid"]."'>".strtoupper($row["s_name"])."</option>");
			}
		*/
		?>
		</optgroup>		
		</optgroup>
    </select>
    <input type="hidden" name="quiz_type" value="static_quiz"/>    
    <input type="submit" value="START"/>
  </form>
  </div>	
<br/>

  <!--Drop Down option from packet list-->
  <div id="random_question">
  <p>RANDOM QUIZ</p>
  <form action='start_quiz.php' method='post'>
    <select name="category_select" size="20">
		<?php    
			// Trial quiz
			if(!$user_item["usedtrial"]) {
				print("<optgroup label='TRIAL'>");
				print("<option value='all'>RANDOM QUIZ</option></optgroup>");
			}
		?>
		<optgroup label="SUBJECT">
		<?php
			foreach($subject_item as $row) {
				print("<option value='".$row["subjectid"]."'>".strtoupper($row["s_name"])."</option>");
			}
		?>
		</optgroup>		
		<optgroup label="TOPIC">
		<?php
			foreach($topic_item as $row) {
				print("<option value='".$row["topicid"]."'>".strtoupper($row["t_name"])."</option>");
			}
		?>
		</optgroup>
		<optgroup label="SUBTOPIC">
		<?php
			foreach($subtopic_item as $row) {
				print("<option value='".$row["subtopicid"]."'>".strtoupper($row["st_name"])."</option>");
			}
		?>
		</optgroup>
		<optgroup label="RANDOM SELECTION">
			<option>EASY</option>
			<option>MEDIUM</option>					
			<option>HARD</option>
		</optgroup>
		
    </select>
    <input type="hidden" name="quiz_type" value="random_quiz"/>        
    <input type="submit" value="START"/>
  </form></div>
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