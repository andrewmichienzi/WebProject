<?php 

	if(!(isset($_SESSION['username']) 
				&& isset($_SESSION['userId'])
				&& isset($_SESSION['name']))) {
					session_regenerate_id(true);
					header("Location: login.html");
					exit();
	} else {
		$_SESSION['groupId'] = $_GET['groupId'];
		session_regenerate_id(true);
		header("Location: ../MessageBoard/messages.html");
		exit();
	}
?>
