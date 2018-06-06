<?php
   session_start();
   
   unset($_SESSION["currentUser"]);
   unset($_SESSION["currentUserID"]);

   if (isset($_POST["action"]) && $_POST["action"]=="login") {

      $formUser=$_POST["username"];
      $formPass=$_POST["password"];
	  $hashed_password= password_hash($formPass, PASSWORD_DEFAULT);

      include("../db/dbconnect.php");
	  $dbQuery=$db->prepare("select * from student where username=:formUser");
	  $dbParams = array('formUser'=>$formUser);
      $dbQuery->execute($dbParams);
      $dbRow=$dbQuery->fetch(PDO::FETCH_ASSOC);
	  
	  
	  //Allows Username to be entered in Uppercase or Lowercase
	  if(strtolower($dbRow["username"]) == strtolower($formUser)) {       
         if (password_verify($formPass, $hashed_password)){
            $_SESSION["currentUser"]=$formUser;
            $_SESSION["currentUserID"]=$dbRow["id"];
			  header("Location: https://uuctimetable.stuartkinnear.co.uk/");    
         }
         else {
            header("Location: ../index.php?failCode=2");
         }
      } else {
            header("Location: ../index.php?failCode=1");
      }

   } else {

?>
<head>
	<title>Ulster University Timetable - Login</title>
	<link rel="icon" href="../images/favicon.ico">
	<!-- Font Awesome CSS -->
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.10/css/all.css" integrity="sha384-+d0P83n9kaQMCwj8F4RJB66tzIwOKmrdb46+porD/OvrJ+37WqIM7UoBtwHO6Nlg" crossorigin="anonymous">
	<link rel="stylesheet" type="text/css" href="../../style/login.css">
   <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css" integrity="sha384-PsH8R72JQ3SOdhVi3uxftmaW6Vc51MKb0q5P2rRUpPvrszuE4W1povHYgTpBfshb" crossorigin="anonymous">
    <!--Navbar-->
</head>

<body>
 <form name="login" method="post" action="index.php">
<div class="col-md-4 offset-md-4">
<div class="card text-center text-white mb-3" id="loginCard">
 <img class="card-img-top" src="../images/loginlogo.png" alt="Ulster University Logo">
  <div class="card-header"><h1>Login<h1></div>
  <div class="card-body">
	  <div class="form-group">
		<label class="control-label" for="username">Username</label>
		<div class="input-group">
			<div class="input-group-addon"><i class="fas fa-user"></i></div>
			<input class="form-control" id="username" name="username"/>
		</div>
	</div>
	<div class="form-group">
		<label class="control-label" for="username">Password</label>
	<div class="input-group">
			<div class="input-group-addon"><i class="fas fa-lock"></i></div>
			<input class="form-control" type="password" id="password" name="password"/>
	</div>
	</div>
	<div>
		<input type="hidden" name="action" value="login">
		<input type="submit" value="Login" class="btn btn-primary btn-lg active" role="button">
	</div>
</div>
	<div class="card-footer">
		<a href="https://uuctimetable.stuartkinnear.co.uk/register" class="register"><h2>Don't have an account? Register Here!</h2></a>
	</div>
</div>
</div>
</form>
</body>
<?php
   }
?>