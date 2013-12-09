<?php

	//file needs to be in SiQuoia/db folder
    include "../skip/mysql_login.php";
    include "../skip/sesoning.php";

	$connection = mysqli_connect($db_host, $db_user, $db_pass, $db_name) or die('Could not connect: ' . mysql_error());


	$schema = file_get_contents('populate_schema.sql');
	$result = mysqli_multi_query($connection, $schema);
	do {;} while (mysqli_next_result($connection));
    
	$data = file_get_contents('loading_data.sql');
	$result = mysqli_multi_query($connection, $data);
	do {;} while (mysqli_next_result($connection));
    
	$data = file_get_contents('sports.sql');
	$result = mysqli_multi_query($connection, $data);
	do {;} while (mysqli_next_result($connection));

	$data = file_get_contents('autos.sql');
	$result = mysqli_multi_query($connection, $data);
	do {;} while (mysqli_next_result($connection));
    
	$branded = file_get_contents('lexus.sql');
	$result = mysqli_multi_query($connection, $branded);
	do {;} while (mysqli_next_result($connection));
    
    $bcrypt_pass = password_hash("SiQuoiaAdmin", PASSWORD_BCRYPT, $options);
    mysqli_query($connection, "UPDATE user_profile set userpass ='$bcrypt_pass' where userid='user0'");
	do {;} while (mysqli_next_result($connection));
    
    //print("databases initialized..<br>");
    
    //print("<a href='../html/splashpage.html>Go To SiQuoia</a><br>");
	/*
	 *make a data/result query for each .sql you need to load to db
	$schema = file_get_contents('populate_schema.sql');
	$result = mysqli_multi_query($schema);
	*/
	mysqli_close($connection);
		
?>
<html>
<head>
<title>Welcome to SiQuoia!</title>
<script type="text/javascript">

window.onload=timeout;
function timeout(){
window.setTimeout("redirect()",3000)}

function redirect(){
window.location="../html/splashpage.html"
return}

</script>
</head>
<body>

Initialized, redirecting to SiQuoia.

</body>
</html>
