<?
//Load db settings
include("inc/config.inc.php");
//Load php-ice mods
require_once 'Ice.php';
require_once 'inc/Murmur_1.2.3.php';



$conf = $_GET['conf'];
if(is_null($conf)) {
echo "No conf value.";
}
else{
mysql_connect("$host", "$user", "$pwd") or die(mysql_error());
mysql_select_db("$database") or die(mysql_error());
$result = mysql_query("SELECT * FROM users") 
or die(mysql_error());  
$row = mysql_fetch_array( $result );
echo $row['id'];
echo "&nbsp;&nbsp;";
echo $row['email'];
echo "&nbsp;&nbsp;";
echo $row['mum_host'];
echo "&nbsp;&nbsp;";
echo $row['mum_port'];
echo "&nbsp;&nbsp;";
echo "value for" . $conf . "is"
}
?>



