<?php session_start();
		require '../databaseConnection.php';
		$conn = getDBConnection();
	
		// Check the user credentials, currently only checking for username
		$sql = "SELECT * FROM Users WHERE username = '".$_POST['username']."';";
		$result = mysql_query($sql, $conn);
		// The username does not exist, redirect to login
		if(mysql_num_rows($result) == 0){
			if(isset($_POST['noredirect'])) {
				echo "FAIL";
				exit();
			} else {
				header("Location: ./login.html");
				exit();
			}
		}
	
		$record = mysql_fetch_array($result);
		$_SESSION['userId']= "'".$record['userId']."'";
		$_SESSION['username']=$record['username'];
		$_SESSION['name']=$record['name'];
		
		if(isset($_POST['noredirect'])) {
			echo 'SUCCESS';
		} else {
			session_regenerate_id(true);
			header("Location: ./home.html");
			exit();
		}
?>
