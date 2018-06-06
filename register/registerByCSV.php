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
// following code taken from https://www.bewebdeveloper.com/tutorial-about-import-csv-to-mysql-and-export-from-mysql-to-csv-in-php
$csv_file =  $_FILES['csv_file']['tmp_name'];
if (is_file($csv_file)) {
    $input = fopen($csv_file, 'a+');
    // if the csv file contain the table header leave this line
    $row = fgetcsv($input, 1024, ','); // here you got the header
    while ($row = fgetcsv($input, 1024, ',')) {
        // insert into the database
        $sql = 'INSERT INTO student(id,studentname,username,password,emailaddress) VALUES(:id,:studentname,:username,:password,:emailaddress)';
        $query = $db->prepare($sql);
        $query->bindParam(':id', $row[0], PDO::PARAM_INT);
        $query->bindParam(':studentname', $row[1], PDO::PARAM_STR);
        $query->bindParam(':username', $row[2], PDO::PARAM_STR);
        $query->bindParam(':password', $row[3], PDO::PARAM_STR);
        $query->bindParam(':emailaddress', $row[4], PDO::PARAM_STR);
        $query->execute();
    }
}
?>

<!doctype html>
<html lang="en">
<head>
		<title>Ulster University Timetable - Register via CSV</title>
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


<body>
<h2>Add Students via CSV</h2>
        <div class="form_upload">
            <h2>Upload CSV file</h2>
            <form action="registerByCSV.php" method="post" enctype="multipart/form-data">
                <input type="file" name="csv_file" id="csv_file" class="file_input" accept=".csv">
                <input type="submit" value="Upload file" id="upload_btn">
            </form>
        </div>
        	<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN"
					crossorigin="anonymous"></script>
				<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js" integrity="sha384-vFJXuSJphROIrBnz7yo7oB41mKfc8JzQZiCq4NCceLEaO4IHwicKwpJf9c9IpFgh"
					crossorigin="anonymous"></script>
				<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js" integrity="sha384-alpBpkh1PFOepccYVYDB4do5UnbKysX5WZXm3XxPqe5iKTfUKjNkCk9SaVuEZflJ"
					crossorigin="anonymous"></script>
</body>
</html>