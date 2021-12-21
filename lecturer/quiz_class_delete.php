<?php
//Import database connection
include('../inc/database.php');

//Get id
$class_id = $_GET['class_id'];
$quiz_id = $_GET['quiz_id'];

//SQL statement
$sql="DELETE FROM student_quiz WHERE quiz_id = '$quiz_id' AND class_id='$class_id'";

//Check and run query
if($conn->query($sql))
{
    //redirect to home page
    header("Location:quiz_manage.php?id=".$quiz_id);
}
else
{
    die("SQL error report ".$conn->error);
}
?>