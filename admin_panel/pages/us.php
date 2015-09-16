<style type="text/css">
<!--
@import url("../../inc/style.css");
-->
</style>
<?php
include("../../inc/config.inc.php");

mysql_connect("$host", "$user", "$pwd") or die(mysql_error());
mysql_select_db("$database") or die(mysql_error());
$result = mysql_query("SELECT * FROM users WHERE mum_loc='us'") 
or die(mysql_error());  

echo "<table id='rounded-corner' summary='servers'>";
    echo "<thead>";
    	echo "<tr>";
        	echo "<th scope='col' class='rounded-company'><center>Email?</center></th>";
            echo "<th scope='col' class='rounded-q3'><center>Email</center></th>";
			echo "<th scope='col' class='rounded-q3'><center>Mumble Host</center></th>";
            echo "<th scope='col' class='rounded-q3'><center>Mumble Port</center></th>";
			echo "<th scope='col' class='rounded-q3'><center>Mumble ID</center></th>";
			echo "<th scope='col' class='rounded-q3'><center>Active</center></th>";
			echo "<th scope='col' class='rounded-q3'><center>Location</center></th>";
			echo "<th scope='col' class='rounded-q3'><center>Edit</center></th>";
			echo "<th scope='col' class='rounded-q4'><center>Stop</center></th>";
        echo "</tr>";
    echo "</thead>";
    echo "<tbody>";

while($row = mysql_fetch_array( $result )) {
$del = "<center><a href='blah.php?id=" . $row['id'] . "'><img src='../img/page_cross.gif'></a></center>";
$edit = "<center><a href='edit.php?id=" . $row['id'] . "'><img src='../img/page_edit.gif'></a></center>";
	echo "<tr><td><center>"; 
	echo "<a href=pages/us.php?id=". $row['id'] ." target=_blank><img src=../img/mail.gif></a>";
	echo "</center></td><td><center>";
	echo $row['email'];
	echo "</center></td><td><center>";
	echo $row['mum_host'];
	echo "</center></td><td><center>";  
	echo $row['mum_port'];
	echo "</center></td><td><center>"; 
	echo $row['mum_id'];
	echo "</center></td><td><center>";
	echo $row['mum_active'];
	echo "</center></td><td><center>";
	echo $row['mum_loc'];
	echo "</center></td><td><center>";
	echo $edit;
	echo "</center></td><td>";	
	echo $del;
	echo "</td></tr>"; 
    echo "</tbody>";
}

echo "<tfoot>";
  echo "<tr>";
	echo "<td colspan='8' class='rounded-foot-left'></td>";
    echo "<td class='rounded-foot-right'>&nbsp;</td>";
  echo "</tr>";
echo "</table>";
echo "</tfoot>";
?>

<?php
$connection = mysql_connect("$host", "$user", "$pwd");
mysql_select_db("$database", $connection);
if (isset($_GET["id"]) && is_numeric($_GET["id"]))
{
   $getvars = mysql_query("SELECT * FROM users WHERE id=" . $_GET["id"]);
   $vars = mysql_fetch_array($getvars);
   $memail = $vars['email'];
   $mhost  = $vars['mum_host'];
   $mport  = $vars['mum_port'];
   $mname  = $vars['firstname'];

$to = $memail;
$subject = "Your Newrez mumble server info.";
$message = "Welcome to Newrez " . $mname . "! Here is your mumble server info!  Host:" . $mhost . "  Port:" . $mport;
$from = "admin@newrez.com";
$headers = "From:" . $from;
mail($to,$subject,$message,$headers);
echo "Email sent!";
} 
else {
   echo "";
}
?> 