<?php

	require '../checkSessionInformation.php';
    checkSessionInformation();
	session_start();
	
	$groupId = $_SESSION['groupId'];
	$userId = $_SESSION['userId'];
	$user = $_SESSION['user'];
	
	include '../databaseConnection.php';
	$conn = getDBConnection();
	if($conn->connection_error)
		die("Connection failed: " . $conn->connect_error);

	$message = $_POST['message'];
	
	$sql = "INSERT INTO MessageBoard (groupId, userId, postDate, message) VALUES (".$groupId.", ".$userId.", NOW(), '".$message."');";
	mysql_query($sql, $conn);

?>