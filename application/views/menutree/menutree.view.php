<?php
$head = html::stylesheet(array('media/css/jquery.treeview','media/css/screen'),array('screen','screen'));
$head .=html::script(array('media/js/jquery-1.7.min','media/js/jquery.cookie.js','media/js/jquery.treeview.js'));

$HTML=<<<_HTML_
	<!DOCTYPE html>
	<html lang="en">
		<title></title>
		$head
		<script type="text/javascript">
		$(function() {
			$("#tree").treeview({
				collapsed: true,
				animated: "low",
				control:"#sidetreecontrol",
				prerendered: false,
				persist: "menuconf"
			});
		})
		
		</script>
	</head>	
	<body style="margin: 0px 0px 0px 10px;">
	<div id="sidetree">
	<div class="treeheader">&nbsp;</div>
	<div id="sidetreecontrol"> <a href="?#">Collapse All</a> | <a href="?#">Expand All</a> </div>
_HTML_;
	print $HTML;
	print ($usermenu);	
	$HTML=<<<_HTML_
	</body >
	<html>
_HTML_;
	print $HTML;
?>