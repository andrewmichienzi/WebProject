<?php
	
	$userId = 0;
	$sundayStart = "";
	$sundayEnd = "";
	$mondayStart = "";
	$mondayEnd = "";
	$tuesdayStart = "";
	$tuesdayEnd = "";
	$wednesdayStart = "";
	$wednesdayEnd = "";
	$thursdayStart = "";
	$thursdayEnd = "";
	$fridayStart = "";
	$fridayEnd = "";
	$saturdayStart = "";
	$saturdayEnd  = "";
	$availability = "";
	
	if ($_SERVER["REQUEST_METHOD"] == "POST")
	{	
		$GLOBALS["userId"] = $_POST["txtUserId"];

		if (strcmp($_POST["txtSundayFrom"], "") != 0 && strcmp($_POST["txtSundayTo"], "") != 0)
		{
			$GLOBALS["sundayStart"] = $_POST["txtSundayFrom"];
			$GLOBALS["sundayEnd"] = $_POST["txtSundayTo"];
			$availability .= "Sunday- " . $GLOBALS["sundayStart"] . "-" . $GLOBALS["sundayEnd"] .  "; ";
		}
		
		if (strcmp($_POST["txtMondayFrom"], "") != 0 && strcmp($_POST["txtMondayTo"], "") != 0)
		{
			$GLOBALS["mondayStart"] = $_POST["txtMondayFrom"];
			$GLOBALS["mondayEnd"] = $_POST["txtMondayTo"];
			$availability .= "Monday- " . $GLOBALS["mondayStart"] . "-" . $GLOBALS["mondayEnd"] . "; ";
		}
		
		if (strcmp($_POST["txtTuesdayFrom"], "") != 0 && strcmp($_POST["txtTuesdayTo"], "") != 0)
		{
			$GLOBALS["tuesdayStart"] = $_POST["txtTuesdayFrom"];
			$GLOBALS["tuesdayEnd"] = $_POST["txtTuesdayTo"];
			$availability .= "Tuesday- " . $GLOBALS["tuesdayStart"] . "-" . $GLOBALS["tuesdayEnd"] . "; ";
		}
		
		if (strcmp($_POST["txtWednesdayFrom"], "") != 0 && strcmp($_POST["txtWednesdayTo"], "") != 0)
		{
			$GLOBALS["wednesdayStart"] = $_POST["txtWednesdayFrom"];
			$GLOBALS["wednesdayEnd"] = $_POST["txtWednesdayTo"];
			$availability .= "Wednesday- " . $GLOBALS["wednesdayStart"] . "-" . $GLOBALS["wednesdayEnd"] . "; ";
		}
		
		if (strcmp($_POST["txtThursdayFrom"], "") != 0 && strcmp($_POST["txtThursdayTo"], "") != 0)
		{
			$GLOBALS["thursdayStart"] = $_POST["txtThursdayFrom"];
			$GLOBALS["thursdayEnd"] = $_POST["txtThursdayTo"];
			$availability .= "Thursday- " . $GLOBALS["thursdayStart"] . "-" . $GLOBALS["thursdayEnd"] . "; ";
		}
		
		if (strcmp($_POST["txtFridayFrom"], "") != 0 && strcmp($_POST["txtFridayTo"], "") != 0)
		{
			$GLOBALS["fridayStart"] = $_POST["txtFridayFrom"];
			$GLOBALS["fridayEnd"] = $_POST["txtFridayTo"];
			$availability .= "Friday- " . $GLOBALS["fridayStart"] . "-" . $GLOBALS["fridayEnd"] . "; ";
		}
		
		if (strcmp($_POST["txtSaturdayFrom"], "") != 0 && strcmp($_POST["txtSaturdayTo"], "") != 0)
		{
			$GLOBALS["saturdayStart"] = $_POST["txtSaturdayFrom"];
			$GLOBALS["saturdayEnd"] = $_POST["txtSaturdayTo"];
			$availability .= "Saturday- " . $GLOBALS["saturdayStart"] . "-" . $GLOBALS["saturdayEnd"] . "; ";
		}
		
		createUserSchedule();
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
	function createUserSchedule()
	{
		$dbConn = getDBConnection();
		$sqlStatement = "";
		echo "test";
		if (!($sqlStatement = $dbConn->prepare("INSERT INTO michiena.UserSchedule (userId, availability) VALUES (?, ?)"))) 
		{
			die( "Error preparing: (" .$dbConn->errno . ") " . $dbConn->error);			
		}		
		echo "test";
		if (!($sqlStatement->bind_param('is', $GLOBALS["userId"], $GLOBALS["availability"])))
		{
			die( "Error in bind_param: (" .$dbConn->errno . ") " . $dbConn->error);
		}		
		echo "test";
		$sqlStatement->execute();
		$sqlStatement->close();
		$dbConn->close();
		echo "test";
	}
?>
