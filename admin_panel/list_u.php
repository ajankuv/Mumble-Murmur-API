<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml2/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<link rel="stylesheet" type="text/css" href="ajaxtabs/ajaxtabs.css" />
<script type="text/javascript" src="ajaxtabs/ajaxtabs.js">
/***********************************************
* Ajax Tabs Content script v2.2- © Dynamic Drive DHTML code library (www.dynamicdrive.com)
* This notice MUST stay intact for legal use
* Visit Dynamic Drive at http://www.dynamicdrive.com/ for full source code
***********************************************/
</script>
</head>
<body>

<ul id="countrytabs" class="shadetabs">
<li><a href="pages/us.php" rel="#default#" class="selected">USA Mumble</a></li>
<li><a href="pages/hk.php" rel="countrycontainer1">HongKong Mumble</a></li>
<li><a href="pages/list.php" rel="countrycontainer2">All</a></li>
</ul>

<div id="countrydivcontainer" style="border:0px solid gray; width:750px; margin-bottom: 1em; padding: 10px">
<p>default</p>
</div>

<script type="text/javascript">

var countries=new ddajaxtabs("countrytabs", "countrydivcontainer")
countries.setpersist(true)
countries.setselectedClassTarget("link") //"link" or "linkparent"
countries.init()

</script>
</body>
</html>