<?php
	function getDBConnection() {
		$servername = "localhost";
		$username = "michiena";
		$password = "michiena6390";
		$dbname = "michiena";

		$conn = mysql_connect($servername, $username, $password);
		if($conn->connection_error)
			die("Connection failed: " . $conn->connect_error);

		mysql_select_db($dbname);

		return $conn;
	}
?>