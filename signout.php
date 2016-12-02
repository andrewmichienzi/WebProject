<?php
	session_start();
	if(isset($_SESSION['username'])){
		unset($_SESSION['username']);
	}
	if(isset($_SESSION['userId'])){
		unset($_SESSION['userId']);
	}
	if( isset($_SESSION['name'])){
		unset($_SESSION['name']);
	}
	if(isset($_SESSION['groupId'])) {
		unset($_SESSION['groupId']);
	}

	session_regenerate_id(true);
	header("Location: ./Home/login.html");
	exit();
?>
