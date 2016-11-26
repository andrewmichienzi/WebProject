<?php
	require '../databaseConnection.php';
	session_start();
	$userInfo = array();
	if(isset($_SESSION['username']) 
		&& isset($_SESSION['userId'])
		&& isset($_SESSION['name'])) {
			$userInfo['username'] = $_SESSION['username'];
			$userInfo['userId'] = $_SESSION['userId'];
			$userInfo['name'] = $_SESSION['name'];
			$userInfo['userVars'] = 'true';
	} else {
		$userInfo['userVars'] = 'false';
	}

	if(isset($_SESSION['groupId'])) {
		$userInfo['groupId'] = $_SESSION['groupId'];
		$userInfo['groupVar'] = 'true';
	} else {
		$userInfo['groupVar'] = 'false';
	}
	echo json_encode($userInfo);
?>
