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
		createUserTable($conn);
		createGroupTable($conn);
		createTaskTable($conn);
		createUserGroupTable($conn);
		createMessageBoardTable($conn);
	}	

	function createUserTable($conn){
		$sql = "DROP TABLE User;";
		mysql_query($sql, $conn);
		$sql = "CREATE TABLE User (userId INT NOT NULL, name varchar(25) NOT NULl, username varchar(25) NOT NULL, email varchar(50), phone varchar(10), PRIMARY KEY(userId));";
		$retval = mysql_query($sql, $conn);
		if(! $retval){
			die('Creating User Table issue' . mysql_error());
		}
	}
	
	function createGroupTable($conn){
		$sql = "DROP TABLE Group;";
		mysql_query($sql, $conn);
		$sql = "CREATE TABLE Group (groupId INT NOT NULL, name varchar(25) NOT NULL, groupName varchar(25) NOT NULL, course varchar(25), description varchar(100), createDate DATE NOT NULL, dueDate DATE, PRIMARY KEY (groupId));";
		$retval = mysql_query($sql, $conn);
		if(! $retval){
			die('Creating Group Table issue' . mysql_error());
		}
	}

	function createTaskTable($conn){
		$sql = "DROP TABLE Task;";
		mysql_query($sql, $conn);
		$sql = "CREATE TABLE Task (taskId INT NOT NULL, groupId INT NOT NULL, name varchar(25) NOT NULL, userId INT, description varchar(75), PRIMARY KEY(taskId, groupId));";
		$retval = mysql_query($sql, $conn);
		if(! $retval){
			die('Creating Task Table issue' . mysql_error());
		}
	}
	
	function createUserGroupTable($conn){
		$sql = "DROP TABLE UserGroup;";
		mysql_query($sql, $conn);
		$sql = "CREATE TABLE UserGroup (userId INT NOT NULL, groupId INT NOT NULL, PRIMARY KEY(userId, groupId));";
		$retval = mysql_query($sql, $conn);
		if(! $retval){
			die('Creating User Group Table issue' . mysql_error());
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
