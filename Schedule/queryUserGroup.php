<?php
	$groupId = $_POST["groupId"];
	
	$dbConn = getDBConnection();
	
	$userIdArray = array();
	$availabiliesArray = array();
	$availableDays = array("Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday" "Saturday");
	$updatedAvailableDays = array("Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday" "Saturday");
	$groupAvailability = array();
	
	if ($sqlQuery = $dbConn->prepare("SELECT * FROM michiena.UserGroup WHERE groupId = ?"))
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
	
	foreach($availableDays as $day)
	{
		foreach($availabilitiesArray as $availability)
		{
			$found = strpos($availability, $day)			
			if($found === false)
			{
				unset($updatedAvailableDays[$day]);			
			}
		}
	}

	foreach($availabilitiesArray as $availability)
	{
		$thisAvailabilitysDays = $availability.split(";");
		
		if (in_array(, $thisAvailabilitysDays))
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
