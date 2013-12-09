<?php

	//file needs to be in SiQuoia/db folder
    $host = "localhost";
    $user = "root";
    $pass = "";
    $database = "cs160";

	$connection = mysqli_connect($host, $user, $pass) or die('Could not connect: ' . mysql_error());


	$schema = file_get_contents('populate_schema.sql');
	$result = mysqli_multi_query($schema);
	
	$data = file_get_contents('loading_data.sql');
	$result = mysqli_multi_query($data);
	
	/*
	 *make a data/result query for each .sql you need to load to db
	$schema = file_get_contents('populate_schema.sql');
	$result = mysqli_multi_query($schema);
	*/
	
		
?>
