<?php

    $host = "localhost";
    $user = "root";
    $pass = "";
    $database = "cs160";

	$connection = mysqli_connect($host, $user, $pass) or die('Could not connect: ' . mysql_error());
    
	
	
	/**
*function adds a purchase transaction to table
* @return nothing
*/

	function addPurchase($userid, $packetid, $purchasetype, $cost)	{
	    $query = "INSERT INTO `purchase` 
		(`purchaseid`, `userid`, `packetid`, 
		`purchase_type`, `cost`, `purchased_date`)
		  VALUES (
		  '" . $pid . "', '" . $qid .  "', '" . $userid .  "', '" . $packetid .  "', '"
		   . $purchasetype .  "', '" . $acost .  "', CURDATE()  '";
        $result = mysql_query($connection, $query);
		if (!$result) {
    		$message  = 'Invalid query: ' . mysql_error() . "\n";
    		$message .= 'Whole query: ' . $query;
    		die($message);
		}
	}
	
	
/**
* Function retrieves purchase type from table using purchase id
* @return purchase_type
*/
	function getPurchaseType($purchaseid)	{
		$query = "SELECT purchase_type FROM purchase where purchaseid='" . $purchaseid . "'";
	    $result = mysql_query($connection, $query);
		if (!$result) {
    		$message  = 'Invalid query: ' . mysql_error() . "\n";
    		$message .= 'Whole query: ' . $query;
    		die($message);
		}
		$row = mysql_fetch_assoc($result);
		$type = $row['purchase_type'];	
		return $type;
	}
	
/**
*Function removes a purchase from the database
*return nothing
*/
    function removeFromPurchase($purchaseid)	{
        $query = "DELETE FROM purchase WHERE purchaseid='" . $purchaseid . "'";
        $result = mysql_query($connection, $query);
		if (!$result) {
    		$message  = 'Invalid query: ' . mysql_error() . "\n";
    		$message .= 'Whole query: ' . $query;
    		die($message);
		}
	}
	
/**
*Function counts packets bought by user 
*@returns query of transactions
*/
    function findPurchases($userid)	{
        $query = "SELECT * FROM purchase WHERE userid='" . $userid . "'";
        $result = mysql_query($connection, $query);
		if (!$result) {
    		$message  = 'Invalid query: ' . mysql_error() . "\n";
    		$message .= 'Whole query: ' . $query;
    		die($message);
		}
		return $result;
	}
	
/**
* Function finds number of packets sold
* @returns number of packets bought
*/
	function countPackets($userid)	{
        $query = "SELECT * FROM purchase WHERE userid='" . $userid . "' AND purchase_type!='MEMOR'";
		$result = mysql_query($connection, $query);
		if (!$result) {
    		$message  = 'Invalid query: ' . mysql_error() . "\n";
    		$message .= 'Whole query: ' . $query;
    		die($message);
		}
		$numrows = mysql_num_rows($result);
		return $numrows;
	}

/**
* Function returns mysql query of packets bought by user
* @returns number of packets bought
*/
	function getPackets($userid)	{
        $query = "SELECT * FROM purchase WHERE userid='" . $userid . "' AND purchase_type!='MEMOR'";
		$result = mysql_query($connection, $query);
		if (!$result) {
    		$message  = 'Invalid query: ' . mysql_error() . "\n";
    		$message .= 'Whole query: ' . $query;
    		die($message);
		}
		return $result;
	}
	
/**
* Function returns mysql query of packets bought by user
* @returns number of packets bought
*/
	function getPacketsByDate($userid)	{
        $query = "SELECT * FROM purchase WHERE userid='" . $userid . "' AND purchase_type!='MEMOR' ORDER BY date";
		$result = mysql_query($connection, $query);
		if (!$result) {
    		$message  = 'Invalid query: ' . mysql_error() . "\n";
    		$message .= 'Whole query: ' . $query;
    		die($message);
		}
		return $result;
	}
/**
* Function finds what memorabilia bought by user
* @returns query result
*/
	function getMemor($userid)	{
        $query = "SELECT * FROM purchase WHERE userid='" . $userid . "' AND purchase_type='MEMOR'";
		$result = mysql_query($connection, $query);
		if (!$result) {
    		$message  = 'Invalid query: ' . mysql_error() . "\n";
    		$message .= 'Whole query: ' . $query;
    		die($message);
		}
		return $result;
	}
/**
* Function finds what memorabilia bought by user, sorted by date
* @returns query result
*/
	function getMemorByDate($userid)	{
        $query = "SELECT * FROM purchase WHERE userid='" . $userid . "' AND purchase_type='MEMOR' ORDER BY date";
		$result = mysql_query($connection, $query);
		if (!$result) {
    		$message  = 'Invalid query: ' . mysql_error() . "\n";
    		$message .= 'Whole query: ' . $query;
    		die($message);
		}
		return $result;
	}
	
/**
* Function counts how much a user has spent
* @returns number spent
*/
	function countExpenditure($userid)	{
		$result = findPurchases($userid);
		$count = 0;
		while($row = mysql_fetch_assoc($result))	{
			$count .= 	$row['cost'];
		}
		return $cost;
	}
	


?>
