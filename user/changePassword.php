<?php

session_start();
include("../db/dbconnect.php");

$id= $_SESSION["currentUserID"];
$dbQuery=$db->prepare("select * from student where id=:id");
$dbParams=array('id'=>$id);
$dbQuery->execute($dbParams);
   
		while ($dbRow = $dbQuery->fetch(PDO::FETCH_ASSOC)) 
		{
			$theUsername=$dbRow["studentname"];
		}

if (!(isset($theUsername)))
{
    header("location:/login/index.php");
}
?>
<head>
		<title>Ulster University Timetable - Change Password</title>
		<link rel="icon" href="../images/favicon.ico">
		<link rel="stylesheet" type="text/css" href="style/navbar.css">
		<!-- Required meta tags -->
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<!-- Bootstrap CSS -->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css" integrity="sha384-PsH8R72JQ3SOdhVi3uxftmaW6Vc51MKb0q5P2rRUpPvrszuE4W1povHYgTpBfshb"
			crossorigin="anonymous">
		<!--Navbar-->
		<nav class="navbar navbar-expand-lg navbar-dark justify-content-between" style="background-color: #1a2a4f;">
			<a class="navbar-brand" href="https://uuctimetable.stuartkinnear.co.uk/"><img src="../images/logo.png"></a>
			<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown"
				aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
			<div class="collapse navbar-collapse" id="navbarNavDropdown">
				<ul class="navbar-nav">
					<li class="nav-item" id="timetable">
						<a class="nav-link" href="https://uuctimetable.stuartkinnear.co.uk/timetable">Timetable</a>
					</li>
					<li class="nav-item dropdown">
						<a class="nav-link dropdown-toggle" id="navbarDropdown" data-toggle="dropdown" href="#" role="button" aria-haspopup="true"
							aria-expanded="false">Module</a>
						<div class="dropdown-menu" aria-labelledby="navbarDropdown">
							<a class="dropdown-item" href="https://uuctimetable.stuartkinnear.co.uk/module/addModule.php">Add a Single Module</a>
							<a class="dropdown-item" href="https://uuctimetable.stuartkinnear.co.uk/module/chooseModule.php">Choose Modules</a>
							<a class="dropdown-item" href="https://uuctimetable.stuartkinnear.co.uk/module/addModuleCSV">Add Modules via CSV</a>
						</div>
					</li>

				</ul>
			</div>
			<form class="form-inline">
				<?php
				if (isset($theUsername)){
					echo'<div class="dropdown">
					<a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">' .$theUsername.'
        				</a>
					<div class="dropdown-menu" aria-labelledby="navbarDropdown">
          				 <a class="dropdown-item" href="/user/changePassword.php">Change Password</a>
          				<a class="dropdown-item" href="/logout">Log Out</a>
          				</div>
          				</div>';
				}else{
					echo'<a href="https://uuctimetable.stuartkinnear.co.uk/login/" class="login"><h4>Log in</h4></a>';
				}
			?>
			</form>
		</nav>
	</head>

	<body>
		<h1>Change password for <?php echo $theUsername;?></h1>
			<form id="passwordChange" method="post" action="passwordChange.php">
			  <div class="form-group">
				<label for="exampleInputEmail1">New Password</label>
				<input type="password" class="form-control" name="newPassword" aria-describedby="emailHelp" placeholder="New Password" required>
			  </div>
			  <div class="form-group">
				<label for="exampleInputPassword1">Confirm Password</label>
				<input type="password" class="form-control" name="confirmPassword" placeholder="Password" required>
				<small id="confirmHelp" class="form-text text-muted">Please re-enter your password to confirm</small>
			  </div>
			   <button type="submit" name="submit" value="submit"class="btn btn-primary">Submit</button>
			   <button type="reset" class="btn btn-danger">Clear</button>
			</form>	