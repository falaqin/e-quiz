<?php
include('../inc/database.php');

//get id
$id=$_GET['id'];

//sql statement
$sql="DELETE FROM student WHERE std_id='$id'";

//if sql statement no error
if($conn->query($sql))
{
    //redirect to user
    header("Location:student_info.php?page=1");
}
?>