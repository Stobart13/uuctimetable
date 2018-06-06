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
?>
<!doctype html>
<html lang="en">
<head>
		<?php
			if(isset($theUsername)) {
				 echo "<script>window.location.href = '../'</script>";
			}
		?>
		<title>Ulster University Timetable - Register </title>
		<link rel="icon" href="../images/favicon.ico">
		<link rel="stylesheet" type="text/css" href="../style/navbar.css">
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
				<ul class="navbar-nav mr-auto">
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


<form id="register" method="post" action="addNewStudent.php">
   <div class="form-group">
    <label for="studentName">Student Name <span style="color: #ff0000">*</span></label>
    <input type="text" class="form-control" name="studentname" placeholder="Student Name" required>
  </div>
  <div class="form-group">
    <label for="emial">Email address <span style="color: #ff0000">*</span></label>
    <input type="email" class="form-control" name="emailaddress" aria-describedby="emailHelp" placeholder="Enter email" pattern="[a-z0-9-.]*[@]\bulster.ac.uk" required>
    <small id="emailHelp" class="form-text text-muted">Email <strong>MUST</strong> be your Ulster University email address eg bxxxxxxxx@ulster.ac.uk.</small>
  </div>
   <div class="form-group">
    <label for="studentNumber">Student Number <span style="color: #ff0000">*</span></label>
    <input type="text" class="form-control" name="username" placeholder="Student Number" required>
  </div>
  <div class="form-group">
    <label for="password">Password <span style="color: #ff0000">*</span></label>
    <input type="password" class="form-control" name="password" placeholder="Password" required>
  </div>
 <button type="submit" name="submit" value="submit"class="btn btn-primary">Submit</button>
  <button type="reset" class="btn btn-danger">Clear</button>
</form>

     <!-- Optional JavaScript -->
                <!-- jQuery first, then Popper.js, then Bootstrap JS -->
                <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
                <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js" integrity="sha384-vFJXuSJphROIrBnz7yo7oB41mKfc8JzQZiCq4NCceLEaO4IHwicKwpJf9c9IpFgh" crossorigin="anonymous"></script>
                <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js" integrity="sha384-alpBpkh1PFOepccYVYDB4do5UnbKysX5WZXm3XxPqe5iKTfUKjNkCk9SaVuEZflJ" crossorigin="anonymous"></script>
   </body>
</html>