<?php
include("connection.php");
include("mm_php_library.php");
server_connect();

session_start();
$userid = $_SESSION["userid"];

// FIXME - fetching unnecesary info
// Get user information
$query0  = "select username, userpoint, usedtrial from user_profile p, user_data d where p.userid=d.userid and p.userid='".$userid."'";
$result0 = pdo_query($query0);    
$user_item  = $result0->fetch();

$selected_category = $_POST["category_select"];

/*
// DELETME
 print($selected_question."<br/>"); //st0
 print("'st': ".find_category($selected_category, "st")."<br/>");
 print("'t': ".find_category($selected_category, "t")."<br/>");
 print("'s': ".find_category($selected_category, "s")."<br/>");
 print("'ts': ".find_category($selected_category, "ts")."<br/>");
*/

/*MEMO: find_category($str, "all")
if the string contains all, return true(or, 1)
if the string doesn't contain, return false
*/
if (find_category($selected_category, "s")) {
	// pick from topic
} elseif(find_category($selected_category, "t")) {
	// pick from topic
} elseif(find_category($selected_category, "st")) { // pick from subtopic
	
	if($selected_category === "st0") {
// 1) get a quiz set
		$query0  = "select questionid_set from packet where p_name in".
				   "(select st_name from subtopic where subtopicid ='st0')";
		$result0 = pdo_query($query0);    
		$q_item  = $result0->fetch();
		$questionid_json = json_decode($q_item["questionid_set"], true);

// DELETEME
		foreach($questionid_json as $row) {
			var_dump($row);
			print("<br/>");
		}

	}
// 2) put the quiz set into the user's 'savedquiz'
/* 3) Go to another page for actual 'taking-quiz' page
       => for now, use this page as debug-page
 	   => later, delete html part, and navigat to the next page
*/

// @) fix format for questionid_set (delete "answered", generate it automatically)
} elseif(find_category($selected_category, "all")) {
	// special case that a packet will be random selection from entire question
} else {
	print("Your choice is not available currently.");
}

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">

<html>
 <head>
 	<title>???? QUIZ</title>
	<script src="../js/source/jquery-1.10.2.min.js" type="text/javascript"></script>	
	<script src="../js/check_empty.js" type="text/javascript"></script>
 </head>
 <body>
 
 <header>
  <h1>SiQuoia - <?php print($user_item["username"])?>'s page</h1><hr>  
 </header>
 
 <div class="content">
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