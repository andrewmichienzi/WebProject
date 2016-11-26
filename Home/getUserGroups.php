<?php 
	session_start();
	require '../databaseConnection.php';
	$conn = getDBConnection();
	$sql = "SELECT g.groupId, g.name FROM UserGroups AS ug, Groups AS g WHERE ug.userId = ".$_SESSION['userId']." AND g.groupId = ug.groupId;";
	$result = mysql_query($sql, $conn);
	if (! $result){
			die('Select group id, name error:  ' . mysql_error());
	}
	$ary=array();
	while($row = mysql_fetch_array($result)){
		$ary[$row['groupId']] = $row['name'];
	}
	echo json_encode($ary);
?>
