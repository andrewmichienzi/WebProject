<?php
	
	require '../checkSessionInformation.php';
    checkSessionInformation();
	session_start();
	
	$userId = $_SESSION['userId'];
	
	include '../databaseConnection.php';
	$conn = getDBConnection();
	if($conn->connection_error)
		die("Connection failed: " . $conn->connect_error);
	
	$userData = array();
	
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