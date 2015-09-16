<?
//Load db settings
include("inc/config.inc.php");
//Load php-ice mods
require_once 'Ice.php';
require_once 'inc/Murmur_1.2.3.php';

$start = $_GET['start'];
$end = $_GET['end'];
if(is_null($start)){
echo "No values!";
}
else{
foreach (range($start, $end) as $number) {
mysql_connect("$host", "$user", "$pwd") or die(mysql_error());
mysql_select_db("$database") or die(mysql_error());	
$result = mysql_query("SELECT * FROM users WHERE id = '$number' AND mum_active = '1' ")
or die(mysql_error());
$row = mysql_fetch_array( $result );
$uid = $row['id'];
if (empty($uid)) {   
echo $number . "&nbsp;&nbsp; not a valid userid.<br/>";
continue;
}
$mhost = $row['mum_host'];
$result2 = mysql_query("SELECT * FROM mservers WHERE hostname = '$mhost'"); 
$muminfo = mysql_fetch_array( $result2 );
$icepass = array('secret'=>''.$muminfo['icepass'].'');
$mip = $muminfo['ip'];
$ICE = Ice_initialize();
$meta = Murmur_MetaPrxHelper::checkedCast($ICE->stringToProxy('Meta:tcp -h '. $mip .' -p 6502')->ice_context($icepass));
$sid = $row['mum_id'];
$meta->getServer(intval($sid))->ice_context($icepass)->setConf('bandwidth', '72000');
echo $row['email'];
echo "&nbsp;&nbsp;". $row['mum_port'] ."&nbsp;&nbsp; updated conf value.<br/>";
sleep(3);
	}
}
?>



