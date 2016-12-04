<?php
		
	$groupId = $_POST["groupId"];
	
	$dbConn = getDBConnection();
	
	
	if ($sqlQuery = $dbConn->prepare("SELECT * FROM michiena.GroupMeeting WHERE groupId = ?"))
	{
		$sqlQuery->bind_param("i", $GLOBALS["groupId"]);
		$sqlQuery->execute();
		$result = $sqlQuery->get_result();	
		$sqlQuery->close();
		
		while ($rowAsArray = $result->fetch_assoc())
		{
			echo "<div class='panel panel-default'>" . 
      			 "<div class='panel-heading'>" . $rowAsArray['meetingDate'] . " at " . $rowAsArray['meetingTime'] . "</div>" . 
      			 "<div class='panel-body'>" . $rowAsArray['meetingDescription'] .  "</div>" . 
				 "</div>";
		}
	}
	
	function getDBConnection() {
		
		$servername = "localhost";
		$username = "michiena";
		$password = "michiena6390";
		$dbname = "michiena";
		$conn = new mysqli($servername, $username, $password, $dbName);
		if($conn->connection_error)
			die("Connection failed: " . $conn->connect_error);
		
		return $conn;
	}
	
?>
