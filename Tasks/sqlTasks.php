<?php
	require '../databaseConnection.php';
//	require '../sqlMaster.php';
	$conn = getDBConnection();
	$functionId = $_POST['functionId'];
	if ($functionId == 0)
	{
		getTasks($conn);
	}
	if ($functionId == 1)
	{
		getGroups($conn);
	}

	if ($functionId == 2){
		//Adding task
		$taskName = $_POST['taskName'];
		$taskDescription = $_POST['taskDescription'];
		$groupId = $_POST['groupId'];
		$userId = 0;
		$args = array($groupId, $taskName, $userId, $taskDescription);
		addTask($conn, $args);
	}	

	function getTasks($conn){
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

	function getGroups($conn){
		$userId = 0;
		$sql = "Select * from UserGroups WHERE userId = ". $userId .";";
		$retVal = mysql_query($sql, $conn);
		echo '<select name = "groups" id="groupId">';
		while($row = mysql_fetch_array($retVal)){
			echo '<option value="'.$row['groupId'] . '">' . $row['groupId'] . '</option>';
		}
		echo'</select>';
	}
	function addTask($conn, $args){
		/*
			Args
				0 groupId
				1 name
				2 userId
				3 descripttion*/
		$sql = "INSERT INTO Tasks ( groupId, name, userId, description) VALUES ('" . $args[0] . "', '" . $args[1] . "', '" . $args[2] . "', '" . $args[3] . "');";	
		$retVal = mysql_query($sql, $conn);
		if (! $retVal){
			die('Adding Task Issue:  ' . mysql_error());
		}
	}
?>
