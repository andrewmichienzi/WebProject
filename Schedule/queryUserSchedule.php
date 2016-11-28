<?php
	$userId = $_POST["userId"];
	
	$dbConn = getDBConnection();
	
	if ($sqlQuery = $dbConn->prepare("SELECT * FROM michiena.UserSchedule WHERE userId = ?"))
	{
		$sqlQuery->bind_param("i", $GLOBALS["userId"]);
		$sqlQuery->execute();
		$result = $sqlQuery->get_result();	
		$sqlQuery->close();
		while ($rowAsArray = $result->fetch_assoc())
		{
			$availability = $rowAsArray['availability'];
			echo $availability; 		
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
