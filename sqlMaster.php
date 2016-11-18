<?php
	$servername = "localhost";
	$username = "michiena";
	$password = "michiena6390";
	$dbname = "michiena";

	$conn = mysql_connect($servername, $username, $password);
	if($conn->connection_error)
		die("Connection failed: " . $conn->connect_error);

	mysql_select_db($dbname);
	
	runSqlScripts($conn);
	printTableNames($conn);

	function runSqlScripts($conn)
	{
		createUsersTable($conn);
		createGroupsTable($conn);
		//createTasksTable($conn);
		//createUserProjectsTable($conn);
		//createMessageBoardTable($conn);
	}	

	function createUsersTable($conn){
		$sql = "DROP TABLE Users;";
		mysql_query($sql, $conn);
		$sql = "CREATE TABLE Users (userId INT NOT NULL, name varchar(25) NOT NULL, username varchar(25) NOT NULL, email varchar(50), phone varchar(10), PRIMARY KEY(userId));";
		$retval = mysql_query($sql, $conn);
		if(! $retval){
			die('Creating Users Table issue' . mysql_error());
		}
	}
	
	function createGroupsTable($conn){
		$sql = "DROP TABLE Groups;";
		mysql_query($sql, $conn);
		$sql = "CREATE TABLE Groups (projectId INT NOT NULL, name varchar(25) NOT NULL, course varchar(25), description varchar(100), createDate DATE NOT NULL, dueDate DATE, PRIMARY KEY (projectId));";
		$retval = mysql_query($sql, $conn);
		if(! $retval){
			die('Creating Groups Table issue' . mysql_error());
		}
	}

	function createTasksTable($conn){
		$sql = "DROP TABLE Tasks;";
		mysql_query($sql, $conn);
		$sql = "CREATE TABLE Tasks (taskId INT NOT NULL, groupId INT NOT NULL, name varchar(25) NOT NULL, userId INT, description varchar(75), PRIMARY KEY(taskId, groupId));";
		$retval = mysql_query($sql, $conn);
		if(! $retval){
			die('Creating Tasks Table issue' . mysql_error());
		}
	}
	
	function createUserGroupsTable($conn){
		$sql = "DROP TABLE UserGroups;";
		mysql_query($sql, $conn);
		$sql = "CREATE TABLE UserGroups (userId INT NOT NULL, projectId INT NOT NULL, PRIMARY KEY(userId, projectId));";
		$retval = mysql_query($sql, $conn);
		if(! $retval){
			die('Creating User Groups Table issue' . mysql_error());
		}
	}
	
	function createMessageBoardTable($conn){
		$sql = "DROP TABLE MessageBoard;";
		mysql_query($sql, $conn);
		$sql = "CREATE TABLE MessageBoard (groupId INT NOT NULL, userId INT NOT NULL, postDate DATE NOT NULL, messageID INT NOT NULL, message varchar(500), PRIMARY KEY(messageID));";
		$retval = mysql_query($sql, $conn);
		if(! $retval){
			die('Creating Message Board Table issue' . mysql_error());
		}
	}
	
	function createUserScheduleTable($conn){
		$sql = "DROP TABLE UserSchedule;";
		mysql_query($sql, $conn);
		$sql = "CREATE TABLE UserSchedule (userId INT NOT NULL, availability VARCHAR(500), PRIMARY KEY(userId))";
		$retval = mysql_query($sql, $conn);
		if(! $retval){
			die('Creating Message Board Table issue' . mysql_error());
		}
	}

	function printTableNames($conn){
		$sql = "Select table_name from information_schema.tables;";
		$retVal = mysql_query($sql, $conn);
		while($row = mysql_fetch_array($retVal)){
			echo $row['table_name'];
			echo '<br>';
		}
	}
?>
