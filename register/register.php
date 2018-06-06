<!doctype html>
<html lang="en">
<?php 
    include("db/dbconnect.php");
	?>
<head>
    <title>Ulster University Timetable - Dashboard</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css" integrity="sha384-PsH8R72JQ3SOdhVi3uxftmaW6Vc51MKb0q5P2rRUpPvrszuE4W1povHYgTpBfshb" crossorigin="anonymous">
    <!--Navbar-->
    <nav class="navbar navbar-expand-lg navbar-dark" style="background-color: #1a2a4f;">
        <a class="navbar-brand" href="https://localhost/timetable">Ulster University Timetable</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item">
                    <a class="nav-link" href="#">Timetable</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="https://localhost/timetable/addModule.php">Add Module</a>
                </li>
            </ul>
        </div>
    </nav>
</head>

<form id="register" method="post" action="addNewStudent.php">
   <div class="form-group">
    <label for="studentName">Student Name <span style="color: #ff0000">*</span></label>
    <input type="text" class="form-control" name="studentname" placeholder="Student Name" required>
  </div>
  <div class="form-group">
    <label for="emial">Email address <span style="color: #ff0000">*</span></label>
    <input type="email" class="form-control" name="emailaddress" aria-describedby="emailHelp" placeholder="Enter email" pattern="[a-z0-9.]*[@]\bulster.ac.uk" required>
    <small id="emailHelp" class="form-text text-muted">Email <strong>MUST</strong> be your Ulster University email address eg @ulster.ac.uk.</small>
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