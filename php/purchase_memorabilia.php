<?php
include("connection.php");
include("mm_php_library.php");
include("sq_currency.php");

server_connect();

session_start();
$userid = $_SESSION["userid"];
$username = $_SESSION["username"];

$memorabilia_locate = "../files/sq04/crown.jpg";
//FIXME
$query0  = "select usercredit from user_data where userid='".$userid."'";
$result0 = pdo_query($query0);    
$user_item  = $result0->fetch();

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
	<div id="display_memorabilia">
	<?php
		print("<img src=".$memorabilia_locate." alt='memorabilia sticker' height='100' width='100'>");
	?>
	</div>
	<div id="purchasing_memorabilia">
	<form action="process_purchase_memorabilia.php">
		<select name="total_nummemora">
			<?php
//1) choosing the number of meorabilia
				$total_num_memora = nummemora_availability($user_item["usercredit"], $memorabilia_cost);
				for($i = 1; $i < ($total_num_memora+1); $i++) {
					print("<option value='".$i."'>".$i."</option>");			
				}
			?>
		</select>
		<input type="submit" value="PURCHASE">
	</form>
	</div>
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