<?
//Load db settings
include("inc/config.inc.php");

//Load php-ice mods
require_once 'Ice.php';
require_once 'inc/Murmur_1.2.3.php';

//connection to db
mysql_connect("$host", "$user", "$pwd") or die(mysql_error());
mysql_select_db("$database") or die(mysql_error());
$result = mysql_query("SELECT id FROM $usertbl WHERE active = '0'")
or die(mysql_error());  

//Grab user to activate + grab port to use from db for new server
$new = mysql_fetch_array( $result );
$uid = $new['id'];
$local = mysql_query("SELECT * FROM $usertbl WHERE id = '$uid'");
$local2 = mysql_fetch_array( $local );
$mloc = $local2['mum_loc'];
$server = mysql_query("SELECT * FROM $servtbl WHERE location = '$mloc' AND active = '1'");
$server2 = mysql_fetch_array( $server );
$mhost = $server2['hostname'];
$mip = $server2['ip'];
$mice = $server2['icepass'];
$mport = $server2['port'];
$rand = substr(str_shuffle(str_repeat('abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789',8)), 0, 8);
$grabacct = $local2['userId'];
$getacct = mysql_query("SELECT * FROM accounts WHERE id = '$grabacct'");
$acctinfo = mysql_fetch_array( $getacct );
$memail = $acctinfo['email'];
$mname = $acctinfo['fullName'];

//Ice password
$icepass = array('secret'=>''.$mice.'');


//Check for new users and create mumble virtual server
if(is_null($uid)) {
echo "No new users";
}
else{
$ICE = Ice_initialize();
$meta = Murmur_MetaPrxHelper::checkedCast($ICE->stringToProxy('Meta:tcp -h '. $mip .' -p 6502')->ice_context($icepass));
	$sid = $meta->newServer()->ice_context($icepass)->id();
    print $sid;
	$meta->getServer(intval($sid))->ice_context($icepass)->setConf('users', '10');
	$meta->getServer(intval($sid))->ice_context($icepass)->setConf('welcometext', 'Newrez.com Free Mumble Server');
	$meta->getServer(intval($sid))->ice_context($icepass)->setConf('textmessagelength', '1000');
	$meta->getServer(intval($sid))->ice_context($icepass)->setConf('timeout', '30');
	$meta->getServer(intval($sid))->ice_context($icepass)->setConf('bandwidth', '72000');
	$meta->getServer(intval($sid))->ice_context($icepass)->setConf('port', $mport);
	$meta->getServer(intval($sid))->ice_context($icepass)->setConf('password', $rand);
	$meta->getServer(intval($sid))->ice_context($icepass)->start();
	
//Update db for user + port management
$query = "UPDATE $usertbl SET mum_host='$mhost', mum_id='$sid', mum_port='$mport', active='1' WHERE id='$uid'";
$query2 = "UPDATE $servtbl SET scount = scount +1, port = port +1 WHERE port='$mport' AND location='$mloc'";
$query3 = "UPDATE $usertbl SET mum_pass='$rand' WHERE id='$uid'";

mysql_query($query);
mysql_query($query2);
mysql_query($query3);
//email user new server info
$to = $memail;
$subject = "Your Newrez mumble server info!";
$message = "Welcome to Newrez " . $mname . "! Here is your new mumble server info!  Host:" . $mhost . "  Port:" . $mport . "  SuperUser Pass:" . $rand;
$from = "no-reply@newrez.com";
$headers = "From:" . $from;
mail($to,$subject,$message,$headers);
mysql_close();
}

// Values for data for users at this point are..
// $mport for their new mumble port
// $sid for mumble server id for the user
// $mhost for the hostname of their server

?>