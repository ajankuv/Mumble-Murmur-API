<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
  <head>
    <title>PHP Mumble Viewer</title>
    <meta http-equiv="content-type" content="text/html; charset=UTF-8" />
    <link rel="stylesheet" type="text/css" href="style.css" />
    <link rel="shortcut icon" type="image/x-icon" href="mumble.ico" />
    <script type="text/javascript" src="http://cdn.rko.nu/jquery-qtip/jquery-1.3.2.min.js"></script>
    <script type="text/javascript" src="http://cdn.rko.nu/jquery-qtip/jquery.qtip-1.0.0-rc3.min.js"></script>
    <script type="text/javascript" src="mumble.js"></script>

	
<script type='text/javascript'>
$(document).ready(function()
{
  load_mum();
  window.setInterval("load_mum();", 10000);
});

function load_mum() {
  mum('http://api.newrez.com/onlineusers.php?id=24', 'mum0');

}

</script>
  </head>
  <body>
    <table>
      <tr>
        <td VALIGN="top"><div id="mum0"></div></td>
      </tr>
    </table>
  </body>
</html>
