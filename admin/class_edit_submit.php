<?php
include('../inc/database.php');

echo $id = $_POST['classid'];
echo $class = $_POST['class'];

$sql = "UPDATE class
SET class_section = '$class'
WHERE class_id = '$id'";

if($conn->query($sql))
{
    //redirect to userphp page
    header("Location:class_info.php?page=1");
}
else
{
    //if error
    die("SQL error report ".$conn->error);
}
?>