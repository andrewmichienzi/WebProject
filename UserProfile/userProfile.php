<?php 
	include '../databaseConnection.php';
	// set userId from session varibles
	$conn = getDBConnection();
	$sql = "SELECT * FROM Users WHERE userId = " .$userId. ";";
	$result = mysql_query($sql, $conn);
	if($result == NULL) {
		echo "User not found.";
		return;
	}
	
	while($row = mysql_fetch_array($result)) {
		$user = row[1];
		$username = row[2];
		$email = row[3];
		$phone = row[4];
	}
	
	// print out user info
	
	$sql2 = "SELECT * FROM UserGroups WHERE userId = " .$userId. ";";
	$result2 = mysql_query($sql2, $conn);
	while($newrow = mysql_fetch_array($result2)) {
		// print out groups
	}
	
?>