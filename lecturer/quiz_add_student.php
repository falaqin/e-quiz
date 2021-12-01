<?php
include("../inc/database.php");

$TS = count($_POST['students']);
$quizID = $_POST['idQuiz'];


for ($i=0; $i <= $TS; $i++) { 
    $idForStudents = $_POST['students'][$i]." ";

    $sql_AddQuiz = "INSERT INTO student_quiz (quiz_id, std_id) VALUES ('$quizID','$idForStudents')";
    if ($conn->query($sql_AddQuiz)) {
        echo "it works";
    }
}

header("location: quiz_manage.php?id=$quizID")
?>