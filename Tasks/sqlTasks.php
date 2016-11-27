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
//		$sql = "Select * from Tasks;";
		$userId = 0;
		$sql = "Select g.name, g.course, t.name, t.description from Tasks as t left join Groups as g on g.groupId = t.groupId where userId =".$userId.";";
		$retVal = mysql_query($sql, $conn);
//		echo json_encode(mysql_fetch_array($retVal));
		echo "<table id=taskTable>
		<tr>
		<th>Group</th>
		<th>Course</th>
		<th>Task Name</th>
		<th>Task Description</th>
		</tr>";
			
		while($row = mysql_fetch_array($retVal)){
			echo "<tr>";
			echo "<td>". $row[0] . "</td>";
			echo "<td>". $row[1] . "</td>";
			echo "<td>". $row[2] . "</td>";
			echo "<td>". $row[3] . "</td>";
			echo "</tr>";
		}	
		echo "</table>";
	}

	function getGroups($conn){
		$userId = 0;
		$sql = "Select u.groupId, g.name from UserGroups as u left join Groups as g on u.groupId = g.groupId WHERE u.userId = ". $userId .";";
		$retVal = mysql_query($sql, $conn);
		echo '<select name = "groups" id="groupId">';
		while($row = mysql_fetch_array($retVal)){
			echo '<option value="'.$row[0] . '">' . $row[1] . '</option>';
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
