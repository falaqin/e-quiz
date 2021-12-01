<?php
//Import database connection
include('../inc/database.php');

//Get id
$questionID=$_GET['questionid'];
$quizID = $_GET['quiz_id'];


//SQL statement
$conn->query("DELETE FROM question WHERE id = ".$questionID);
$conn->query("DELETE FROM question_option WHERE quiz_id = ".$questionID);

//Check and run query
if($conn->commit())
{
    //redirect to home page
    header("Location:quiz_manage.php?id=$quizID");
}
else
{
    die("SQL error report ".$conn->error);
}
?>