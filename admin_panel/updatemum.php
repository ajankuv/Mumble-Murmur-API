<?php
include("../inc/config.inc.php");
?>
<?php

# post details from editserver.php
$sid=$_POST['servid'];
$shost=$_POST['hostn'];
$sip=$_POST['ipaddy'];
$sactive=$_POST['op'];

mysql_connect($host,$user,$pwd);
@mysql_select_db($database) or die( "Unable to select database");
$query = "UPDATE servers SET hostname='$shost', ip_address='$sip', active='$sactive' WHERE server_id='$sid'";
mysql_query($query);
echo "Record Updated Host= $shost ID= $sid";
mysql_close();   
?>
<html>
<head>
<meta http-equiv="refresh" content="0;URL='listservers.php'">
</head>
<body>
<br><br>
<center>
<p>Updated server.</p>
<p> <a href="listservers.php">Go back to main page</a></p>
</center>
</body>
</html>