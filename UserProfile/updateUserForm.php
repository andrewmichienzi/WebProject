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
		function validateForm() {
			var message = "";
			var u = document.forms["profileForm"]["user"].value;
			if(u == null || u == "") {
				message += "<br>Name must be filled out.";
			}
			var p = document.forms["profileForm"]["phone"].value;
			if(p == null || p == "") {
				message += "<br>Phone number must be filled out.";
			}
			var phoneno = /^\(?([0-9]{3})\)?[-. ]?([0-9]{3})[-. ]?([0-9]{4})$/;
			if(!p.value.match(phoneno)) {
				message += "<br>Please enter a valid phone number.";
			}
			var e = document.forms["profileForm"]["email"].value;
			if(e == null || e == "") {
				message += "<br>Email must be filled out.";
			}
			document.getElementById("error").innerHTML = message;
			if(message != "") {
				return false;
			}
		}
	</script>
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
				<div>
				<form name="profileForm" action="updateUser.php" onsubmit="return validateForm()" method="post">
					Name: <br>
					<input type="text" name="name"><br>
					Phone Number: <br>
					<input type="text" name="phone"><br>
					Email: <br>
					<input type="text" name="email"><br>
					<input type="submit" value="Submit">
					<p id="error"></p>
				</form>
				</div>
			</div>
		</div>
	</div>
	
</body>