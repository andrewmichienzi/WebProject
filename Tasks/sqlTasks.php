<?php
	require '../databaseConnection.php';
	require '../checkSessionInformation.php';
	checkSessionInformation();
	session_start();
//	require '../sqlMaster.php';
	$conn = getDBConnection();
	$functionId = $_POST['functionId'];
	$GLOBALS['userId'] = (int)trim($_SESSION['userId'], "'");
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

	if($functionId == 3){
		deleteTask($conn, $_POST['taskId']);
	}
		
	if($functionId == 4){
		getOrderBy($conn);
	}
		
	if($functionId == 5){
		setTaskChecked($conn, $_POST['taskId'], $_POST['checked']);
	}	

	function getTasks($conn){
		createTaskColumns($conn);
		$columnSql = "Select columnName, name from TaskColumns;";
		$columnRet = mysql_query($columnSql, $conn);
		$sql = "Select ";
		echo '<table id="taskTable">';
		echo "<tr>";
		$numOfRows = 0;
		while($row = mysql_fetch_array($columnRet))
		{
			$sql.= $row['columnName'] . ", ";
			echo "<th>".$row['name'] . "</th>";
			$numOfRows++;
		}
		echo "<th>Completed</th>";	
		echo "<th>Delete Task</th>";
		echo "</tr>";
		//$sql = substr($sql, 0, -2);
		$sql .= "t.completed, t.taskId from Tasks as t left join Groups as g on g.groupId = t.groupId where t.userId = ".$GLOBALS['userId'];
		$orderBy = $_POST['orderBy'];
		if($orderBy != "")
		{
			$sql .= " ORDER BY " . $orderBy;
		}
		$sql .= ";";
		$retVal = mysql_query($sql, $conn);
	
		while($row = mysql_fetch_array($retVal)){
			$taskId = $row[$numOfRows+1];
			$completed = $row[$numOfRows];
			echo '<tr id="task'.$taskId.'">';
			$index = 0;
			while($index < $numOfRows)
			{ 
				echo "<td>". $row[$index] . "</td>";
				$index++;
			}
			echo '<td><input type="checkbox"';
			if($completed)
			{
				echo ' checked';
			}
			echo' id="checkBox'.$taskId.'" onclick="checkBoxTask('.$taskId.');"/></td>';
			echo '<td><input type="button" class="deleteButton" value="Delete" onclick="deleteTask('.$taskId.');"/></td>';
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
				3 description
		*/
		$sql = "INSERT INTO Tasks ( groupId, name, userId, description, completed) VALUES ('" . $args[0] . "', '" . $args[1] . "', '" . $args[2] . "', '" . $args[3] . "', FALSE);";	
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

	function deleteTask($conn, $taskId)
	{
		$sql = "DELETE FROM Tasks where taskId = ".$taskId.";";
		$retVal = mysql_query($sql, $conn);
		if (! $retVal){
			die('Issue removing Task from Task Table: ' . mysql_error());
		}
	}
		
	function setTaskChecked($conn, $taskId, $checked)
	{
		$sql = "UPDATE Tasks SET completed=".$checked." where taskId = ".$taskId.";";
		$retVal = mysql_query($sql, $conn);
		if (! $retVal){
			die('Issue removing Task from Task Table: ' . mysql_error());
		}
	}
?>
