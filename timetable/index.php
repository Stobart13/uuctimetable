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
        
    $dbQuery9am=$db->prepare("SELECT `timetable`.`Day`, `timetable`.`starttime`, `module`.`modulename`, `module`.`modulelocation`, `module`.`modulecode`, `module`.`lecturername` FROM `timetable` INNER JOIN `student-module` on `student-module`.`moduleid` = `timetable`.`moduleid` INNER JOIN`module` on `module`.`moduleid` = `student-module`.`moduleid` WHERE `student-module`.`studentid` = :id AND `timetable`.`starttime` = '0915'");
	$dbQuery9am->execute($dbParams);

    $dbQuery10am=$db->prepare("SELECT `timetable`.`Day`, `timetable`.`starttime`, `module`.`modulename`, `module`.`modulelocation`, `module`.`modulecode`, `module`.`lecturername` FROM `timetable` INNER JOIN `student-module` on `student-module`.`moduleid` = `timetable`.`moduleid` INNER JOIN`module` on `module`.`moduleid` = `student-module`.`moduleid` WHERE `student-module`.`studentid` = :id AND `timetable`.`starttime` = '1015'");
	$dbQuery10am->execute($dbParams);

    $dbQuery11am=$db->prepare("SELECT `timetable`.`Day`, `timetable`.`starttime`, `module`.`modulename`, `module`.`modulelocation`, `module`.`modulecode`, `module`.`lecturername` FROM `timetable` INNER JOIN `student-module` on `student-module`.`moduleid` = `timetable`.`moduleid` INNER JOIN`module` on `module`.`moduleid` = `student-module`.`moduleid` WHERE `student-module`.`studentid` = :id AND `timetable`.`starttime` = '1115'");
	$dbQuery11am->execute($dbParams);

    $dbQuery12pm=$db->prepare("SELECT `timetable`.`Day`, `timetable`.`starttime`, `module`.`modulename`, `module`.`modulelocation`, `module`.`modulecode`, `module`.`lecturername` FROM `timetable` INNER JOIN `student-module` on `student-module`.`moduleid` = `timetable`.`moduleid` INNER JOIN`module` on `module`.`moduleid` = `student-module`.`moduleid` WHERE `student-module`.`studentid` = :id AND `timetable`.`starttime` = '1215'");
	$dbQuery12pm->execute($dbParams);

    $dbQuery1pm=$db->prepare("SELECT `timetable`.`Day`, `timetable`.`starttime`, `module`.`modulename`, `module`.`modulelocation`, `module`.`modulecode`, `module`.`lecturername` FROM `timetable` INNER JOIN `student-module` on `student-module`.`moduleid` = `timetable`.`moduleid` INNER JOIN`module` on `module`.`moduleid` = `student-module`.`moduleid` WHERE `student-module`.`studentid` = :id AND `timetable`.`starttime` = '1315'");
	$dbQuery1pm->execute($dbParams);

    $dbQuery2pm=$db->prepare("SELECT `timetable`.`Day`, `timetable`.`starttime`, `module`.`modulename`, `module`.`modulelocation`, `module`.`modulecode`, `module`.`lecturername` FROM `timetable` INNER JOIN `student-module` on `student-module`.`moduleid` = `timetable`.`moduleid` INNER JOIN`module` on `module`.`moduleid` = `student-module`.`moduleid` WHERE `student-module`.`studentid` = :id AND `timetable`.`starttime` = '1415'");
	$dbQuery2pm->execute($dbParams);

    $dbQuery3pm=$db->prepare("SELECT `timetable`.`Day`, `timetable`.`starttime`, `module`.`modulename`, `module`.`modulelocation`, `module`.`modulecode`, `module`.`lecturername` FROM `timetable` INNER JOIN `student-module` on `student-module`.`moduleid` = `timetable`.`moduleid` INNER JOIN`module` on `module`.`moduleid` = `student-module`.`moduleid` WHERE `student-module`.`studentid` = :id AND `timetable`.`starttime` = '1515'");
	$dbQuery3pm->execute($dbParams);

    $dbQuery4pm=$db->prepare("SELECT `timetable`.`Day`, `timetable`.`starttime`, `module`.`modulename`, `module`.`modulelocation`, `module`.`modulecode`, `module`.`lecturername` FROM `timetable` INNER JOIN `student-module` on `student-module`.`moduleid` = `timetable`.`moduleid` INNER JOIN`module` on `module`.`moduleid` = `student-module`.`moduleid` WHERE `student-module`.`studentid` = :id AND `timetable`.`starttime` = '1615'");
	$dbQuery4pm->execute($dbParams);
    
    
?>
<head>
		<title>Ulster University Timetable - Timetable</title>
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
					echo "<script>window.location.href = '../login'</script>";
				}
			?>
			</form>
		</nav>
	</head>

    <?php
   echo "<h2>Timetable for " .$theUsername."</h2>
   <table class='table-responsive table-striped col-md4 offset-md4 table-bordered student_table'>
            <thead class='thead-inverse'> 
                <tr>
                    <th>Time</th>
                    <th>Monday</th>
                    <th>Tuesday</th>
                    <th>Wednesday</th>
                    <th>Thursday</th>
                    <th>Friday</th>
                </tr>
            </thead>";
            ?>
        <tr>
            <td>9:15am</td>
            <?php
                        //code taken from https://stackoverflow.com/questions/42109009/how-to-create-a-timetable-in-php and modified to add own DB Structure
                        $week_days = array('Monday','Tuesday','Wednesday','Thursday','Friday');
                        $classes = array();
                        while($dbRow=$dbQuery9am->fetch(PDO::FETCH_ASSOC)) {
                            $classes[$dbRow['Day']] = $dbRow;
                        }
                        
                        foreach ($week_days as $day) {
                             if (array_key_exists($day, $classes)) {
                                  $dbRow = $classes[$day];
                                  echo'<td>'. $dbRow['modulename'] . '<br>' . $dbRow['modulelocation']. '<br>' . $dbRow['lecturername']. '<br>' . $dbRow['modulecode'].'</td>';
                            } else {
                            echo'<td>No Class</td>';
                             }
                        }
                             ?>

        </tr>

        <tr>
        <td>10:15am</td>
            <?php
                         //code taken from https://stackoverflow.com/questions/42109009/how-to-create-a-timetable-in-php and modified
                        $week_days = array('Monday','Tuesday','Wednesday','Thursday','Friday');
                        $classes = array();
                        while($dbRow=$dbQuery10am->fetch(PDO::FETCH_ASSOC)) {
                            $classes[$dbRow['Day']] = $dbRow;
                        }
                        
                          foreach ($week_days as $day) {
                             if (array_key_exists($day, $classes)) {
                                  $dbRow = $classes[$day];
                                  echo'<td>'. $dbRow['modulename'] . '<br>' . $dbRow['modulelocation']. '<br>' . $dbRow['lecturername']. '<br>' . $dbRow['modulecode'].'</td>';
                            } else {
                            echo'<td>No Class</td>';
                             }
                        }
                             ?>
            </tr>
            <tr>
            <td>11:15am</td>
                <?php   
                         //code taken from https://stackoverflow.com/questions/42109009/how-to-create-a-timetable-in-php and modified
                        $week_days = array('Monday','Tuesday','Wednesday','Thursday','Friday');
                        $classes = array();
                        while($dbRow=$dbQuery11am->fetch(PDO::FETCH_ASSOC)) {
                            $classes[$dbRow['Day']] = $dbRow;
                        }
                        
                         foreach ($week_days as $day) {
                             if (array_key_exists($day, $classes)) {
                                  $dbRow = $classes[$day];
                                  echo'<td>'. $dbRow['modulename'] . '<br>' . $dbRow['modulelocation']. '<br>' . $dbRow['lecturername']. '<br>' . $dbRow['modulecode'].'</td>';
                            } else {
                            echo'<td>No Class</td>';
                             }
                        }
              ?>
              </tr>
              <tr>
              <td>12:15pm</td>
              <?php
                        //code taken from https://stackoverflow.com/questions/42109009/how-to-create-a-timetable-in-php and modified
                        $week_days = array('Monday','Tuesday','Wednesday','Thursday','Friday');
                        $classes = array();
                        while($dbRow=$dbQuery12pm->fetch(PDO::FETCH_ASSOC)) {
                            $classes[$dbRow['Day']] = $dbRow;
                        }
                        
                         foreach ($week_days as $day) {
                             if (array_key_exists($day, $classes)) {
                                  $dbRow = $classes[$day];
                                  echo'<td>'. $dbRow['modulename'] . '<br>' . $dbRow['modulelocation']. '<br>' . $dbRow['lecturername']. '<br>' . $dbRow['modulecode'].'</td>';
                            } else {
                            echo'<td>No Class</td>';
                             }
                        }
                             ?>
            </tr>
            <tr>
                <td>1:15pm</td>
                <?php
                        //code taken from https://stackoverflow.com/questions/42109009/how-to-create-a-timetable-in-php and modified
                        $week_days = array('Monday','Tuesday','Wednesday','Thursday','Friday');
                        $classes = array();
                        while($dbRow=$dbQuery1pm->fetch(PDO::FETCH_ASSOC)) {
                            $classes[$dbRow['Day']] = $dbRow;
                        }
                        
                          foreach ($week_days as $day) {
                             if (array_key_exists($day, $classes)) {
                                  $dbRow = $classes[$day];
                                  echo'<td>'. $dbRow['modulename'] . '<br>' . $dbRow['modulelocation']. '<br>' . $dbRow['lecturername']. '<br>' . $dbRow['modulecode'].'</td>';
                            } else {
                            echo'<td>No Class</td>';
                             }
                        }
                 ?>
                 </tr>
                 <tr>
                    <td>2:15pm</td>
                    <?php
                        //code taken from https://stackoverflow.com/questions/42109009/how-to-create-a-timetable-in-php and modified
                        $week_days = array('Monday','Tuesday','Wednesday','Thursday','Friday');
                        $classes = array();
                        while($dbRow=$dbQuery2pm->fetch(PDO::FETCH_ASSOC)) {
                            $classes[$dbRow['Day']] = $dbRow;
                        }
                        
                          foreach ($week_days as $day) {
                             if (array_key_exists($day, $classes)) {
                                  $dbRow = $classes[$day];
                                  echo'<td>'. $dbRow['modulename'] . '<br>' . $dbRow['modulelocation']. '<br>' . $dbRow['lecturername']. '<br>' . $dbRow['modulecode'].'</td>';
                            } else {
                            echo'<td>No Class</td>';
                             }
                        }
                    ?>
                </tr>
                <tr>
                    <td>3:15pm</td>
                    <?php
                    //code taken from https://stackoverflow.com/questions/42109009/how-to-create-a-timetable-in-php and modified
                        $week_days = array('Monday','Tuesday','Wednesday','Thursday','Friday');
                        $classes = array();
                        while($dbRow=$dbQuery3pm->fetch(PDO::FETCH_ASSOC)) {
                            $classes[$dbRow['Day']] = $dbRow;
                        }
                        
                          foreach ($week_days as $day) {
                             if (array_key_exists($day, $classes)) {
                                  $dbRow = $classes[$day];
                                  echo'<td>'. $dbRow['modulename'] . '<br>' . $dbRow['modulelocation']. '<br>' . $dbRow['lecturername']. '<br>' . $dbRow['modulecode'].'</td>';
                            } else {
                            echo'<td>No Class</td>';
                             }
                        }
                    ?>
                </tr>
                <tr>
                    <td>4:15pm</td>
                    <?php
                    //code taken from https://stackoverflow.com/questions/42109009/how-to-create-a-timetable-in-php and modified
                        $week_days = array('Monday','Tuesday','Wednesday','Thursday','Friday');
                        $classes = array();
                        while($dbRow=$dbQuery10am->fetch(PDO::FETCH_ASSOC)) {
                            $classes[$dbRow['Day']] = $dbRow;
                        }
                        
                          foreach ($week_days as $day) {
                             if (array_key_exists($day, $classes)) {
                                  $dbRow = $classes[$day];
                                  echo'<td>'. $dbRow['modulename'] . '<br>' . $dbRow['modulelocation']. '<br>' . $dbRow['lecturername']. '<br>' . $dbRow['modulecode'].'</td>';
                            } else {
                            echo'<td>No Class</td>';
                             }
                        }
                    ?>
                </tr>

        </tbody>
        </table>
                 <!-- Optional JavaScript -->
                <!-- jQuery first, then Popper.js, then Bootstrap JS -->
                <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
                <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js" integrity="sha384-vFJXuSJphROIrBnz7yo7oB41mKfc8JzQZiCq4NCceLEaO4IHwicKwpJf9c9IpFgh" crossorigin="anonymous"></script>
                <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js" integrity="sha384-alpBpkh1PFOepccYVYDB4do5UnbKysX5WZXm3XxPqe5iKTfUKjNkCk9SaVuEZflJ" crossorigin="anonymous"></script>
    </body>
</html>