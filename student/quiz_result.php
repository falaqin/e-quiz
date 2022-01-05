<?php
include('inc/database.php');
include('std_header.php');

$quizID = $_POST['quizid'];
$questionID_test = $_POST['question_id'];
$questionType_test = $_POST['question_type'];
$scoreID = $_POST['student_score_ID'];

$sqlPoint = "SELECT ql.points FROM quiz_list ql WHERE ql.id = $quizID";
$queryPoint = $conn->query($sqlPoint);
$callPoint = mysqli_fetch_assoc($queryPoint);
$point = $callPoint['points'];

$totalQuestion = count($questionID_test);
$answerForDB = array();


for ($i=0; $i < $totalQuestion; $i++) { 
    $whichQuestion = $questionID_test[$i];
    $answerArray = $_POST["answer" . $questionID_test[$i]];
    $type = $_POST["question_type"];

    if ($type[$i] == 1) {
        

        if (empty($answerArray)) {
            $unanswered++;
            $actualMark += $point;
            $answer = 0;
            $answerForDB[$i] = $answer;
        } else {
            $answer = $answerArray[0];

            if ($answer == 0) {
                $incorrect++;
                $actualMark += $point;
                $answerForDB[$i] = $answer;
            } elseif ($answer == 1) {
                $correct++;
                $rightanswer = $answer * $point;
                $total += $rightanswer;
                $actualMark += $point;
                $answerForDB[$i] = $answer;
            }
        }

        
    } elseif ($type[$i] == 2) {
        $sqlOption = "SELECT is_right FROM question_option WHERE question_id = '$whichQuestion' AND is_right = '1'";
        $queryRight = $conn->query($sqlOption);

        while ($callRight = mysqli_fetch_assoc($queryRight)) {
            $Type2TotalFromDB += $callRight['is_right'];
        }

        if (empty($answerArray)) {
            $unanswered++;
            $actualMark += $point;
            $answer = 0;
            $answerForDB[$i] = $answer;
        } else {
            $answer = array_sum($answerArray);

            if ($answer == $Type2TotalFromDB) {
                $correct++;
                $rightanswer = 1 * $point;
                $total += $rightanswer;
                $actualMark += $point;
                $answerForDB[$i] = 1;
            } elseif ($answer <> $Type2TotalFromDB) {
                $incorrect++;
                $actualMark += $point;
                $answerForDB[$i] = 0;
            }
        }

    } elseif ($type[$i] == 3) {
        $sqlOption = "SELECT is_right FROM question_option WHERE question_id = '$whichQuestion' AND is_right = '1'";
        $queryRight = $conn->query($sqlOption);

        while ($callRight = mysqli_fetch_assoc($queryRight)) {
            $Type3TotalFromDB += $callRight['is_right'];
        }

        if (empty($answerArray)) {
            $unanswered++;
            $actualMark += $point;
            $answer = 0;
            $answerForDB[$i] = $answer;
        } else {
            $answer = array_sum($answerArray);

            if ($answer == $Type2TotalFromDB) {
                $correct++;
                $rightanswer = 1 * $point;
                $total += $rightanswer;
                $actualMark += $point;
                $answerForDB[$i] = 1;
            } elseif ($answer <> $Type2TotalFromDB) {
                $incorrect++;
                $actualMark += $point;
                $answerForDB[$i] = 0;
            }
        }

        
    }
}

if ($total == '') {
    $total = 0;
}

if ($actualMark == '') {
    $actualMark = 0;
}

if ($correct == '') {
    $correct = 0;
}

if ($incorrect == '') {
    $incorrect = 0;
}

if ($unanswered == '') {
    $unanswered = 0;
}

for ($i=0; $i < $totalQuestion; $i++) { 
    $QueryFor_stdAnswer = "INSERT INTO student_answer (std_id, quiz_id, question_id, is_right)
    VALUES ('$SQLstd_id','$quizID','$questionID_test[$i]','$answerForDB[$i]')";

    $RunQuery_stdAnswer = mysqli_query($conn, $QueryFor_stdAnswer);
} 

if ($RunQuery_stdAnswer) {

    $QueryFor_stdScore = "UPDATE student_score
    SET std_points = '$total', total_points = '$actualMark'
    WHERE id = '$scoreID'";

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