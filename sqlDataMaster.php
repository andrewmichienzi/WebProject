<?php
header('Content-Type: application/json');
	$servername = "localhost";
	$username = "michiena";
	$password = "michiena6390";
	$dbname = "michiena";

	$conn = mysql_connect($servername, $username, $password);
	if($conn->connection_error)
		die("Connection failed: " . $conn->connect_error);

	mysql_select_db($dbname);
	//$testUser = array("5", "Andrew", "user1", "andrewmichienzi", "6163894812");
	//addUser($conn, $testUser);
	$testTask = array("4", "2", "Task 1", "NULL", "Test Description");
	addTask($conn, $testTask);
    	//printUsers($conn);
	$aResult = array();
/*
    	if( !isset($_POST['functionname']) ) { $aResult['error'] = 'No function name!'; }

    	if( !isset($_POST['arguments']) ) { $aResult['error'] = 'No function arguments!'; }

    	if( !isset($aResult['error']) ) {

        switch($_POST['functionname']) {
            case 'addUser':
               if( !is_array($_POST['arguments']) || (count($_POST['arguments']) != 6) ) {
                   $aResult['error'] = 'Error in arguments!';
               }
               else {
                   $aResult['result'] = addUser($conn, $_POST['arguments']);
               }
               break;
	    case 'addGroup'
               if( !is_array($_POST['arguments']) || (count($_POST['arguments']) != 5) ) {
                   $aResult['error'] = 'Error in arguments!';
               }
               else {
                   $aResult['result'] = addUser(floatval($_POST['arguments'][0]), floatval($_POST['arguments'][1]));
               }
	    case 'addTask'
               if( !is_array($_POST['arguments']) || (count($_POST['arguments']) != 6) ) {
                   $aResult['error'] = 'Error in arguments!';
               }
               else {
                   $aResult['result'] = addUser(floatval($_POST['arguments'][0]), floatval($_POST['arguments'][1]));
               }
               
            default:
               $aResult['error'] = 'Not found function '.$_POST['functionname'].'!';
               break;
        }

    }*/
	function addUser($conn, $args){
		$sql = "INSERT INTO User (userid, name, username, email, phone) VALUES ('" . $args[0] . "', '" . $args[1] . "', '" . $args[2] . "', '" . $args[3] . "', '" . $args[4] . "');";	
		$retval = mysql_query($sql, $conn);
		if(! $retval){
			die('Addng User issue' . mysql_error());
		}
	}
	function printUsers($conn){
		$sql = "Select * from User;";
		$retVal = mysql_query($sql, $conn);
		while($row = mysql_fetch_array($retVal)){
			echo $row['username'];
			echo '<br>';
		}
	}
	function addTask($conn, $args){
		$sql = "INSERT INTO Task (taskId, groupId, name, userId, description) VALUES ('" . $args[0] . "', '" . $args[1] . "', '" . $args[2] . "', '" . $args[3] . "', '" . $args[4] . "');";	
		$retVal = mysql_query($sql, $conn);
		if (! $retVal){
			die('Adding Task Issue  ' . mysql_error());
		}
	}
?>
