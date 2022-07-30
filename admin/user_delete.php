<?php
include('../inc/database.php');

//get id
$id=$_GET['id'];

//sql statement
$sql="DELETE FROM user WHERE u_id='$id'";

//if sql statement no error
if($conn->query($sql))
{
    //redirect to user
    header("Location:user_info.php?page=1");
}
?>