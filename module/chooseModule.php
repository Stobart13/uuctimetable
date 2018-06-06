<!doctype html>
<html lang="en">
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

    $dbModuleQuery=$db->prepare("SELECT moduleid, modulename, modulecode FROM module");
    $dbModuleQuery->execute();
    ?>

<head>
		<title>Ulster University Timetable - Choose Modules</title>
		<link rel="icon" href="../images/favicon.ico">
		<link rel="stylesheet" type="text/css" href="../style/navbar.css">
		<link rel="stylesheet" type="text/css" href="../style/chooseModule.css">
		<!-- Required meta tags -->
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<!-- Font Awesome CSS -->
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.10/css/all.css" integrity="sha384-+d0P83n9kaQMCwj8F4RJB66tzIwOKmrdb46+porD/OvrJ+37WqIM7UoBtwHO6Nlg" crossorigin="anonymous">
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
          				 <a class="dropdown-item" href="/user/changePassword.php">Change Password</a>
          				<a class="dropdown-item" href="/logout">Log Out</a>
          				</div>
          				</div>';
				}else{
					echo "<script>window.location.href = '../login'</script>";
				}
			?>
			</form>
		</nav>
	</head>

    <body>
        <h1>Hello <?php echo $theUsername; ?> </h1>
        <p>Please select the modules you are currently studying (Maximum of 4 Modules)</p>
        <form method="get" action="chooseModule.php">
						<div class="form-row">
							<div class="form-group col-xs-10">
								<input class="form-control form-control-lg" type="text" name="search" placeholder="Search for courses">
							</div>
							
							<div class="form-group col-xs-2" style="padding-left: 0;">
								<button type="submit" class="btn btn-primary btn-lg"><i class="fas fa-search"></i></button>
							</div>
						</div>
				</form>
    <form id="choosingModule" method="post" action="choosingModule.php" >
       <?php 
         if (isset($_GET["search"])){

	$search = $_GET["search"];
	
	$dbQuery=$db->prepare("select * from module where modulecode like :search");
	$dbParams=array('search'=>"%".$search."%");
	$dbQuery->execute($dbParams);
	$searchResults = $dbQuery->rowCount();
}	
	else {
	$dbQuery=$db->prepare("select * from module");
	$dbQuery->execute();
}

while ($dbRow = $dbQuery->fetch(PDO::FETCH_ASSOC))
{
        $theModuleName = $dbRow["modulename"];
        $modID = $dbRow["moduleid"];
        $moduleCode = $dbRow["modulecode"];
	echo'<div class="form-check">
                <input type="checkbox" class="form-check-input" id="exampleCheck1" name="moduleid[]" value="'.$modID.'">
                <label class="form-check-label" for="exampleCheck1">' .$moduleCode."   ". $theModuleName.'</label>
                </div>';
            
}
   ?>
       
        <button type="submit" value="submit" class="btn btn-primary">Choose Modules</button>
        </form>
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
