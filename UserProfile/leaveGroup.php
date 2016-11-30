<?php
	require '../checkSessionInformation.php';
    //checkSessionInformation();
	session_start();
	
	include '../databaseConnection.php';
	
	$conn = getDBConnection();
	
	$userId = 4;
	$groupId = $_POST['group'];
	
	$sql = "DELETE FROM UserGroups WHERE groupId = '".$groupId."' AND userId = '".$userId."';";
	$result = mysql_query($sql, $conn);
	
	echo "Left group.";
	
?>