<?php
include("../inc/config.inc.php");
require_once 'Ice.php';
require_once '../inc/Murmur_1.2.3.php';
?>
<html>
<head>
<style type="text/css">
#apDiv1 {
	position: absolute;
	left: 112px;
	top: 143px;
	width: 320px;
	height: 172px;
	z-index: 1;
	background-color: #e8edff;
}
#apDiv2 {
	position: absolute;
	left: 111px;
	top: 69px;
	width: 433px;
	height: 60px;
	z-index: 2;
	background-color: #e8edff;
}
#apDiv3 {
	position: absolute;
	left: 119px;
	top: 149px;
	width: 313px;
	height: 163px;
	z-index: 3;
}
.shadow {
  box-shadow:         4px 4px 3px 1.5px #ccc;
}
#apDiv4 {
	position: absolute;
	left: 253px;
	top: 398px;
	width: 141px;
	height: 26px;
	z-index: 4;
	vertical-align: middle;
	text-align: center;
}
table td {
	background-color:#F5F7FF;
	padding:2px;
	font-family: "Lucida Sans Unicode", "Lucida Grande", Sans-Serif;
	font-size:12px;
}
body {
	font-family: "Lucida Sans Unicode", "Lucida Grande", Sans-Serif;
	font-size:12px;
}
h1 {
	text-shadow: 0.1em 0.1em 0.2em black;
	font-size:25px;
}
#apDiv5 {
	position: absolute;
	left: 443px;
	top: 143px;
	width: 325px;
	height: 44px;
	z-index: 5;
	background-color: #e8edff;
}
#apDiv6 {
	position: absolute;
	left: 448px;
	top: 148px;
	width: 319px;
	height: 25px;
	z-index: 6;
}
#apDiv7 {
	position: absolute;
	left: 443px;
	top: 195px;
	width: 325px;
	height: 120px;
	z-index: 7;
	background-color: #e8edff
}
#apDiv8 {
	position: absolute;
	left: 450px;
	top: 201px;
	width: 316px;
	height: 133px;
	z-index: 8;
}
#apDiv9 {
	position: absolute;
	left: 112px;
	top: 324px;
	width: 506px;
	height: 47px;
	z-index: 9;
	background-color: #e8edff;
}
#apDiv10 {
	position: absolute;
	left: 118px;
	top: 329px;
	width: 496px;
	height: 38px;
	z-index: 10;
}
</style>
</head>



<?php
$connection = mysql_connect("$host", "$user", "$pwd");
	mysql_select_db("$database", $connection);
		if (isset($_GET["id"]) && is_numeric($_GET["id"]))
{
$uid=mysql_query("SELECT * FROM $usertbl WHERE id = " . $_GET["id"]);
	while($userinfo = mysql_fetch_array( $uid )) {

//user info from (newrez_main) id row
$mum_email=$userinfo[email];
$mum_loc=$userinfo[mum_loc];
$mum_id=$userinfo[mum_id];
$mum_port=$userinfo[mum_port];

//mumble server info for user above
$minfo=mysql_query("SELECT * FROM $servtbl WHERE location = '$mum_loc'");
$node = mysql_fetch_array( $minfo );
$mum_ip=$node[ip];
$mum_icepass=$node[icepass];
$mum_host=$node[hostname];

//mumble connection
$icepass = array('secret'=>''.$mum_icepass.'');
$ICE = Ice_initialize();
$meta = Murmur_MetaPrxHelper::checkedCast($ICE->stringToProxy('Meta:tcp -h '. $mum_ip .' -p 6502')->ice_context($icepass));

//not working user count connected to server
$users=$meta->getServer(intval($mum_id))->ice_context($icepass)->getUsers();
$c = 0;
foreach ($users as $usr) {	
$c++;
$usercount = $usr[number];
}

//$i = 0;
//foreach ($users as $user) {
//$i++;
//$usercount = $user[number];// if there are 15 $item[number] in this foreach, I want get the value : 15
//}

$online=array($users);

//not working showing mumble uptime, not server id uptime
$time=$meta->ice_context($icepass)->getUptime();

//online check up or dn
$serverup=$meta->getServer(intval($mum_id))->ice_context($icepass)->isRunning();

//$getserver=$meta->ice_context($icepass)->getServer(intval($mum_id));
//$onlineusers=$getserver->ice_context($icepass)->getUsers();
//Users online (<?echo count($online);?)



// api cmds
if (isset($_GET['m'])) {
        if ($_GET['m'] == 'stop') {
                try { $meta->getServer(intval($_GET['id']))->ice_context($icepass)->stop(); }
                catch (Exception $e) { echo 'unable to stop server'; }
        } elseif ($_GET['m'] == 'start') {
                try { $meta->getServer(intval($_GET['id']))->ice_context($icepass)->start(); }
                catch (Exception $e) { echo 'unable to start server'; }
		} elseif ($_GET['m'] == 'setconf') {
                $meta->getServer(intval($_GET['id']))->ice_context($icepass)->setConf($_GET['key'], $_GET['value']);
 }
}

}
}
 else {
   die("No server with that id.");
}

   ?>

   
   
   
   
   
   
   
   
<!--html here-->
<body>
<div id="apDiv1" class="shadow"></div>
<div id="apDiv2" class="shadow"><h1 align="center">Newrez Mumble Panel</h1></div>
<div id="apDiv3">
  <table width="308" height="161" border="0">
    <tr>
      <td width="114">Email:</td>
      <td width="174"><a href="mailto:<? echo $mum_email; ?>"><? echo $mum_email; ?></a></td>
    </tr>
    <tr>
      <td>Mumble ID:</td>
      <td><? echo $mum_id; ?></td>
    </tr>
        <tr>
      <td>Mumble Location:</td>
      <td><? echo $mum_loc; ?></td>
    </tr>
        <tr>
      <td>Mumble Server:</td>
      <td><? echo $mum_host; ?></td>
    </tr>
        <tr>
      <td>Mumble IP:</td>
      <td><? echo $mum_ip; ?></td>
    </tr>
        <tr>
      <td>Mumble Port:</td>
      <td><? echo $mum_port; ?></td>
    </tr>
  </table>
</div>
<div id="apDiv5" class="shadow"></div>
<div id="apDiv6">
  <table width="316" height="34" border="0">
    <tr>
      <td width="158"><div align="center">Server Status:<? echo $serverup ? " Online" : " Down!"; ?></div></td>
      <td width="158"><div align="center">Uptime: <? echo gmdate("d", $time); ?> days.</div></td>
    </tr>
  </table>
</div>
<div id="apDiv7" class="shadow"></div>
<div id="apDiv8">
  <table width="311" height="110" border="0">
    <tr>
      <td width="151">Users online:</td>
      <td width="150"><? echo $usercount; ?> / 8</td>
    </tr>
    <tr>
      <td>Start:</td>
      <td>blah</td>
    </tr>
    <tr>
      <td>Stop:</td>
      <td>blah</td>
    </tr>
  </table>
</div>
<div id="apDiv9" class="shadow"></div>
<div id="apDiv10">
  <table width="494" height="38" border="0">
    <tr>
      <td width="124">

<select name="key">
<option value="users">Slots</option>
<option value="password">Server pass</option>
</select></td>
      <td width="360"><input type="text" name="value">&nbsp;<input type="submit" value="Submit"></td>
    </tr>
  </table>
</div>
</body>
   
   
   
   
   
   
   
   
   
   
 </html>

