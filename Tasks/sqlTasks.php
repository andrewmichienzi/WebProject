<?php
	require '../databaseConnection.php';
//	require '../sqlMaster.php';
	$conn = getDBConnection();
	$functionId = $_POST['functionId'];
	$GLOBALS['userId'] = 1;
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
		$args = array($groupId, $taskName, $GLOBALS['userId'], $taskDescription);
		addTask($conn, $args);
	}
		
	if($functionId == 4){
		getOrderBy($conn);
	}	

	function getTasks($conn){
//		$sql = "Select * from Tasks;";
		createTaskColumns($conn);
		$columnSql = "Select columnName from TaskColumns;";
		$columnRet = mysql_query($columnSql, $conn);
		$sql = "Select ";
		while($row = mysql_fetch_array($columnRet))
		{
			$sql.= $row['columnName'] . ", ";
		}	
		$sql = substr($sql, 0, -2);
		$sql .= " from Tasks as t left join Groups as g on g.groupId = t.groupId where t.userId = ".$GLOBALS['userId'];
		$orderBy = $_POST['orderBy'];
		if($orderBy != "")
		{
			$sql .= " ORDER BY " . $orderBy;
		}
		$sql .= ";";
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
	
	function getOrderBy($conn)
	{
		$sql = "SELECT columnName, name FROM TaskColumns;";
		$retVal = mysql_query($sql, $conn);	
		echo '<select name="orderBy" id="orderByDropDown" onchange="createTask();">';
		echo '<option value=""> </option>';
		while($row = mysql_fetch_array($retVal)){
			echo '<option value="' . $row[0] . '">' . $row[1] . '</option>';
		}
		echo'</select>';
	}

	function getGroups($conn){
		$sql = "Select u.groupId, g.name from UserGroups as u left join Groups as g on u.groupId = g.groupId WHERE u.userId = ". $GLOBALS['userId'] .";";
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
	
	function createTaskColumns($conn)
	{
		$sql = "DROP TABLE TaskColumns;";
		mysql_query($sql, $conn);
		$sql = "CREATE TABLE TaskColumns (columnName varchar(50) NOT NULL, name varchar(50) NOT NULL, PRIMARY KEY(columnName, name));";
		$retval = mysql_query($sql, $conn);
		if(! $retval){
			die('Creating TaskColumns Table issue:  ' . mysql_error());
		}
		$columnArgs = array("g.name", "Group Name");
		addToTaskColumn($conn, $columnArgs);
		$columnArgs = array("g.course", "Course");
		addToTaskColumn($conn, $columnArgs);
		$columnArgs = array("t.name", "Task");
		addToTaskColumn($conn, $columnArgs);
		$columnArgs = array("t.description", "Description");
		addToTaskColumn($conn, $columnArgs);
	}

	function addToTaskColumn($conn, $args)
	{
		$sql = "INSERT INTO TaskColumns (columnName, name) VALUES ('" . $args[0] . "', '" . $args[1] . "');";	
		$retVal = mysql_query($sql, $conn);
		if (! $retVal){
			die('Adding to UserGroups Table issue:  ' . mysql_error());
		}
	}
?>
