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
		createProjectTable($conn);
		createTaskTable($conn);
		createUserProjectTable($conn);
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
	
	function createProjectTable($conn){
		$sql = "DROP TABLE Project;";
		mysql_query($sql, $conn);
		$sql = "CREATE TABLE Project (projectId INT NOT NULL, name varchar(25) NOT NULl, projectName varchar(25) NOT NULL, course varchar(25), description varchar(100), createDate DATE NOT NULL, dueDate DATE, PRIMARY KEY (projectId));";
		$retval = mysql_query($sql, $conn);
		if(! $retval){
			die('Creating Project Table issue' . mysql_error());
		}
	}

	function createTaskTable($conn){
		$sql = "DROP TABLE Task;";
		mysql_query($sql, $conn);
		$sql = "CREATE TABLE Task (taskId INT NOT NULL, projectId INT NOT NULL, name varchar(25) NOT NULL, userId INT, description varchar(75), PRIMARY KEY(taskId, projectId));";
		$retval = mysql_query($sql, $conn);
		if(! $retval){
			die('Creating Task Table issue' . mysql_error());
		}
	}
	
	function createUserProjectTable($conn){
		$sql = "DROP TABLE UserProject;";
		mysql_query($sql, $conn);
		$sql = "CREATE TABLE UserProject (userId INT NOT NULL, projectId INT NOT NULL, PRIMARY KEY(userId, projectId));";
		$retval = mysql_query($sql, $conn);
		if(! $retval){
			die('Creating User Project Table issue' . mysql_error());
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