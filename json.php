<?
//Load db settings
include("inc/config.inc.php");

//Load php-ice mods
require_once 'Ice.php';
require_once 'inc/Murmur_1.2.3.php';

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
$ICE = Ice_initialize();
$meta = Murmur_MetaPrxHelper::checkedCast($ICE->stringToProxy('Meta:tcp -h '. $mip .' -p 6502')->ice_context($icepass));
//getTree command http://mumble.sourceforge.net/slice/Murmur/Server.html#getUsers
$sgettree = $meta->getServer(intval($mid))->ice_context($icepass)->getTree();
$sname = $meta->getServer(intval($mid))->ice_context($icepass)->getConf("registername");
$stest = $meta->getServer(intval($mid))->ice_context($icepass)->getUsers();
//$sroot = $meta->getServer(intval($mid))->ice_context($icepass)->defaultchannel($sgettree);
$suptime = $meta->getServer(intval($mid))->ice_context($icepass)->getUptime();
$stree = $sgettree->c->id;
$server['root'] = "0";
$server['name'] = $sname;
$server['id'] = $mid;
$server['uptime'] = $suptime;
$server['x_connecturl'] = "conurl";
$arraytest = array($stest);

echo json_encode($server);
echo "<br/>";
print_r ($arraytest);
echo "<br/>";
print_r ($sgettree);




}
?>
