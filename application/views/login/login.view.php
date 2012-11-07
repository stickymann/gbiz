<!DOCTYPE html>
<html lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<title></title>
	<?php 	print html::stylesheet(array('media/css/jqeasy'),array('screen')); ?>
	</head>
	<body>
	<div id="container">
<?php
if(!$isLoginOk)
{
	$urlbase = url::base();
	print html::script(array('media/js/jquery-1.7.min','media/js/jquery.form-2.4.0.min.js','media/js/jqeasy.dropdown.min.js'));
	print '<div id="signbtn"><a href="login" class="btnsignin">Sign In</a><span class="errmsg">'.$status.'</span></div>';
	print '<br><img src="'.$urlbase.'/media/img/login/gpsrescue.750w.png" border=0 align=middle><br>';
	//print '<br><img src="'.$urlbase.'/media/img/login/soulmap_large.png" border=0 align=middle><br>';
	
	print '<div id="frmsignin">';
    print form::open('login',array('autocomplete'=>'off'));
    print '<p id="puser">';
	print form::label('username', 'Username:');
	print form::input('username', $form['username']);
	print '</p><p>';
	print form::label('password', 'Password:'); 
	print form::password('password',$form['password']);
	print '</p><p class="submit">';
	print form::submit('submitbtn', 'Login');
	print form::hidden('status',$status,'disabled');
	print '</p>';
	print form::close();
    
}
	print '<p id="msg">'.$status.'</p></div></div>'; 
	
?>
</body>
</html>


		