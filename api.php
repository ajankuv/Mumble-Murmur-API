<?php
//Load php-ice mods
require_once 'Ice.php';
require_once 'inc/Murmur_1.2.3.php';

//Ice password
$icepass = array('secret'=>'$$$$$');

//Connection to mumble1.newrez.com
$ICE = Ice_initialize();
$meta = Murmur_MetaPrxHelper::checkedCast($ICE->stringToProxy('Meta:tcp -h mururip_here -p 6502')->ice_context($icepass));

//api calls
if (isset($_GET['m'])) {
        if ($_GET['m'] == 'stop') {
                try { $meta->getServer(intval($_GET['id']))->ice_context($icepass)->stop(); }
                catch (Exception $e) { echo 'unable to stop server'; }
        } elseif ($_GET['m'] == 'start') {
                try { $meta->getServer(intval($_GET['id']))->ice_context($icepass)->start(); }
                catch (Exception $e) { echo 'unable to start server'; }
        } elseif ($_GET['m'] == 'delete') {
                try { $meta->getServer(intval($_GET['id']))->ice_context($icepass)->delete(); }
                catch (Exception $e) { echo 'unable to delete server'; }
        } elseif ($_GET['m'] == 'new') {
				$sid = $meta->newServer()->ice_context($icepass)->id();
                print $sid;
				$meta->getServer(intval($sid))->ice_context($icepass)->setConf('users', '5');
				$meta->getServer(intval($sid))->ice_context($icepass)->setConf('welcometext', 'Newrez.com Free Mumble Server');
				$meta->getServer(intval($sid))->ice_context($icepass)->setConf('textmessagelength', '1000');
				$meta->getServer(intval($sid))->ice_context($icepass)->setConf('timeout', '30');
				$meta->getServer(intval($sid))->ice_context($icepass)->setConf('bandwidth', '72000');
        } elseif ($_GET['m'] == 'setconf') {
                $meta->getServer(intval($_GET['id']))->ice_context($icepass)->setConf($_GET['key'], $_GET['value']);
        } elseif ($_GET['m'] == 'addchannel') {
                try { $meta->getServer(intval($_GET['id']))->ice_context($icepass)->addChannel($_GET['name'], intval($_GET['parent'])); }
                catch (Exception $e) { echo 'unable to add channel'; }
        } elseif ($_GET['m'] == 'removechannel') {
                try { $meta->getServer(intval($_GET['id']))->ice_context($icepass)->removeChannel(intval($_GET['cid'])); }
                catch (Exception $e) { echo 'unable to remove channel'; }
        } elseif ($_GET['m'] == 'conf') {
				$dumpconf = $meta->getDefaultConf();
				echo �;
				print_r($dumpconf);
				echo �;
        }else {
                echo "No var set.";
		}
}
?>
