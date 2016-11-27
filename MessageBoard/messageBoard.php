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
	
	$type = $_POST['type'];
	$date = $_POST['date'];
	$message = $_POST['message'];
	
	if(type == "makePost") {
		makePost($user, $date, $message, $conn);
	} else if (type == "displayPost") {
		getPost($conn);
	}
	
	function getPost($conn) {
		
		$messageID;
		
		$sql = "SELECT * FROM MessageBoard WHERE groupId='" .$groupId. "';";
		$result = mysql_query($sql, $conn);
		if($result == NULL) {
			return;
		}
		
		while($row = mysql_fetch_array($result)) {
			$date = row[2];
			$messageID = row[3];
			$message = row[4];
			$userID = row[1];
			$sql2 = "SELECT name FROM Users WHERE userId = '" .$userID. "';";
			$result2 = mysql_query($sql2, $conn);
			while($row = mysql_fetch_array($result2)) {
				$user = row[0];
				showPost($user, $date, $message);
			}
		}
		
	}
	
	function showPost($user, $date, $message) {
		
		$postData = array();
		$postData['user'] = $user;
		$postData['date'] = $date;
		$postData['message'] = $message;
		echo $postData;
		
	}
	
	function makePost($user, $date, $message, $conn) {
		
		// get groupId and userId from session variables
		// auto increment messageID
		$sql = "INSERT INTO MessageBoard (groupId, userId, postDate, message) VALUES ('".$groupId."', '".$userId."', '".$date."', '".$message."');";
		mysql_query($sql, $conn);
		showPost($user, $date, $message);
		
	}
	
?>