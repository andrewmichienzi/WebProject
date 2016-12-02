<?php
	
	require '../checkSessionInformation.php';
    checkSessionInformation();
	session_start();
	
	$groupId = $_SESSION['groupId'];
	
	require '../databaseConnection.php';
	$conn = getDBConnection();
	if($conn->connection_error)
		die("Connection failed: " . $conn->connect_error);
	
	
	$sql = "SELECT * FROM MessageBoard WHERE groupId=" .$groupId. " ORDER BY postDate DESC;";
	$result = mysql_query($sql, $conn);
	
	if($result == NULL) {
		echo "none";
	}
	
	$allPosts = array();
	
	while($row = mysql_fetch_array($result)) {
		$allPosts[$row['messageId']] = array();
		$allPosts[$row['messageId']]['date'] = $row['postDate'];
		$allPosts[$row['messageId']]['message'] = $row['message'];

		$userID = $row['userId'];
		$sql2 = "SELECT name FROM Users WHERE userId = '" .$userID. "';";
		$result2 = mysql_query($sql2, $conn);
		while($row2 = mysql_fetch_array($result2)) {
			$allPosts[$row['messageId']]['user'] = $row2['name'];
		}
	}
	
	echo json_encode($allPosts);
?>