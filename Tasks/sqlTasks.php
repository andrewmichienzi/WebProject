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
//		echo json_encode(mysql_fetch_array($retVal));
		echo "<table id=taskTable>
		<tr>
		<th>groupId</th>
		<th>name</th>
		<th>userId</th>
		<th>description</th>
		</tr>";
			
		while($row = mysql_fetch_array($retVal)){
			echo "<tr>";
			echo "<td>". $row['groupId'] . "</td>";
			echo "<td>". $row['name'] . "</td>";
			echo "<td>". $row['userId'] . "</td>";
			echo "<td>". $row['description'] . "</td>";
			echo "</tr>";
		}	
		echo "</table>";
	}
?>
