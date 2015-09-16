<?php
include("../inc/config.inc.php");
?>
<html>
<head>
<style type="text/css">
body{
font-family:"Lucida Grande", "Lucida Sans Unicode", Verdana, Arial, Helvetica, sans-serif;
font-size:12px;
}
p, h1, form, button{border:0; margin:0; padding:0;}
.spacer{clear:both; height:1px;}
/* ----------- My Form ----------- */
.myform{
margin:0 auto;
width:400px;
padding:14px;
}

/* ----------- stylized ----------- */
#stylized{
border:solid 2px #b7ddf2;
background:#ebf4fb;
}
#stylized h1 {
font-size:14px;
font-weight:bold;
margin-bottom:8px;
}
#stylized p{
font-size:11px;
color:#666666;
margin-bottom:20px;
border-bottom:solid 1px #b7ddf2;
padding-bottom:10px;
}
#stylized label{
color:#666666;
display:block;
font-size:11px;
font-weight:normal;
text-align:right;
width:140px;
}
#stylized .small{
color:#666666;
display:block;
font-size:11px;
font-weight:normal;
text-align:right;
width:140px;
}
#stylized input{
float:left;
font-size:12px;
padding:4px 2px;
border:solid 1px #aacfe4;
width:200px;
margin:2px 0 20px 10px;
}
#stylized button{
clear:both;
margin-left:150px;
width:125px;
height:31px;
background:#666666 url(img/button.png) no-repeat;
text-align:center;
line-height:31px;
color:#FFFFFF;
font-size:11px;
font-weight:bold;
}
</style>
</head>

<?php
$connection = mysql_connect("$host", "$user", "$pwd");
	mysql_select_db("$database", $connection);
		if (isset($_GET["id"]) && is_numeric($_GET["id"]))
{
$sid=mysql_query("SELECT * FROM users WHERE id = " . $_GET["id"]);
	while($row = mysql_fetch_array( $sid )) {

#html echo
echo "<BR><BR><BR>";
echo "<div id='stylized' class='myform'>";
echo "<form id='form' name='form' method='post' action='updatemum.php'>";
echo "<h1 align='center'>Edit $row[email]'s server.</h1>";

echo "<label>Mumble ID";
echo "</label>";
echo "<input type='text' name='servid' value='$row[mum_id]' readonly />";

echo "<label>Mumble Port";
echo "</label>";
echo "<input type='text' name='hostn' value='$row[mum_port]' readonly />";

echo "<label>Mumble Location";
echo "</label>";
echo "<input type='text' name='ipaddy' value='$row[mum_loc]' readonly />";

echo "<label>Active";
echo "</label>";
echo "<input name='op' type='text' value='$row[mum_active]' readonly />";

echo "<button type='submit'>Edit server</button>";
echo "<div class='spacer'></div>";
echo "</form>";
echo "</div>";





}
}
 else {
   die("No server with that id.");
}

   ?>
</html>