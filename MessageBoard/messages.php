<!DOCTYPE html>
<head>
	<!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
	<!-- Optional theme -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">
	<!-- Site-wide css -->
	<link rel="stylesheet" href="default.css">
	<!-- JQuery -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
	<!-- Latest compiled and minified JavaScript -->
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
	
	<script>
		
	</script>
</head>
<body>

	<?php
	include 'databaseConnection.php';
	
	$conn = getDBConnection();
	
	function getPost($conn) {
		$sql = "SELECT * FROM MessageBoard WHERE groupID = 1;";
		$result = mysql_query($sql, $conn);
		if($result == NULL) {
			echo "There are no posts yet. Maybe you should make one.";
			return;
		}
		while($row = mysql_fetch_array($result)) {
				
		}
	}
	
	?>

	<div id = "header">
		<div class="row">
				<img id="logo" class ="bottomMargin col-xs-10 col-sm-2 col-xs-offset-1" src="logo.png"/>
		</div>
		<nav class="navbar navbar-default col-xs-10 col-xs-offset-1" >
			<div class="nav navbar-nav">
				<ul class="nav navbar-nav">
					<li><a id="home" href="home.html"><span class="glyphicon glyphicon-home" aria-hidden="true"></span></a></li>
					<li><a id="currentProject" href="#">Project A</a></li>
					<li class="active"><a id="messages" href="messages.html">Message Board</a></li>
					<li><a id="schedule" href="schedules.html">Schedules</a></li>
					<li><a id="tasks" href="tasks.html">Tasks</a></li>
					<li><a id="groupMembers" href="groupMembers.html">Group Members</a></li>
					<li><a id="user" href="userProfile.html" href="#">User Name</a></li>
				</ul>	
			</div>
		</nav>
	</div>
	
	<div id="content" class=" col-xs-10 col-xs-offset-1">
		<div class="panel panel-default">
			<div id="contentBody" class="panel-body">
			<h3>Message Board</h3>
				<div id="boardPost">
				<div class="content"></div>	
				</div>
			</div>
		</div>
	</div>
	
</body>