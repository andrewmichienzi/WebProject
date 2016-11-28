<?php
	
	require '../databaseConnection.php';
	$conn = getDBConnection();
	if($conn->connection_error)
		die("Connection failed: " . $conn->connect_error);
	
	$groupId = 1;
	
	$sql = "SELECT * FROM MessageBoard WHERE groupId=" .$groupId. ";";
	$result = mysql_query($sql, $conn);
	
	if($result == NULL) {
		echo "none";
	}
	
	$postData = array();
	
	while($row = mysql_fetch_array($result)) {
		
		$postData['date'] = $row['postDate'];
		$postData['message'] = $row['message'];
		$userID = $row['userId'];
		$sql2 = "SELECT name FROM Users WHERE userId = '" .$userID. "';";
		$result2 = mysql_query($sql2, $conn);
		while($row = mysql_fetch_array($result2)) {
			$postData['user'] = $row['name'];
		}
	}
	
	echo json_encode($postData);
?>