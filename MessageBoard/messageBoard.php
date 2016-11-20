<html>
<head>

<?php
	include '../databaseConnection.php';
	
	$conn = getDBConnection();
	
	$messageID;
	
	function getPost($conn) {
		
		// use groupId from session variables
		$sql = "SELECT * FROM MessageBoard WHERE groupId = 1;";
		$result = mysql_query($sql, $conn);
		if($result == NULL) {
			echo "There are no posts yet. Maybe you should make one.";
			return;
		}
		
		while($row = mysql_fetch_array($result)) {
			$date = row[2];
			$messageID = row[3];
			$message = row[4];
			$userID = row[1];
			$sql2 = "SELECT name FROM Users WHERE userId = " .$userID. ";";
			$result2 = mysql_query($sql2, $conn);
			while($row = mysql_fetch_array($result2)) {
				$user = row[0];
			}
			showPost($user, $date, $message);
		}
		
	}
	
	function showPost($user, $date, $message) {
		// display the message on the board
		echo "<div><h3>".$user." Date: ".$date."</h3></div>";
		echo "<div><p>".$message."</p></h3>";
	}
	
	function makePost($user, $date, $message, $conn) {
		
		// get groupId and userId from session variables
		
		$sql = "INSERT INTO MessageBoard VALUES (groupId, userId, " .$date. ", " .$messageID. ", " .$message. ");";
		mysql_query($sql, $conn);
		showPost($user, $date, $message);
		
	}
	
?>
</head>
<body>

</body>
</html>