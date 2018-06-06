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

if(isset($_POST['moduleid'])) {
	foreach($_POST['moduleid'] as $_modIDValue)
	{
		$dbStudentModuleQuery=$db->prepare("INSERT INTO `student-module`(`studentid`, `moduleid`) VALUES (:studentid, :moduleid)");
            $dbParams2=array('studentid'=>$id, 'moduleid'=>$_modIDValue);
            $dbStudentModuleQuery->execute($dbParams2);
	}
	 echo "<script>window.location.href = '../'</script>";
}

?>