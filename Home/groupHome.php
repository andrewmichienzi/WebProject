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
		#groupInformation h4 {
			display: inline-block;
		}
		span {
			padding-left: 1em;
		}
		.hidden {
			visibility: hidden;
		}
	</style>
	<script>
		$(document).ready(function () {
			getGroupInfo();
			$('#showForm').click(function () {
				$('#groupInformation').addClass('hidden');
				$('#groupForm').removeClass('hidden');
			});
			$('#button').click(function (event) {
				event.preventDefault();
				$.ajax({
					type: "POST",
					url: "./updateGroup.php",
					data: {groupName:$('#groupName').val(), course:$('#course').val(), description:$('#description').val()}
				}).done(function(data) {
					if(data == 'SUCCESS') {
						window.location.href = './groupHome.php';
					} else {
						alert("There was a problem updating the group information.");
					}
				});
			});
		}); 
		
		function getGroupInfo() {
			$.ajax('./getGroupInformation.php')
			.done(function(data) {
				var groupInfo = JSON.parse(data);
				if(data == 'ERROR') {
					alert('There was a problem getting the group information.');
				} else {
					$('h4.groupName > span').text(groupInfo.groupName);
					$('#groupName').val(groupInfo.groupName);
					$('h4.groupCourse > span').text(groupInfo.course);
					$('#course').val(groupInfo.course);
					$('h4.creationDate > span').text(groupInfo.createDate);
					$('h4.description > span').text(groupInfo.description);
					$('#description').val(groupInfo.description);
				}
			});
		}
	</script>
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
				<li><a id="schedule" href="../Schedule/schedules.html">Schedules</a></li>
				<li><a id="tasks" href="../Tasks/tasks.html">Tasks</a></li>
				<li><a id="groupMembers" href="../GroupMembers/groupMembers.html">Group Members</a></li>
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
			
				<div id="groupInformation" class="panel panel-primary">
					<div class="panel-heading">
						<h4>Group Information</h4>
					</div>
					<div class="panel-body">
						<div class="row col-xs-offset-1 col-xs-10">	
							<h4 class="groupName">Group Name:<span></span></h4>
						</div>				  	
						<div class="row col-xs-offset-1 col-xs-10">
							<h4 class="groupCourse">Group Course:<span></span></h4>
						</div>
						<div class="row col-xs-offset-1 col-xs-10">
							<h4 class="creationDate">Group Creation Date:<span></span></h4>
						</div>
						<div class="row col-xs-offset-1 col-xs-10">
							<h4 class="description">Group Description:<span></span></h4>
						</div>
						<div class="row col-xs-offset-1 col-xs-10">
							<button id="showForm">Edit Group Information</button>
						</div>							
					</div>
				</div>

				<div id="groupForm" class="panel panel-primary hidden">
					<div class="panel-heading">
						<h4>Edit Group Information</h4>
					</div>
					<div class="panel-body">
							<form class="col-xs-offset-1 col-xs-10" action="./updateGroup.php" method="POST">
								<div class="form-group">
								<label for="groupName">Group Name</label>
								<input type="text" class="form-control" id="groupName" name="groupName" placeholder="Group Name" maxlength="25">
							</div>
							<div class="form-group">
								<label for="course">Course</label>
								<input type="text" class="form-control" id="course" name="course" placeholder="Course" maxlength="25">
							</div>
							<div class="form-group">
								<label for="groupName">Group Description</label>
								<input type="textarea" class="form-control" id="description" name="description" placeholder="Group Description" maxlength="100">
							</div>
							<div class="form-group">			
						  		<button type="submit" id="button" class="btn btn-default">Update Group</button>
							</div>
							</form>
					</div>
				</div>
			</div>
		</div>
	</div>
</body>
