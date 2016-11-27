<?php 



		/*
			Args
				0 name
				1 course
				2 description
				3 createDate
				4 dueDate
		*/
		$sql = "INSERT INTO Groups (name, course, description, createDate, dueDate) "
					."VALUES ('".$_POST['groupName']."', '".$args['course']."', '".$args['description']."', '".$args[3]."', CURDATE());";	
		$retVal = mysql_query($sql, $conn);
		if (! $retVal){
			die('Adding Group to Groups Table issue:  ' . mysql_error());
		}
		$sql = "SELECT groupId FROM Groups WHERE name = '".$args[0]."';";
		$retVal = mysql_query($sql, $conn);
		$result = mysql_fetch_array($retVal);
		$newArgs = array($args[5], $result['groupId']);	
		
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
?>
