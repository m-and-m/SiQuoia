<?php
include("connection.php");
server_connect();

$questionid = $_POST["qid"];
print($questionid);
/*
// Get user correct answer
$query0  = "select username, savedquiz from user_profile p, user_data d where p.userid=d.userid and p.userid='".$userid."'";
$result0 = pdo_query($query0);    
$user_item  = $result0->fetch();
*/
server_disconnect();
?>