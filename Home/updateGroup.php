<?php 
	session_start();
	require "../databaseConnection.php";
	$conn = getDBConnection();
	$sql =   " UPDATE Groups "
			." SET name = '".$_POST['groupName']."', course = '".$_POST['course']."', description = '".$_POST['description']
			."' WHERE groupId = ".$_SESSION['groupId'].";";
	if(mysql_query($sql, $conn)) {
		echo 'SUCCESS';	
	} else {
		echo 'ERROR';
	} 
?>
