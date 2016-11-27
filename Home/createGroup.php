<?php 
		session_start();
		require '../databaseConnection.php';
		$conn = getDBConnection();
		$sql = "INSERT INTO Groups (name, course, description, createDate, dueDate) VALUES ('" 
			. $_POST['groupName'] . "', '" . $_POST['course'] . "', '" . $_POST['description'] . "', NOW(), NOW());";	
		$retVal = mysql_query($sql, $conn);
		if (! $retVal){
			echo 'ADDGROUPERROR';
		} else {
			$sql2 = "SELECT groupId FROM Groups WHERE name = '".$_POST['groupName']."';";
			$val = mysql_query($sql2, $conn);
			if(!$val) {
				echo 'SELECTGROUPIDERROR';
			} else {
				$result = mysql_fetch_array($val);	
				$sql3 = "INSERT INTO UserGroups (userId, groupId) VALUES (" . $_SESSION['userId'] . ", '" . $result['groupId'] . "');";	
				echo $numrows;
				$numrows = mysql_num_rows();
				$retVal = mysql_query($sql3, $conn);
				if (! $retVal){
					echo 'ADDINGUSERGROUPERROR';
				} else {
					echo 'SUCCESS';
					$_SESSION['groupId'] = $result['groupId'];
					$_SESSION['groupName'] = $_POST['groupName'];
				}
			}
		}
?>
