<?php
include('inc/database.php');
include('std_header.php');

$quizID = $_POST['quizid'];

$sqlPoint = "SELECT ql.points FROM quiz_list ql WHERE ql.id = $quizID";
$queryPoint = $conn->query($sqlPoint);
$callPoint = mysqli_fetch_assoc($queryPoint);

$point = $callPoint['points'];

$QuestionSQL = "SELECT q.id, q.question, q.question_img FROM question q WHERE q.quiz_id = $quizID";
$queryQuestion = $conn->query($QuestionSQL);

echo $_POST['answer77'][0];

/* while ($callQuestion = mysqli_fetch_assoc($queryQuestion)) {
    $questionID = $callQuestion['id'];

    $OptionSQL = "SELECT qo.id, qo.question_id, qo.option_text, qo.option_img, qo.is_right FROM question_option qo WHERE qo.question_id = $questionID";
    $queryOption = $conn->query($OptionSQL);
    $total = 0;
    while ($callAnswer = mysqli_fetch_assoc($queryOption)) {
        $result = $_POST['answer'];
    }
} */

?>