<?php
include("connection.php");
include("mm_php_library.php");

server_connect();
session_start();

$rn_email = isset($_REQUEST["rn_email"]) ? $_REQUEST["rn_email"] : "";
$rn_pass = isset($_REQUEST["rn_pass"]) ? $_REQUEST["rn_pass"] : "";
   
// Check if the email exists
$query0  = "select userpass from user_profile where useremail='" . $rn_email. "'";
$result0 = pdo_query($query0);
$pass_exist = $result0->fetch();
$hush_pass = $pass_exist[0];

$rslt = password_verify($rn_pass, $hush_pass);

//DELETEME
//print("rn_pass: ".$rn_pass.", hush: ".$hush_pass.", result: ".($rslt == 1)."\n");

// Verify the email and password
if(($pass_exist == false) || ($rslt == null)) {

	print("The email address (".$rn_email.") is not in the system.<br/>");
	print("Or, the password is incorrect. Please try again.<br/>");	
	print ("<a href='../html/login.html'>Go Back Login Page</a>");	
	
} else { // Navigate a particular page 

	// Fetch userid
	$query1  = "select userid, username from user_profile where useremail='" . $rn_email. "'";
	$result1 = pdo_query($query1);
	$user_info = $result1->fetch();
	$userid = $user_info["userid"];
	$username = $user_info["username"];
	$_SESSION["userid"] = $userid;
	$_SESSION["username"] = $username;

	header("Location: menu.php");
	exit;
}

server_disconnect();
?>
