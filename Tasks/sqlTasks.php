<?php
	require '../databaseConnection.php';
	$conn = getDBConnection();
	$functionId = $_POST['functionId'];
	if ($functionId == 0)
	{
		printTasks($conn);
	}
	
	function printTasks($conn){
		$sql = "Select * from Tasks;";
		$retVal = mysql_query($sql, $conn);
		while($row = mysql_fetch_array($retVal)){
			echo json_encode($row);
		}
	}
?>
