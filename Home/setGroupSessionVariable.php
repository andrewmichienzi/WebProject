<?php 
	session_start();
	if(!(isset($_SESSION['username']) 
				&& isset($_SESSION['userId'])
				&& isset($_SESSION['name']))) {
					session_regenerate_id(true);
					header("Location: ../login.html");
					exit();
	} else {
		require "../databaseConnection.php";
		$conn = getDBConnection();
		$record = mysql_fetch_array($result);
		$sql = "SELECT groupId, name FROM Groups WHERE groupId = ".$_GET['groupId'].";";
		$result = mysql_query($sql, $conn);
		if(!$result) {
			session_regenerate_id(true);
			header("Location: ./home.html");
			exit();
		}  else {
			$record = mysql_fetch_array($result);
			$_SESSION['groupId'] = $record['groupId'];
			$_SESSION['groupName'] = $record['name'];
			session_regenerate_id(true);
			header("Location: groupHome.php");
			exit();
		}
	}
?>
