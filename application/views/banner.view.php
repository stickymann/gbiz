<!DOCTYPE html>
<html lang="en">
<head>
		<?php print html::stylesheet(array('media/css/site'),array('screen')); ?>
</head>
<body id="bannerbody">
	<?php
	///$user = ORM::factory('user',Auth::instance()->get_user()->username);
	$idname = html::specialchars(Auth::instance()->get_user()->idname);
	$username = html::specialchars(Auth::instance()->get_user()->username);
	$logo = url::base()."media/img/banner/lovecenterlogo_small.png";
	$signout_img = url::base()."media/img/banner/signout_bttn.png";
	$TEXT=<<<_TEXT_
	<div id="banner">
	<table width="100%" border="0" cellspacing=0 cellpadding=0>
    <tr valign="center">
        <td width="70%"><img src=$logo border=0 align=middle></td>
        <td>
			<table width="100%" border="0" cellspacing=0 cellpadding=0 align="right">
				<tr>
					<td><b>User Id :</b></td><td align="left">$idname</td>
					<td rowspan=3><a href='login' target='_parent' title='Sign Out'><img src=$signout_img /></a></td>
				</tr>
				<tr><td><b>Signon Name :</b></td><td align="left">$username</td></tr>
				<tr><td><b>Version :</b></td><td align="left">0.10 rev 001</td></tr> 
			</table>
		</td>
	</tr>
	</table>
	</div>
_TEXT_;
	print $TEXT;
	?>
</body>
</html> 