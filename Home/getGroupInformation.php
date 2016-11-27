<?php
	require '../checkSessionInformation.php';
    checkSessionInformation();
    session_start();
	
	require '../databaseConnection.php';
	$conn = getDBConnection();

	$sql = 'SELECT * FROM Groups WHERE groupId = '.$_SESSION['groupId'].';';
	$result = mysql_query($sql, $conn);
	if(!$result) {
		echo "ERROR";
	} else {
		$record = mysql_fetch_array($result);
		$groupInfo = array();
		$groupInfo['groupName'] = $record['name'];
		$groupInfo['course'] = $record['course'];
		$groupInfo['description'] = $record['description'];
		$groupInfo['createDate'] = $record['createDate'];
		echo json_encode($groupInfo);
	}
?>
