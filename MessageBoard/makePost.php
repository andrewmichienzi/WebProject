<?php

	require '../checkSessionInformation.php';
    //checkSessionInformation();
	session_start();
	
	include '../databaseConnection.php';
	
	$conn = getDBConnection();
	
	//$groupId = $_SESSION['groupId'];
	//$userId = $_SESSION['userId'];
	//$user = $_SESSION['user'];
	
	$groupId = 1;
	$userId = 4;
	$user = "algermo";

	$message = $_POST['message'];
	
	$sql = "INSERT INTO MessageBoard (groupId, userId, postDate, message) VALUES ('".$groupId."', '".$userId."', NOW(), '".$message."');";
	mysql_query($sql, $conn);

?>