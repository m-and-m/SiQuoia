<?php

mysql_connect("localhost", "root", "") or die(mysql_error());
mysql_query("CREATE DATABASE cs160") or die(mysql_error());

//mysql_connect("localhost", "sq04", "cs160") or die(mysql_error());

mysql_close();

?>
<html>
<head>
<title>Welcome to SiQuoia!</title>
<script type="text/javascript">

window.onload=timeout;
function timeout(){
window.setTimeout("redirect()",3000)}

function redirect(){
window.location="load_db.php"
return}

</script>
</head>
<body>

Created database. now to initialize.

</body>
</html>
