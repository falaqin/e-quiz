<?php
//Import database connection
include('../inc/database.php');

//Get id
    $std_id = $_GET['std_id'];
    $quiz_id = $_GET['quiz_id'];

//SQL statement
$sql="DELETE FROM student_quiz WHERE quiz_id = '$quiz_id' AND std_id='$std_id'";

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