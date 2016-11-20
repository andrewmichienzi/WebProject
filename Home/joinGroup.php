<?php 
	session_start();

	include "../databaseConnection.php";
	$conn = getDBConnection();
	$sql = "SELECT groupId FROM Groups WHERE name = " + $_POST['groupName'] + ";";
	$result = mysql_query($sql, $conn);
	if(mysql_num_rows($result) == 0) {
		echo 'notFound';
	} else {
		$record = mysql_fetch_array($result);
		$sql = "INSERT INTO UserGroups (userId, groupId) VALUES ( '".$_POST['userId']."' , '" . $record['groupId']."' );";
		$result = mysql_query($sql, $conn);
		if(!$result) {
			echo "ERROR";
		}  else {
			echo $record['groupId'];
		}
		
	}
?>
