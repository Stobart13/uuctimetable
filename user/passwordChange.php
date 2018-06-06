<?php
session_start();
include('../db/dbconnect.php');
	
$id= $_SESSION["currentUserID"];
//select all data from student table where id = currentuserID
$dbQuery=$db->prepare("select * from student where id=:id");
$dbParams=array('id'=>$id);
$dbQuery->execute($dbParams);
   
		while ($dbRow = $dbQuery->fetch(PDO::FETCH_ASSOC)) 
		{
			$theUsername=$dbRow["studentname"];
		}
        if (isset($_POST["submit"])) {
			$password1 = $_POST['newPassword'];
			$password2 = $_POST['confirmPassword'];
			$password = password_hash($password1, PASSWORD_DEFAULT); 
			
			if ($password1 != $password2){
				header("Location: ../index.php?passwordChange=1");
			}
			else {
				$updatePassQuery=$db->prepare("update student set password=:password where id=:id");
				$updatePassParams=array(':password'=>$password, ':id'=>$id);
				$updatePassQuery->execute($updatePassParams);
				header("Location:../index.php?passwordChange=2");
			}

		}
?>