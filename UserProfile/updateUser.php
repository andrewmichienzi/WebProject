<?php

	include '../databaseConnection.php';

	require '../checkSessionInformation.php';
    //checkSessionInformation();
	session_start();
	
	//$userId = $_SESSION['userId'];
	$userId = 4;
	
	$conn = getDBConnection();
	
	$name = $_POST['name'];
	$phone = $_POST['phone'];
	$email = $_POST['email'];
	
	// use session varible userId to update user profile
	$sql = "UPDATE Users SET name='".$name."', email='".$email."', phone='".$phone."' WHERE userId='".$userId."';" ;
	$result = mysql_query($sql, $conn);
	
	echo "User updated.";
	
?>