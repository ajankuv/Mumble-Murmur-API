<?
//Load db settings
include("../inc/config.inc.php");

//Load php-ice mods
require_once 'Ice.php';
require_once '../inc/Murmur_1.2.3.php';

//connection to db
mysql_connect("$host", "$user", "$pwd") or die(mysql_error());
mysql_select_db("$database") or die(mysql_error());
$result = mysql_query("SELECT * FROM mservers WHERE location = 'us'")
or die(mysql_error());  
$result2 = mysql_query("SELECT * FROM mservers WHERE location = 'hk'");
//Grab user to activate + grab port to use from db for new server
$us = mysql_fetch_array( $result );
$hk = mysql_fetch_array( $result2 );

?>
<html>
<head>
<link href="../inc/menu.css" rel="stylesheet" type="text/css" />
</head>
<body>
</center>
<font color="#000000" size="1" face="Verdana, Arial, Helvetica, sans-serif">
<strong>::Newrez</br>::API</br>::Portal</strong></br>
</font>
</center>
</br>
<div id="menu">
<ul>
<li><a href="main.php" target="main">Home</a></li>
<li><a href="list_s.php" target="main">List servers</a></li>
<li><a href="list_u.php" target="main">List users</a></li>
<li><a href="#">&nbsp;</a></li>
<li><a href="#">&nbsp;</a></li>
<li><a href="logout.php" target="main">Logout</a></li>
</ul>
</div><br/>
<font color="#000000" size="1" face="Verdana, Arial, Helvetica, sans-serif">
<strong>::Email search</strong><br/></font>
<form id="form" name="form" method="post" action="display.php" target="main">
<input name="email" type="text" class="tb8"><br/>
<input name="Submit" type="submit" class="fb9" id="Submit" value="Submit">
<br/><br/>
<font color="#000000" size="1" face="Verdana, Arial, Helvetica, sans-serif">
<strong>::Server count<br/>
::USA Cali = <? echo $us['scount']?><br/>
::HongKong = <? echo $hk['scount']?><br/>
</strong><br/></font>
</body>
</html>