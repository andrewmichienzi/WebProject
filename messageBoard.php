<?php
	include 'databaseConnection.php';
	
	$conn = getDBConnection();
	
	function getPost($conn) {
		$sql = "SELECT * FROM MessageBoard WHERE groupID = 1;";
		$result = mysql_query($sql, $conn);
		if($result == NULL) {
			echo "There are no posts yet. Maybe you should make one.";
			return;
		}
		
	}
	
?>