<!DOCTYPE html>
<html lang="en">
<head>
		<?php print html::stylesheet(array('media/css/site'),array('screen')); ?>
</head>
<body >
	<?php
	///$user = ORM::factory('user',Auth::instance()->get_user()->username);
	$idname = html::specialchars(Auth::instance()->get_user()->idname);
	$username = html::specialchars(Auth::instance()->get_user()->username);
	$logo = url::base()."media/img/banner/lovecenterlogo_small.png";
	$signout_img = url::base()."media/img/banner/logout_bttn.jpg";
	$db = new Site_Model();
	/*TODO: write select with join using array index and values*/
	$querystr = sprintf('select id,sysconfig_id,app_version,db_version,environment from sysconfigs where sysconfig_id = "%s"',"SYSTEM");
	$result = $db->executeSelectQuery($querystr);
//print_r($result); print "<hr>";
	$row = $result[0];
	$TEXT=<<<_TEXT_
	<div id="cmdbox">
<!--	<table border="0" cellspacing=0 cellpadding=2>
		<tr>
			<td align="left"><img src=$logo border=0 /></td>
   			<td align="left"><a href='login' target='_parent' title='Log Out'><img src=$signout_img /></td>
		</tr>
	</table>
-->		
	<table border="0" cellspacing=0 cellpadding=1>
		<tr><td><b>User Id :</b></td><td align="left">$idname</td></tr>
		<tr><td><b>Signon Name :</b></td><td align="left">$username</td></tr>
		<tr><td><b>App Version :</b></td><td align="left">$row->app_version</td></tr> 
		<tr><td><b>DB Version :</b></td><td align="left">$row->db_version</td></tr> 
		<tr><td><b>Environment :</b></td><td align="left">$row->environment</td></tr>
	</table>

	</div>
_TEXT_;
	print $TEXT;
	?>
</body>
</html>   