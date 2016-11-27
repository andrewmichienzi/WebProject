<?php

	include '../databaseConnection.php';
	session_start();
	$conn = getDBConnection();
	
	$userData = array();
	
	$userId = $_SESSION['userId'];
	$sql = "SELECT * FROM Users WHERE userId ='".$userId."';";
	$result = mysql_query($sql, $conn);
	
	while($row = mysql_fetch_array($result)) {
		$userData['name'] = $row[1];
		$userData['username'] = $row[2];
		$userData['email'] = $row[3];
		$userData['phone'] = $row[4];
	}
	
	echo json_encode($userData);
	
?>