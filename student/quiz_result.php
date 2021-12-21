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

$answerForDB = array();
$num = 0;

while ($callQID = mysqli_fetch_assoc($queryQuestion)) {
    $answer = $_POST["answer" . $callQID['id']][0];
    if ($answer == '0') {
        $incorrect++;
        $actualMark += $point;
    } elseif ($answer == '1') {
        $correct++;
        $rightanswer = $answer * $point;
        $total += $rightanswer;
        $actualMark += $point;
    } elseif ($answer == '') {
        $unanswered++;
        $actualMark += $point;
        $answer = 0;
    }
    $answerForDB[$num] = $answer;
    $num++;
}

if ($total == '') {
    $total = 0;
}

$questionID = $_POST['question_id'];

for ($i=0; $i < count($questionID); $i++) { 
    $QueryFor_stdAnswer = "INSERT INTO student_answer (std_id, quiz_id, question_id, is_right)
    VALUES ('$SQLstd_id','$quizID','$questionID[$i]','$answerForDB[$i]')";

    $RunQuery_stdAnswer = mysqli_query($conn, $QueryFor_stdAnswer);
} if ($RunQuery_stdAnswer) {
    $QueryFor_stdScore = "UPDATE student_score (quiz_id, std_id, std_points, total_points)
    SET std_points = '$total', total_points = '$actualMark'
    WHERE quiz_id = $quizID
    AND std_id = $SQLstd_id";

    $RunQuery_stdScore = mysqli_query($conn, $QueryFor_stdScore);
    echo '<script> alert("Your answers have been submitted."); </script>';
}

?>

<canvas id="resultChart" style="width:100%;max-width:900px" class="center"></canvas>

<div class="container">
    <h1>You have scored <?php echo $total ?> out of <?php echo $actualMark ?></h1>
</div>

<script>
    var xValues = ["Correct", "Incorrect", "Unanswered"];
    var yValues = [<?php echo $correct ?>, <?php echo $incorrect ?>, <?php echo $unanswered ?>];
    var barColors = [
        "#1e7145",
        "#b91d47",
        "#202124"
    ];

    new Chart("resultChart", {
    type: "doughnut",
    data: {
        labels: xValues,
        datasets: [{
        backgroundColor: barColors,
        data: yValues
        }]
    },
    options: {
        title: {
        display: true,
        text: "Quiz Result"
        }
    }
    });


</script>

<style>
    .card {
        box-shadow: 3px 5px 7px #0B090A;
        border: 0;   
    }

    .center {
        display: block;
        margin-left: auto;
        margin-right: auto;
        width: 80%;
    }
</style>

<?php 
include('std_footer.php');

?>