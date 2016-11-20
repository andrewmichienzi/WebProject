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
</head>
<body>
	<div id = "header">
		<div class="row">
				<img id="logo" class ="bottomMargin col-xs-10 col-sm-2 col-xs-offset-1" src="logo.png"/>
		</div>
		<nav class="navbar navbar-default col-xs-10 col-xs-offset-1" >
			<div class="nav navbar-nav">
				<ul class="nav navbar-nav">
					<li><a id="home" href="home.html"><span class="glyphicon glyphicon-home" aria-hidden="true"></span></a></li>
					<li><a id="currentProject" href="#">Project A</a></li>
					<li><a id="messages" href="messages.html">Message Board</a></li>
					<li><a id="schedule" href="schedules.html">Schedules</a></li>
					<li><a id="tasks" href="tasks.html">Tasks</a></li>
					<li><a id="groupMembers" href="groupMembers.html">Group Members</a></li>
					<li class="active"><a id="user" href="userProfile.html" href="#">User Name</a></li>
				</ul>	
			</div>
		</nav>
	</div>
	
	<div id="content" class=" col-xs-10 col-xs-offset-1">
		<div class="panel panel-default">
			<div id="contentBody" class="panel-body">
				<?php 
					include '../databaseConnection.php';
					// set userId from session varibles
					$conn = getDBConnection();
					$sql = "SELECT * FROM Users WHERE userId = " .$userId. ";";
					$result = mysql_query($sql, $conn);
					if($result == NULL) {
						echo "User not found.";
						return;
					}
					
					while($row = mysql_fetch_array($result)) {
						$user = row[1];
						$username = row[2];
						$email = row[3];
						$phone = row[4];
					}
					
					// print out user info
					
					$sql2 = "SELECT * FROM UserGroups WHERE userId = " .$userId. ";";
					$result2 = mysql_query($sql2, $conn);
					while($newrow = mysql_fetch_array($result2)) {
						// print out groups
					}
					
				?>
			</div>
		</div>
	</div>
	
</body>