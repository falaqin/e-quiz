<?php 
    include("../inc/database.php");

    $userArray = array();
    $name = $_POST['name'];

    foreach ($name as $x => $val) {
        $name = $val;
        $username = ($_POST['username'][$x]);
        $password = md5($_POST['password'][$x]);
        $access_level = ($_POST['access_level'][$x]);

        $userArray[] = "('$name','$username','$password','$access_level')";
    }

    //run insert into sql
    $sql="INSERT INTO user(user_name, u_username, u_password, u_access_lvl)
    VALUES" . implode(", ", $userArray); 

    //if sql statement no error
    if($conn->query($sql))
    {
        //redirect to user page
        header("Location:user_info.php");
    }
    else
    {
        //if theres error
        die("SQL error report ".$conn->error);

    }
?>