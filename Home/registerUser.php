<?php
	require '../databaseConnection.php';
	$conn = getDBConnection();
	if ($_SERVER['REQUEST_METHOD'] == 'GET') {
		$sql = "SELECT COUNT(*) AS count FROM Users WHERE username = '".$_GET['username']."';";
		$result = mysql_query($sql, $conn);
		if(!$result) {
			echo 'ERROR';
		} else {
			$row = mysql_fetch_array($result);
			if($row['count'] == 0) {
				echo 'NO_USER';
			} else {
				echo 'USER_EXISTS';
			}
		} 	
	} else if ($_SERVER['REQUEST_METHOD'] == 'POST') {
		$sql = "INSERT INTO Users (name, username) VALUES ('".$_POST['name'] . "', '" . $_POST['username'] . "');";	
		$retval = mysql_query($sql, $conn);
		if(! $retval){
			echo 'ERROR';
		} else {
			echo 'SUCCESS';
		}
	}

?>
