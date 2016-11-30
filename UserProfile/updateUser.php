<?php

	require '../checkSessionInformation.php';
    checkSessionInformation();
	session_start();
	
	$userId = $_SESSION['userId'];
	
	include '../databaseConnection.php';
	$conn = getDBConnection();
	if($conn->connection_error)
		die("Connection failed: " . $conn->connect_error);
	
	$name = $_POST['name'];
	$phone = $_POST['phone'];
	$email = $_POST['email'];
	
	$sql = "UPDATE Users SET name='".$name."', email='".$email."', phone='".$phone."' WHERE userId='".$userId."';" ;
	$result = mysql_query($sql, $conn);
	
?>