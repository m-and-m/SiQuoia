<?php
include("../skip/mysql_login.php");
$pdo;

function server_connect() {
	GLOBAL $pdo, $db_host, $db_name, $db_user, $db_pass;
				
	try {
		//print("connecting to server...<br/>");
   		$pdo = new PDO("mysql:host=" . $db_host . "; dbname=" . $db_name, $db_user, $db_pass, 
   						array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
	//$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			
	} catch (PDOException $e) {
   		print("Connection Failed: " . $e->getMessage());
	}
} // server_connect

function pdo_query($statement) {
	GLOBAL $pdo;
	return $pdo->query($statement);
} // pdo_query

function pdo_prepare($statement) {
	GLOBAL $pdo;
	return $pdo->prepare($statement);
} // pdo_prepare

function server_disconnect() {
	//print("disconnecting from server...<br/>");
	GLOBAL $pdo;
	$pdo = null;
} // server_discpnnect

function pdo_transactionstart() {
	GLOBAL $pdo;
	$pdo->beginTransaction();
} // pdo_transactionstart

function pdo_commit(){
	GLOBAL $pdo;
	$pdo->commit();
} // pdo_commit

function pdo_rollback(){
	GLOBAL $pdo;
	$pdo->rollBack();
} // pdo_rollback

function pdo_errorInfo(){
	GLOBAL $pdo;
	$pdo->errorInfo();
} // pdo_rollback

?>