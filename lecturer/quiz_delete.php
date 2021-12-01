<?php
include('../inc/database.php');

//get id
$id=$_GET['id'];

//sql statement
$conn->query("DELETE FROM quiz_list WHERE id='$id'");
$conn->query("DELETE question, question_option FROM question INNER JOIN question_option WHERE question.id = question_option.question_id AND question.quiz_id = $id");

//if sql statement no error
if($conn->commit())
{
    header("Location:quiz_list.php");
}
?>