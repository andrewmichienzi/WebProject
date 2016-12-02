<?php
	
	//use databaseConnection.php;
	$meetingId = 0;
	$groupId = 0;
	$groupName = "";
	$date = "";
	$time = "";
	$description = "";		
		
	if ($_SERVER["REQUEST_METHOD"] == "POST")
	{	
		$GLOBALS["groupName"] = $_POST["txtGroupName"];
		$GLOBALS["groupId"] = $_POST["txtGroupId"];
		$GLOBALS["meetingId"] = $_POST["txtMeetingId"];
		$GLOBALS["date"] = $_POST["txtMeetingDate"];
		$GLOBALS["time"] = $_POST["txtMtgTimeStart"] . "-" . $_POST["txtMtgTimeEnd"];
		$GLOBALS["description"] = $_POST["txtDescription"];
		createMeeting();
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

	function createMeeting()
	{	
		$dbConn = getDBConnection();
		$sqlStatement = "";
		if (!($sqlStatement = $dbConn->prepare("INSERT INTO michiena.GroupMeeting (meetingId, groupId, groupName, meetingDate, meetingTime, meetingDescription) VALUES (?, ?, ?, ?, ?, ?)"))) 
		{
			die( "Error preparing: (" .$dbConn->errno . ") " . $dbConn->error);			
		}	
		if (!($sqlStatement->bind_param('iissss', $GLOBALS["meetingId"], $GLOBALS["groupId"], $GLOBALS["groupName"], $GLOBALS["date"], $GLOBALS["time"], $GLOBALS["description"])))
		{
			die( "Error in bind_param: (" .$dbConn->errno . ") " . $dbConn->error);
		}		
	
		$sqlStatement->execute();
		$sqlStatement->close();
		$dbConn->close();
	}

?>
