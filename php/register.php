<?php
include("connection.php");
include("mm_php_library.php");
include("sq_currency.php");
include("../skip/sesoning.php");
server_connect();
session_start();

$new_email = isset($_REQUEST["new_email"]) ? $_REQUEST["new_email"] : "";
$new_name = isset($_REQUEST["new_name"]) ? $_REQUEST["new_name"] : "";
$new_pass = isset($_REQUEST["new_pass"]) ? $_REQUEST["new_pass"] : "";
$referred_by = isset($_REQUEST["referred"]) ? $_REQUEST["referred"] : "";
   
// Check if the email exists
$stmt = pdo_prepare("select useremail from user_profile where useremail = ?");
$stmt->bindParam(1, $new_email);
$result0 = $stmt->execute();
$email_exist = $stmt->fetch();

//DELETE ME
//var_dump ($email_exist);
?>	

<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">

<html>
 <head>
 	<title>REGISTER</title>
	<script src="../js/source/jquery-1.10.2.min.js" type="text/javascript"></script>	
 </head>
 <body>
 
 <header>
  <h1><?php include("../html/sq_logo.html"); ?></h1><hr>  
 </header>
 
 <div class="content">
  <h2>REGISTER</h2>
  <hr>
<?php
if($email_exist == true) {
	
	// By showing this in pop window by JS
		print ("<p>The email is already taken.<br/></p>");
		print ("<a href='../html/login.html'>Go Back Login Page</a>");	

} else {
	// start transaction 
	pdo_transactionstart();

	// Fetch the maximum value of the question id
	$table_name = "user_profile";
	$curr_id = get_max_id($table_name);

/*	
	// Fetch the maximum value of the user id
    $query1  = "select max(userid) from user_profile";
    $result1 = pdo_query($query1);

	// Generate new userid    
    $max_id  = $result1->fetch();
    $id_numpart = substr($max_id[0], 4);
    $curr_id = "user" . ($id_numpart + 1);
//DELETEME
//	print("old: " . $id_numpart . " current: " . $curr_id."\n");
*/
	// Bcrypt
	$bcrypt_pass = password_hash($new_pass, PASSWORD_BCRYPT, $options);
//DELETEME
//	print("hush pass: ".$bcrypt_pass."\n");
	
	// Check referred_by
	$referringid = "";
    $stmt = pdo_prepare("select userid from user_profile where useremail = ?");
    $stmt->bindParam(1, $referred_by);
    $result2 = $stmt->execute();
    $match_email = $stmt->fetch();

	if($match_email == true) {
		$referringid = $match_email[0];
	} else {
		$referringid = null;
	} 
//DELETEME
	//print($referringid."\n");

	// Create data set for user_profile
    $stmt = pdo_prepare("INSERT INTO user_profile VALUES (?, ?, ?, 0, ?, ?)");
    $stmt->bindParam(1, $curr_id);
    $stmt->bindParam(2, $new_name);
    $stmt->bindParam(3, $new_email);
    $stmt->bindParam(4, $bcrypt_pass);
    $stmt->bindParam(5, $referringid);
    $result3 = $stmt->execute();
	
	if($result3 == false) {
        print("Failed to create new user account(user_profile): " . pdo_errorInfo() . "<br />");
		// rollback transaction
		pdo_rollback();
	}

	// Create data set for user_data
	$query4  = "INSERT INTO user_data VALUES ('".$curr_id."',".$initial_credit.",0,'',0)";
    $result4 = pdo_query($query4);
	
	if($result4 == false) {
        print("Failed to create new user account(user_data): " . pdo_errorInfo() . "<br />");
		// rollback transaction
		pdo_rollback();
	}
	
	// end transaction / commit, otherwise rollback
	pdo_commit();
	
	$_SESSION["userid"] = $curr_id;
	$_SESSION["username"] = $new_name;
	
	print "<p>The registration is successfully completed. Enjoy the game!<br/></p>";
	print "<a href='menu.php'>Play Game</a>";	
	print "<br/><a href='logout.php'>Logout</a>";	
	
}
?>
 </div>

  <?php
	  include("../html/footer_group_logo.html");
  ?>
 </body>
</html>
<?php
server_disconnect();
?>
