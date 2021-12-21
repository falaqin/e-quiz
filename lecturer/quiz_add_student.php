<?php
include("../inc/database.php");

$TS = count($_POST['class']);
$quizID = $_POST['idQuiz'];


for ($i=0; $i <= $TS; $i++) { 
    $idClass = $_POST['class'][$i]." ";

    $sql_AddQuiz = "INSERT INTO student_quiz (quiz_id, class_id) VALUES ('$quizID','$idClass')";
    if ($conn->query($sql_AddQuiz)) {
        echo "it works";
    }
}

header("location: quiz_manage.php?id=$quizID")
?>