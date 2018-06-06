<?php
	include('../db/dbconnect.php');
        if (isset($_POST["submit"])) {


            $studentname=$_POST['studentname'];
            $username=$_POST['username'];
            $password=$_POST['password'];
            $password = password_hash($password, PASSWORD_DEFAULT); 
            $email=$_POST['emailaddress'];
            
            $dbQuery=$db->prepare("insert into student values (null,:studentname,:username,:password,:emailaddress)");
            $dbParams=array('studentname'=>$studentname,'username'=>$username,'password'=>$password,'emailaddress'=>$email);
            $dbQuery->execute($dbParams);
            header("Location:https://uuctimetable.stuartkinnear.co.uk");
            }
?>