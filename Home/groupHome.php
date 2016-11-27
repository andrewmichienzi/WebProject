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
	<style>
		body {
			background: url("../background.jpg");
		}
		#header {
			margin-top: 2%;
		}
		.bottomMargin {
			margin-bottom:1em;
		}
		#content {
			padding:0;
		}
	</style>
</head>
<body>
	<div id = "header">
		<div class="row">
				<img id="logo" class ="bottomMargin col-xs-10 col-sm-2 col-xs-offset-1" src="../logo.png"/>
		</div>
		<nav class="navbar navbar-default col-xs-10 col-xs-offset-1" >
			<ul class="nav navbar-nav">
				<li><a id="home" href="home.html"><span class="glyphicon glyphicon-home" aria-hidden="true"></span></a></li>
				<li class="active"><a id="currentProject" href="#"><?php session_start(); echo $_SESSION['groupName'];?></a></li>
				<li><a id="messages" href="../MessageBoard/messages.html">Message Board</a></li>
				<li><a id="schedule" href="../Sechedule/schedules.html">Schedules</a></li>
				<li><a id="tasks" href="../Tasks/tasks.html">Tasks</a></li>
				<li><a id="groupMembers" href="../GroupMembers/groupMembers.html">Group Members</a></li>
			</ul>	
			<ul class="nav navbar-nav navbar-right">
				<li><a id="user" href="./UserProfile/userProfile.html"><?php session_start(); echo $_SESSION['name']; ?></a></li>
				<li><a id="signout" href="../signout.php">Log Out</a></li>
			</ul>
		</nav>
	</div>
	
	<div id="content" class=" col-xs-10 col-xs-offset-1">
		<div class="panel panel-default">
			<div id="contentBody" class="panel-body">
			
				<div class="panel panel-primary">
					<div class="panel-heading">
						<h4>Group Information</h4>
					</div>
					<div class="panel-body">
						<div class="row">
							<?php 
								//session_start();
								//require '../databaseConnection.php';
								//$sql = "SELECT * FROM Groups WHERE groupId = ".$_SESSION['groupId'].";";
								 
								



							?>
						</div>
					</div>
				</div>

			</div>
		</div>
	</div>
</body>
