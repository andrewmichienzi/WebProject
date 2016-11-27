<?php 
	session_start();
	if(!(isset($_SESSION['username']) 
				&& isset($_SESSION['userId'])
				&& isset($_SESSION['name']))) {
					session_regenerate_id(true);
					header("Location: login.html");
					exit();
	} else {
		$_SESSION['groupId'] = $_GET['groupId'];
		$_SESSION['groupName'] = $_GET['groupName'];
		
		session_regenerate_id(true);
		header("Location: ../MessageBoard/messages.html");
		exit();
	}
?>
