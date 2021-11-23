<?php
include('../inc/database.php');

//get id
$id=$_GET['id'];

//sql statement
$sql="DELETE FROM quiz_list WHERE id='$id'";

//if sql statement no error
if($conn->query($sql))
{
    //redirect to user
    header("Location:quiz.php");
}
?>