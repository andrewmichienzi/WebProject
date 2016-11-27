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
	addSampleData($conn);
	echo "<br>SUCCESS";

	function runSqlScripts($conn)
	{
		createUsersTable($conn);
		createGroupsTable($conn);
		createTasksTable($conn);
		createUserGroupsTable($conn);
		createMessageBoardTable($conn);
	}	

	function addSampleData($conn)
	{
		$testUser0 = array("Andrew Michienzi", "michiena", "michiena@mail.gvsu.edu", "6163894812");
		addUser($conn, $testUser0);
		$testUser1 = array("Katie Mulder", "muldkate", "muldkate@mail.gvsu.edu", "(123)-456-7890");
		addUser($conn, $testUser1);
		$testUser2 = array("Matt Escalante", "escalanm", "escalanm@mail.gvsu.edu", "1 (234)-567-8901");
		addUser($conn, $testUser2);
		$testUser3 = array("Molly Alger", "algermo", "algermo@mail.gvsu.edu", "345.678.9012");
		addUser($conn, $testUser3);

		$testGroup0 = array("Cool Homies", "AWESOME101", "A group where only awesome people are invited", "20161120", "NULL", "1");
		addGroup($conn, $testGroup0);
		$testGroup1 = array("Lame Lamies", "LAME98", "must be hella lame", "20150309", "20161203", "1");
		addGroup($conn, $testGroup1);
		$testGroup2 = array("Group A", "GRA", "Group A group description", "20150309", "20161203", "2");
		addGroup($conn, $testGroup2);
		$testGroup3 = array("Group B", "GRB", "Group B group description", "20150309", "20161203", "2");
		addGroup($conn, $testGroup3);
		$testGroup4 = array("Group C", "GRC", "Group C group description", "20150309", "20161203", "2");
		addGroup($conn, $testGroup4);
		$testGroup5 = array("Group D", "GRD", "Group D group description", "20150309", "20161203", "2");
		addGroup($conn, $testGroup5);
		$testGroup6 = array("Group E", "GRE", "Group E group description", "20150309", "20161203", "1");
		addGroup($conn, $testGroup6);
		
		$addToGroup1 = array("1", "1");
		addUserToGroup($conn, $testGroup1);
		$addToGroup2 = array("2", "1");
		addUserToGroup($conn, $addToGroup2);
		$addToGroup3 = array("3", "1");
		addUserToGroup($conn, $addToGroup3);
		$addToGroup4 = array("4", "1");

		$testTask1 = array("1", "Task1", "0", "Test Description");
		addTask($conn, $testTask1);
    	
		printTables($conn);
	}

	function createUsersTable($conn){
		$sql = "DROP TABLE Users;";
		$retval = mysql_query($sql, $conn);
		$sql = "CREATE TABLE Users (userId INT NOT NULL AUTO_INCREMENT, name varchar(100) NOT NULL, username varchar(100) NOT NULL UNIQUE, email varchar(320), phone varchar(50), PRIMARY KEY(userId));";
		$retval = mysql_query($sql, $conn);
		if(! $retval){
			die('Creating Users Table issue:  ' . mysql_error());
		}
	}
	
	function createGroupsTable($conn){
		$sql = "DROP TABLE Groups;";
		mysql_query($sql, $conn);
		$sql = "CREATE TABLE Groups (groupId INT NOT NULL AUTO_INCREMENT, name varchar(25) NOT NULL UNIQUE, course varchar(25), description varchar(100), createDate DATE NOT NULL, dueDate DATE, PRIMARY KEY (groupId));";
		$retval = mysql_query($sql, $conn);
		if(! $retval){
			die('Creating Groups Table issue:  ' . mysql_error());
		}
	}

	function createTasksTable($conn){
		$sql = "DROP TABLE Tasks;";
		mysql_query($sql, $conn);
		$sql = "CREATE TABLE Tasks (taskId INT NOT NULL AUTO_INCREMENT, groupId INT NOT NULL, name varchar(25) NOT NULL, userId INT, description varchar(75), PRIMARY KEY(taskId, groupId));";
		$retval = mysql_query($sql, $conn);
		if(! $retval){
			die('Creating Tasks Table issue:  ' . mysql_error());
		}
	}
	
	function createUserGroupsTable($conn){
		$sql = "DROP TABLE UserGroups;";
		$retVal = mysql_query($sql, $conn);
		if(!retval) {
			die("Failure to drop table");
		}
		$sql = "CREATE TABLE UserGroups (userId INT NOT NULL, groupId INT NOT NULL, PRIMARY KEY(userId, groupId));";
		$retval = mysql_query($sql, $conn);
		if(! $retval){
			die('Creating User Groups Table issue:  ' . mysql_error());
		}
	}
	
	function createMessageBoardTable($conn){
		$sql = "DROP TABLE MessageBoard;";
		mysql_query($sql, $conn);
		$sql = "CREATE TABLE MessageBoard (groupId INT NOT NULL, userId INT NOT NULL, postDate DATE NOT NULL, messageID INT NOT NULL AUTO_INCREMENT, message varchar(500), PRIMARY KEY(messageID));";
		$retval = mysql_query($sql, $conn);
		if(! $retval){
			die('Creating Message Board Table issue:  ' . mysql_error());
		}
	}
	
	function createUserScheduleTable($conn){
		$sql = "DROP TABLE UserSchedule;";
		mysql_query($sql, $conn);
		$sql = "CREATE TABLE UserSchedule (userId INT NOT NULL, availability VARCHAR(500), PRIMARY KEY(userId))";
		$retval = mysql_query($sql, $conn);
		if(! $retval){
			die('Creating Message Board Table issue:  ' . mysql_error());
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
	
	function addUser($conn, $args){
		/*
			Args
				0 name
				1 username
				2 email
				3 phone
		*/
		$sql = "INSERT INTO Users (name, username, email, phone) VALUES ('".$args[0] . "', '" . $args[1] . "', '" . $args[2] . "', '" . $args[3] . "');";	
		$retval = mysql_query($sql, $conn);
		if(! $retval){
			die('Addng User issue:  ' . mysql_error());
		}
	}
	
	function addTask($conn, $args){
		/*
			Args
				0 groupId
				1 name
				2 userId
				3 descripttion
		*/
		$sql = "INSERT INTO Tasks ( groupId, name, userId, description) VALUES ('" . $args[0] . "', '" . $args[1] . "', '" . $args[2] . "', '" . $args[3] . "');";	
		$retVal = mysql_query($sql, $conn);
		if (! $retVal){
			die('Adding Task Issue:  ' . mysql_error());
		}
	}

	function addGroup($conn, $args)
	{
		/*
			Args
				0 name
				1 course
				2 description
				3 createDate
				4 dueDate
				5 userId who created Date
		*/
		$sql = "INSERT INTO Groups (name, course, description, createDate, dueDate) VALUES ('" . $args[0] . "', '" . $args[1] . "', '" . $args[2] . "', '" . $args[3] . "', '" . $args[4] . "');";	
		$retVal = mysql_query($sql, $conn);
		if (! $retVal){
			die('Adding Group to Groups Table issue:  ' . mysql_error());
		}
		$sql = "SELECT groupId FROM Groups WHERE name = '".$args[0]."';";
		$retVal = mysql_query($sql, $conn);
		$result = mysql_fetch_array($retVal);
		$newArgs = array($args[5], $result['groupId']);
		addUserToGroup($conn, $newArgs);
	}
	
	function addUserToGroup($conn, $args)
	{	
		/*
			Adding user and group to group table
			
			Args
				0 userId
				1 groupId
		*/
		$sql = "INSERT INTO UserGroups (userId, groupId) VALUES ('" . $args[0] . "', '" . $args[1] . "');";	
		$retVal = mysql_query($sql, $conn);
		if (! $retVal){
			die('Adding to UserGroups Table issue:  ' . mysql_error());
		}
	}
	
	function printTables($conn){
		$sql = "Select * from Users;";
		$retVal = mysql_query($sql, $conn);
		echo 'Current Users:<br>';
		while($row = mysql_fetch_array($retVal)){
			echo "UserId: ".$row['userId']." Username: ".$row['username']."<br>";
		}
		
		$sql = "Select * from UserGroups;";
		$retVal = mysql_query($sql, $conn);
		echo '<br>Current UserGroups:<br>';
		while($row = mysql_fetch_array($retVal)){
			echo "UserId: ".$row['userId']." GroupId: ".$row['groupId'].'<br>';
		}
	
		$sql = "Select * from Groups;";
		$retVal = mysql_query($sql, $conn);
		echo '<br>Current Groups:<br>';
		while($row = mysql_fetch_array($retVal)){
			echo "GroupId: ".$row['groupId']." GroupName: ".$row['name'];
			echo '<br>';
		}
	}
?>

