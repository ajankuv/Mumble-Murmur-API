<?php
include("../inc/config.inc.php");
?>
<html>
<head>
<style type="text/css">
body{
	font-family: "Lucida Grande", "Lucida Sans Unicode", Verdana, Arial, Helvetica, sans-serif;
	font-size: 12px;
	background-color: #F0F0F0;
}
p, h1, form, button{border:0; margin:0; padding:0;}
.spacer{clear:both; height:1px;}
/* ----------- My Form ----------- */
.myform{
margin:0 auto;
width:400px;
padding:14px;
}

/* ----------- stylized ----------- */
#stylized{
border:solid 2px #b7ddf2;
background:#ebf4fb;
}
#stylized h1 {
font-size:14px;
font-weight:bold;
margin-bottom:8px;
}
#stylized p{
font-size:11px;
color:#666666;
margin-bottom:20px;
border-bottom:solid 1px #b7ddf2;
padding-bottom:10px;
}
#stylized label{
display:block;
font-weight:bold;
text-align:right;
width:140px;
float:left;
}
#stylized .small{
color:#666666;
display:block;
font-size:11px;
font-weight:normal;
text-align:right;
width:140px;
}
#stylized input{
float:left;
font-size:12px;
padding:4px 2px;
border:solid 1px #aacfe4;
width:200px;
margin:2px 0 20px 10px;
}
#stylized button{
clear:both;
margin-left:150px;
width:125px;
height:31px;
background:#666666 url(img/button.png) no-repeat;
text-align:center;
line-height:31px;
color:#FFFFFF;
font-size:11px;
font-weight:bold;
}
</style>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
</head>
<BR><BR><BR>
<div id="stylized" class="myform">
<form id="form" name="form" method="post" action="checklogin.php">
<h1 align="center">Login</h1>


<label>Username:
<span class="small">Your username.</span>
</label>
<input type="text" name="myusername" id="myusername" />

<label>Password:
<span class="small">Your password.</span>
</label>
<input name="mypassword" type="password" id="mypassword"/>


<button type="submit">Boooooooyaaaa</button>
<div class="spacer"></div>

</form>
</div>
</body>
</html>