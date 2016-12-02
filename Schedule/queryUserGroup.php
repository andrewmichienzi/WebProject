<?php
	$groupId = $_POST["groupId"];
	
	$dbConn = getDBConnection();
	
	$userIdArray = array();
	$availabiliesArray = array();
	$availableDays = array("Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday");
	$updatedAvailableDays = array("Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday");
	$groupsAvailability = array();
	$updatedGroupsAvailability = array();
	
	//query for all the users in this user's group
	if ($sqlQuery = $dbConn->prepare("SELECT * FROM michiena.UserGroups WHERE groupId = ?"))
	{
		$sqlQuery->bind_param("i", $GLOBALS["groupId"]);
		$sqlQuery->execute();
		$result = $sqlQuery->get_result();	
		$sqlQuery->close();
		
		while ($rowAsArray = $result->fetch_assoc())
		{
			$userIdArray[] = $rowAsArray['userId']; 		
		}
	}
	
	//query for the userSchedules for all users in this group
	foreach($userIdArray as $userId)
	{
		if ($sqlQuery = $dbConn->prepare("SELECT * FROM michiena.UserSchedule WHERE userId = ?"))
		{
			$sqlQuery->bind_param("i", $userId);
			$sqlQuery->execute();
			$result = $sqlQuery->get_result();	
			$sqlQuery->close();
		
			while ($rowAsArray = $result->fetch_assoc())
			{
				$availabilitiesArray[] = $rowAsArray['availability']; 	
			}
		}
	}

	echo implode("<br>", $availabilitiesArray);
		
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
