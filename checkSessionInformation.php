<?php
		function checkSessionInformation() {
			session_start();

			// Check if user information is set
			if(!(isset($_SESSION['username']) 
				&& isset($_SESSION['userId'])
				&& isset($_SESSION['name']))) {
					session_regenerate_id(true);
					header("Location: login.html");
					exit();
			// Check if the group id is set
			} else if(!(isset($_SESSION['groupId']))) {
				session_regenerate_id(true);
				header("Location: ../Home/home.html");
				exit();
			} 
		}
?>
