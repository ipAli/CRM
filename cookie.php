<?php
	$time = 3600*24*30;
	if(!$_COOKIE['not_new']){
		setcookie("not_new", '1', time() + $time);
		setcookie("client_view_names", '1', time() + $time);
		setcookie("client_view_telephone", '1', time() + $time);
		setcookie("client_view_email", '1', time() + $time);
		setcookie("client_view_type", '1', time() + $time);
		setcookie("client_view_manager", '1', time() + $time);
	}
?>