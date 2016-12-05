<?php

	include  '../checkSessionInformation.php';
    checkSessionInformation();
	session_start();
	
	$userId = $_SESSION['userId'];
	
	include '../databaseConnection.php';
	$conn = getDBConnection();
	if($conn->connection_error)
		die("Connection failed: " . $conn->connect_error);
	
	$groupId = $_POST['group'];

	$sql = "DELETE FROM UserGroups WHERE groupId = ".$groupId." AND userId = ".$userId.";";
	$result = mysql_query($sql, $conn);
	echo mysql_affected_rows($result);
	echo 'hi';
?>