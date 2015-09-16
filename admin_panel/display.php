<style type="text/css">
<!--
@import url("../inc/style.css");
-->
</style>
<?
//Load db settings
include("../inc/config.inc.php");
//Load php-ice mods
require_once 'Ice.php';
require_once '../inc/Murmur_1.2.3.php';

$email = $_POST['email'];
if(is_null($email)) {
echo "No email.";
}
else{
if(isset($email)){
mysql_connect("$host", "$user", "$pwd") or die(mysql_error());
mysql_select_db("$database") or die(mysql_error());
$result = mysql_query("SELECT * FROM users WHERE email = '$email'") 
or die(mysql_error());  
//$row = mysql_fetch_array( $result );

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
	echo "<a href=display.php?id=". $row['id'] ." target=_blank><img src=../img/mail.gif></a>";
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
}
echo "<tfoot>";
  echo "<tr>";
	echo "<td colspan='8' class='rounded-foot-left'></td>";
    echo "<td class='rounded-foot-right'>&nbsp;</td>";
  echo "</tr>";
echo "</table>";
echo "</tfoot>";
}
?>