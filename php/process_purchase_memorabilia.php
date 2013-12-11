<?php
include("connection.php");
include("mm_php_library.php");
include("sq_currency.php");

server_connect();
session_start();
$userid = $_SESSION["userid"];
$username = $_SESSION["username"];

$num_memora_purchase = $_REQUEST["total_nummemora"];
//DELETEME
//print("The total number: ".$num_memora_purchase);

$total_amount_to_pay = ($num_memora_purchase * $memorabilia_cost);
$purchasetype = "MEMOR";
/*
//FIXME
$query0  = "select isadmin, savedquiz, usercredit from user_profile p, user_data d where p.userid=d.userid and p.userid='".$userid."'";
$result0 = pdo_query($query0);    
$user_item  = $result0->fetch();
*/
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">

<html>
 <head>
 	<title>PURCHASE MEMORABILIA</title>
	<script src="../js/source/jquery-1.10.2.min.js" type="text/javascript"></script>	
	<script src="../js/check_empty.js" type="text/javascript"></script>
 </head>
 <body>
 
 <header>
  <h1><?php include("../html/sq_logo.html"); print("&nbsp;&nbsp;&nbsp;".ucfirst($username)."'s page"); ?></h1><hr>  
 </header>
 
 <div class="content">
 <h2>PURCHASE MEMORABILIA</h2>
  <hr>
  
  <?php
 pdo_transactionstart();
 
//2) decrement the usercredit
	use_credit($total_amount_to_pay, $userid);	
	
//3) add purchase information in purchase
	add_purchase_information($userid, "", $purchasetype, $total_amount_to_pay);
	
	print("Now you have new ".$num_memora_purchase." memorabilia!<br/><br/>");
	pdo_commit();
  ?>

	<br/>

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