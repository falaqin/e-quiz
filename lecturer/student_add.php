<?php 
    include("../inc/database.php");

    $userArray = array();
    $name = $_POST['name'];

    foreach ($name as $x => $val) {
        $name = $val;
        $matric = ($_POST['matrix'][$x]);
        $username = ($_POST['username'][$x]);
        $password = md5($_POST['password'][$x]);
        $session = ($_POST['session'][$x]);
        $class = ($_POST['class'][$x]);

        $userArray[] = "('$username','$password','$name','$matric','$session', '$class')";
    }

    //run insert into sql
    $sql="INSERT INTO student(std_username, std_password, std_name, std_matric, std_session, class_id)
    VALUES" . implode(", ", $userArray);

    //if sql statement no error
    if($conn->query($sql))
    {
        //redirect to user page
        header("Location:student_info.php");
    }
    else
    {
        //if theres error
        die("SQL error report ".$conn->error);

    }
?>