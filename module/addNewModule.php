    <?php
        include('../db/dbconnect.php');
        if (isset($_POST["submit"])) {
            $modulename=$_POST["modulename"];
            $lecturername=$_POST["lecturername"];
            $modulelocation=$_POST["modulelocation"];
            $moduleCode=$_POST["modulecode"];
            
            $dbQuery=$db->prepare("INSERT INTO module values(null, :modulename, :lecturername, :modulecode, :modulelocation)");
            $dbParams=array('modulename'=>$modulename, 'lecturername'=>$lecturername,'modulelocation'=>$modulelocation, 'modulecode'=>$moduleCode);
            $dbQuery->execute($dbParams);

            echo "<script>window.location.href = '../'</script>";
    }
?>