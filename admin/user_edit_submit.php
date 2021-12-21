<?php

//include('admin_header.php');
//db conns
include('../inc/database.php');

//receive data from input
//echo "stuff";
echo $id= $_POST['userid'];
echo $name=$_POST['name'];
echo $username=$_POST['username'];
echo $access_level=$_POST['access_level'];

//sql statement
$sql="UPDATE user
SET user_name='$name', u_username='$username', u_access_lvl='$access_level'
WHERE u_id='$id'";

//if query no error
if($conn->query($sql))
{
    //redirect to userphp page
    header("Location:user_info.php");
}
else
{
    //if error
    die("SQL error report ".$conn->error);
}
?>