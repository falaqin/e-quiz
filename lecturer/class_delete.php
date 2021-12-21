<?php
//import data cons
include('../inc/database.php');

//get id
$id=$_GET['id'];
$page = $_GET['page'];

//sql statement
$sql="DELETE FROM class WHERE class_id='$id'";

//if sql statement no error
if($conn->query($sql))
{
    //redirect to user
    if ($page > 0) {
        header("Location:class_info.php?page=$page");
    } else {
        header("Location:class_info.php");
    }
}

?>