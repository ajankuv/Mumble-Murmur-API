<?php
//Load db settings
include("../inc/config.inc.php");

//Load php-ice mods
require_once 'Ice.php';
require_once '../inc/Murmur_1.2.3.php';

if (empty($_GET["id"])) {
echo "No user id set!";
}
else{
$uid = $_GET["id"];
mysql_connect("$host", "$user", "$pwd") or die(mysql_error());
mysql_select_db("$database") or die(mysql_error());
$result = mysql_query("SELECT * FROM users WHERE id = '$uid'")
or die(mysql_error());
$result2 = mysql_fetch_array( $result );
$mserver = $result2["mum_host"];
$mport = $result2["mum_port"];
$mid = $result2["mum_id"];
$mloc = $result2["mum_loc"];
// mumble connection and tree fetch
$result3 = mysql_query("SELECT * FROM mservers WHERE hostname = '$mserver'"); 
$muminfo = mysql_fetch_array( $result3 );
$icepass = array('secret'=>''.$muminfo['icepass'].'');
$mip = $muminfo['ip'];

session_start();
$_SESSION['mumip'] = $mip;
$_SESSION['mumport'] = $mport;
$_SESSION['icepass'] = $icepass;

require_once 'MumbleReader.class.php';

// GET
//$port = (isset($_GET['port']))?filter_input(INPUT_GET, 'port', FILTER_VALIDATE_INT):0;

$mReader = new MumbleReader($mport);

//Make sure page is not cached
header ("Expires: Thu, 17 May 2001 10:17:17 GMT");    // Date in the past
header ("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT"); // always modified
header ("Cache-Control: no-cache, must-revalidate");  // HTTP/1.1
header ("Pragma: no-cache");                          // HTTP/1.0
//header ("Content-type: application/json"); //Not sure if this is nice because sometimes it will return json but for the rest it returns javascrpt
//output the json
echo $mReader->render();
}
?>
