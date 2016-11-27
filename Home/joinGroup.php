<?php 
	session_start();

	require "../databaseConnection.php";
	$conn = getDBConnection();
	$sql = "SELECT groupId, name FROM Groups WHERE UPPER(name) = UPPER('".$_POST['groupName']."');";
	$result = mysql_query($sql, $conn);
	if(!$result || mysql_num_rows() == 0) {
		echo 'NOTFOUND';
	} else {
		$record = mysql_fetch_array($result);
		$sql = "INSERT INTO UserGroups (userId, groupId) VALUES ( ".$_SESSION['userId']." , '" . $record['groupId']."' );";
		$insertresult = mysql_query($sql, $conn);
		if(!$insertresult) {
			echo "ERROR";
		}  else {
			$_SESSION['groupId'] = $record['groupId'];
			$_SESSION['groupName'] = $record['name'];
			echo 'SUCCESS';
		}
	}
?>
