<!DOCTYPE html>
<html lang="en">
<head>
		<?php print html::stylesheet(array('media/css/site'),array('screen')); ?>
</head>
<body bgcolor="#ffffff">
	<?php
	///$user = ORM::factory('user',Auth::instance()->get_user()->username);
	$idname = html::specialchars(Auth::instance()->get_user()->idname);
	$username = html::specialchars(Auth::instance()->get_user()->username);
	$logo = url::base()."media/img/banner/gpsrescue-logo.small.png";
	$signout_img = url::base()."media/img/banner/logout7525.jpg";
	$TEXT=<<<_TEXT_
	<div id="banner">
	<table border="0" cellspacing=0 cellpadding=0>
		<tr>
			<td width="75%" align="left"><img src=$logo border=0 /></td>
   			<td align="left"><a href='login' target='_parent' title='Log Out'><img src=$signout_img /></td>
		</tr>
	</table>
	</div>
_TEXT_;
	print $TEXT;
	?>
</body>
</html>   