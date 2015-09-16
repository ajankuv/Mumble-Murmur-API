<style type="text/css">
<!--
@import url("../inc/style.css");
-->
</style>

<BR>
<?php
include("../inc/config.inc.php");

mysql_connect("$host", "$user", "$pwd") or die(mysql_error());
mysql_select_db("$database") or die(mysql_error());
$result = mysql_query("SELECT * FROM mservers") 
or die(mysql_error());  

echo "<table id='rounded-corner' summary='servers'>";
    echo "<thead>";
    	echo "<tr>";
        	echo "<th scope='col' class='rounded-company'><center>ID</center></th>";
            echo "<th scope='col' class='rounded-q1'><center>Hostname</center></th>";
            echo "<th scope='col' class='rounded-q2'><center>IP</center></th>";
            echo "<th scope='col' class='rounded-q3'><center>Icepass</center></th>";
			echo "<th scope='col' class='rounded-q3'><center>Server Count</center></th>";
			echo "<th scope='col' class='rounded-q3'><center>Edit</center></th>";
            echo "<th scope='col' class='rounded-q4'><center>Delete</center></th>";
        echo "</tr>";
    echo "</thead>";
    echo "<tbody>";

while($row = mysql_fetch_array( $result )) {
$del = "<center><a href='delete.php?id=" . $row['server_id'] . "'><img src='../img/page_cross.gif'></a></center>";
$edit = "<center><a href='editserver.php?id=" . $row['server_id'] . "'><img src='../img/page_edit.gif'></a></center>";
	echo "<tr><td><center>"; 
	echo $row['server_id'];
	echo "</center></td><td><center>"; 
	echo $row['hostname'];
	echo "</center></td><td><center>"; 
	echo $row['ip'];
	echo "</center></td><td>";
	echo $row['icepass'];
	echo "</center></td><td>";  
	echo $row['scount'];
	echo "</center></td><td>";  	
	echo $edit;
	echo "</td><td>";	
	echo $del;
	echo "</td></tr>"; 
    echo "</tbody>";
}

echo "<tfoot>";
  echo "<tr>";
	echo "<td colspan='6' class='rounded-foot-left'></td>";
    echo "<td class='rounded-foot-right'>&nbsp;</td>";
  echo "</tr>";
echo "</table>";
echo "</tfoot>";
?>