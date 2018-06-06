<!doctype html>
<html lang="en">
<?php
	session_start();
    include("db/dbconnect.php");
	
	$id= $_SESSION["currentUserID"];
	$dbQuery=$db->prepare("select * from student where id=:id");
	$dbParams=array('id'=>$id);
	$dbQuery->execute($dbParams);
   
		while ($dbRow = $dbQuery->fetch(PDO::FETCH_ASSOC)) 
		{
			$theUsername=$dbRow["studentname"];
		}

	
    $dbModuleQuery=$db->prepare("SELECT `student-module`.`moduleid`, `module`.`modulename` FROM `student-module` INNER JOIN `module` ON `student-module`.`moduleid` =`module`.`moduleID` INNER JOIN `student` ON `student-module`.`studentid` = `student`.`id` WHERE `student-module`.`studentid` = :id");
	$dbModuleQuery->execute($dbParams);
	$num_rows= $dbModuleQuery->rowCount();

	if(!isset($theUsername)){
		echo'<script>window.location.href = "https://uuctimetable.stuartkinnear.co.uk/login"</script>';
	}
?>

	<head>
		<title>Ulster University Timetable - Dashboard</title>
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
 <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
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
          				 <a class="dropdown-item" href="https://uuctimetable.stuartkinnear.co.uk//user/changePassword.php">Change Password</a>
          				<a class="dropdown-item" href="https://uuctimetable.stuartkinnear.co.uk/logout">Log Out</a>
          				</div>
          				</div>';
				}else{
					echo'<script>window.location.href = "https://uuctimetable.stuartkinnear.co.uk/login"</script>';
				}
			?>
			</form>
		</nav>
	</head>

	<body>
		<?php
if (isset($_GET["loggedout "])) {
		if ($_GET["loggedout "]==1)
         echo '<div class="alert alert-success alert-dismissible fade show "" role="alert"> You have now logged out
						<button type="button" class="close" data-dismiss="alert" aria-label="Close">
				<span aria-hidden="true">&times;</span>
				</button>
			</div>'; } if (isset($_GET["failCode"])) { if ($_GET["failCode"]==1) echo'
			<div class="alert alert-danger alert-dismissible fade show" " role="alert ">
				Bad username entered
				<button type="button " class="close " data-dismiss="alert " aria-label="Close ">
				<span aria-hidden="true ">&times;</span>
				</button>
			</div>';
      if ($_GET["failCode "]==2)
        	echo'<div class="alert alert-danger alert-dismissible fade show "" role="alert">
				Wrong password entered
				<button type="button" class="close" data-dismiss="alert" aria-label="Close">
				<span aria-hidden="true">&times;</span>
				</button>
			</div>'; } if (isset($_GET["passwordChange"])) { if ($_GET["passwordChange"]==1) echo'
			<div class="alert alert-danger alert-dismissible fade show" " role="alert ">
				Passwords do not match
				<button type="button " class="close " data-dismiss="alert " aria-label="Close ">
				<span aria-hidden="true ">&times;</span>
				</button>
			</div>';
      if ($_GET["passwordChange "]==2)
		  echo'<div class="alert alert-success alert-dismissible fade show "" role="alert">
				Passwords changed successfully
				<button type="button" class="close" data-dismiss="alert" aria-label="Close">
				<span aria-hidden="true">&times;</span>
				</button>
			</div>'; } if (isset($_GET["timetableAdded"])) { if($_GET["timetableAdded"]==1){ echo'
			<div class="alert alert-danger alert-dismissible fade show" " role="alert ">
				You have added a timetable
				<button type="button " class="close " data-dismiss="alert " aria-label="Close ">
				<span aria-hidden="true ">&times;</span>
				</button>
			</div>';
		}
   }
     
?>
	<?php
		if(isset($theUsername)) {
			echo '<div class="jumbotron">
			<h1 class="display-3">Hello '.$theUsername.'</h1>
			<p>You are doing the following modules:
			<ul>';

			while($dbModuleRow = $dbModuleQuery->fetch(PDO::FETCH_ASSOC)){
				$moduleName = $dbModuleRow["modulename"];

				echo'<li>'.$moduleName.'</li>';
			}
		}else{
			echo '<div class="jumbotron">
			<h1 class="display-3">Hello</h1>
			<p>Welcome to the Ulster University Timetable Application</p>
			<p>Please login or register to view your modules and timetable</p>
			</div>';
;
		}
		?>


				<!-- Optional JavaScript -->
				<!-- jQuery first, then Popper.js, then Bootstrap JS -->
				<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN"
					crossorigin="anonymous"></script>
				<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js" integrity="sha384-vFJXuSJphROIrBnz7yo7oB41mKfc8JzQZiCq4NCceLEaO4IHwicKwpJf9c9IpFgh"
					crossorigin="anonymous"></script>
				<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js" integrity="sha384-alpBpkh1PFOepccYVYDB4do5UnbKysX5WZXm3XxPqe5iKTfUKjNkCk9SaVuEZflJ"
					crossorigin="anonymous"></script>
	</body>

</html>