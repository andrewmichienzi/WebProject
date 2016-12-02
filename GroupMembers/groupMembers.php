<?php
	session_start();
	require '../checkSessionInformation.php';
	checkSessionInformation();
?>
<!DOCTYPE html>
<head>
	<!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<!-- Optional theme -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css">
	<!-- JQuery -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
	<!-- Latest compiled and minified JavaScript -->
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	<!-- Site-wide css -->
	<link rel="stylesheet" href="../default.css">
</head>
<body>
	<div id = "header">
		<div class="row">
				<img id="logo" class ="bottomMargin col-xs-10 col-sm-2 col-xs-offset-1" src="../logo.png"/>
		</div>
		<nav class="navbar navbar-default col-xs-10 col-xs-offset-1" >
			<ul class="nav navbar-nav">
				<li><a id="home" href="../Home/home.html"><span class="glyphicon glyphicon-home" aria-hidden="true"></span></a></li>
				<li><a id="currentProject" href="../Home/groupHome.php"><?php session_start(); echo $_SESSION['groupName']; ?></a></li>
				<li><a id="messages" href="../MessageBoard/messages.html">Message Board</a></li>
				<li><a id="schedule" href="../Schedule/schedules.html">Schedules</a></li>
				<li><a id="tasks" href="../Tasks/tasks.html">Tasks</a></li>
				<li class="active"><a id="groupMembers" href="../GroupMembers/groupMembers.php">Group Members</a></li>
			</ul>	
			<ul class="nav navbar-nav navbar-right">
				<li><a id="user" href="../UserProfile/userProfile.html"><?php session_start(); echo $_SESSION['name']; ?></a></li>
				<li><a id="signout" href="../signout.php">Log Out</a></li>
			</ul>
		</nav>
	</div>
	
	<div id="content" class=" col-xs-10 col-xs-offset-1">
		<div class="panel panel-default">
			<div id="contentBody" class="panel-body">
				<div class="panel panel-primary">
					<div class="panel-heading">
						<h4>Group Members</h4>
					</div>
					<div class="panel-body">
<?php
	populateGroupInformation();
	function populateGroupInformation() {
		require '../databaseConnection.php';
		$conn = getDBConnection();
		$sql =   "SELECT name, username, email, phone "
			." FROM Users, UserGroups "
			." WHERE UserGroups.groupId = ".$_SESSION['groupId']." AND UserGroups.userId = Users.userId ; ";
		$result = mysql_query($sql, $conn);
		if(!$result) {
			echo 'There was a problem fetching the group members.';
		} else {
			while($row = mysql_fetch_array($result)) {		
?>
						<div class="row">
							<div class="col-xs-12">
								<div class="thumbnail">
									<div class="caption">
										<h4><?php echo $row['name']; ?></h4>	
										<h4 class="groupName">Username: <?php echo $row['username']; ?> </h4>
										<h4 class="groupCourse">Phone Number: <?php echo $row['phone']; ?> </h4>
										<h4 class="creationDate">Email: <?php echo $row['email']; ?> </h4>
									</div>						
								</div>
							</div>
						</div>	
<?php
			}
		}
	}
?>				
					</div>
				</div>
			</div>
		</div>
	</div>
</body>
