<?php
//Import database connection
include('../inc/database.php');

//Get id
$questionID=$_GET['questionid'];
$quizID = $_GET['quiz_id'];

//delete pictures if there is any
$sql = "SELECT question_img FROM question WHERE id = $questionID";
$query=$conn->query($sql);
$row=mysqli_fetch_assoc($query);
$dir = "../uploads/";
$file = $row['question_img'];
if ($file <> '') {
    unlink($dir . $file);
}

//delete pictures from question options if there is any
$sql2;


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