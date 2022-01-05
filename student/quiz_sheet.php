<?php
include('inc/database.php');
include('std_header_quizsheet.php');
$quizID = $_GET['quizid'];

$quizSQL = "SELECT * FROM quiz_list ql WHERE ql.id = $quizID";
$queryQuiz = $conn->query($quizSQL);
$callQuiz = mysqli_fetch_assoc($queryQuiz);

$QuestionSQL = "SELECT q.id, q.question, q.question_img, q.question_type FROM question q WHERE q.quiz_id = $quizID";
$queryQuestion = $conn->query($QuestionSQL);

$checkingSQL = "SELECT * FROM student_score sc WHERE sc.std_id = $SQLstd_id AND quiz_id = $quizID";
$queryCheck = $conn->query($checkingSQL);
$callChecking = mysqli_fetch_assoc($queryCheck);

if ($callChecking['id'] == '') {
    $QueryFor_stdScore = "INSERT INTO student_score (quiz_id, std_id, std_points, total_points)
    VALUES ('$quizID','$SQLstd_id','0','0');";
    $RunQuery_stdScore = mysqli_query($conn, $QueryFor_stdScore);
    
} else {
    header("Location:index.php");
}

$scoreID_SQL = "SELECT * FROM student_score WHERE std_id = '$SQLstd_id'";
$scoreIDquery = $conn->query($scoreID_SQL);
$call_scoreID = mysqli_fetch_assoc($scoreIDquery);

?>

<div class="container">
    <br>
    <div class="card bg-danger shadow">
        <div class="card-header text-center text-white">
            <h1>Timer</h1>
        </div>
        <div class="card-body text-center text-white">
            <h2 id="demo"></h2>
            <p>Your answers will be submitted automatically after the timer runs out.</p>
        </div>
    </div>
    <br>
    <form action="quiz_result.php" method="post">
        <input type="hidden" name="student_score_ID" value="<?php echo $call_scoreID['id'] ?>">
    <?php while ($callQuestion = mysqli_fetch_assoc($queryQuestion)): ?>
        <?php if ($callQuestion['question_type'] == 1) { ?>
            <div class="card shadow">
                <?php if ($callQuestion['question_img'] != '') {
                    ?> <img src="../uploads/<?php echo $callQuestion['question_img']; ?>" class="card-img-top center" alt="quiz image" style="max-width: 300px;"> <hr> <?php
                } ?>
                <div class="card-header text-center">
                    <?php
                        $questionID = $callQuestion['id'];
                        echo $callQuestion['question'];
                        
                    ?>
                    <input type="hidden" value="<?php echo $questionID ?>" name="question_id[]">
                </div>
                <div class="card-body">
                    <?php
                    $OptionSQL = "SELECT qo.id, qo.question_id, qo.option_text, qo.option_img, qo.is_right FROM question_option qo WHERE qo.question_id = $questionID";
                    $queryOption = $conn->query($OptionSQL);

                    while ($callOption = mysqli_fetch_assoc($queryOption)):
                    ?>
                    <input type="radio" name="answer<?php echo $questionID?>[]" class="form-check-input" value="<?php echo $callOption['is_right'] ?>">
                    <label class="form-check-label"><?php echo $callOption['option_text']?></label>
                    <br>
                    <?php
                    endwhile;
                    ?>
                    <input type="hidden" value="<?php echo $quizID ?>" name="quizid">
                    <input type="hidden" value="<?php echo $callQuestion['question_type'] ?>" name="question_type[]">
                </div>
            </div>
            <br>
        <?php } else if ($callQuestion['question_type'] == 2) { ?>
            <div class="card shadow">
                <div class="card-header text-center">
                    <?php
                        $questionID = $callQuestion['id'];
                        echo $callQuestion['question'];
                    ?>
                    <input type="hidden" value="<?php echo $questionID ?>" name="question_id[]">
                </div>

                <div class="card-body">
                    <?php
                    $OptionSQL = "SELECT qo.id, qo.question_id, qo.option_text, qo.option_img, qo.is_right FROM question_option qo WHERE qo.question_id = $questionID";
                    $queryOption = $conn->query($OptionSQL);

                    while ($callOption = mysqli_fetch_assoc($queryOption)):
                    ?>
                    <input type="checkbox" name="answer<?php echo $questionID?>[]" class="form-check-input" value="<?php echo $callOption['is_right'] ?>">
                    <img src="../uploads/<?php echo $callOption['option_img'] ?>" alt="<?php echo $callOption['option_img'] ?>" style="max-width: 100px;">

                    <br>
                    <?php
                    endwhile;
                    ?>
                    <input type="hidden" value="<?php echo $quizID ?>" name="quizid">
                    <input type="hidden" value="<?php echo $callQuestion['question_type'] ?>" name="question_type[]">
                </div>
            </div>
            <br>
        <?php } else if ($callQuestion['question_type'] == 3) {
            ?>
            <div class="card shadow">
                <?php if ($callQuestion['question_img'] != '') {
                    ?> <img src="../uploads/<?php echo $callQuestion['question_img']; ?>" class="card-img-top center" alt="quiz image" style="max-width: 300px;"> <hr> <?php
                } ?>
                <div class="card-header text-center">
                    <?php
                        $questionID = $callQuestion['id'];
                        echo $callQuestion['question'];
                    ?>
                    <input type="hidden" value="<?php echo $questionID ?>" name="question_id[]">
                </div>

                <div class="card-body">
                    <?php
                    $OptionSQL = "SELECT qo.id, qo.question_id, qo.option_text, qo.option_img, qo.is_right FROM question_option qo WHERE qo.question_id = $questionID";
                    $queryOption = $conn->query($OptionSQL);
                    ?>
                    <center>
                        <label class="form-label">Select your answers.</label> <br>
                        <select class="answer-selection form-control" name="answer<?php echo $questionID ?>[]" multiple="multiple" style="width: 75%">
                            <?php 
                            while ($callOption = mysqli_fetch_assoc($queryOption)):
                            ?>
                            <option value="<?php echo $callOption['is_right'] ?>"><?php echo $callOption['option_text'] ?></option>
                            <?php
                            endwhile;
                            ?>
                        </select>
                    </center>
                    <br>
                    
                    <input type="hidden" value="<?php echo $quizID ?>" name="quizid">
                    <input type="hidden" value="<?php echo $callQuestion['question_type'] ?>" name="question_type[]">
                </div>
            </div>
            <br>

        <?php } ?>
        <?php endwhile; ?>
        <!-- Button trigger modal -->
        <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
            Submit
        </button>

        <!-- Modal -->
        <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="staticBackdropLabel">Submit</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <p>Are you sure you want to submit the answers?</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No</button>
                        <input type="submit" id="submit" class="btn btn-danger" value="Yes, I want to submit my answers.">
                    </div>
                </div>
        </div>
        </div>
    </form>
    <br>
</div>

<style>
    .card {
        border: 0;   
    }

    .center {
        display: block;
        margin-left: auto;
        margin-right: auto;
        width: 80%;
    }
</style>

<script>
    function confirmAnswer() {
    var conf=confirm('Are you sure you want to submit?');
    if(conf)
    {
        return;
    }
    else
    {
        return false;
    }
}
</script>

<script>
    /* window.onbeforeunload = function () {
        return 'Are you sure you want to leave the site? Doing so will not let you continue your test.';
    } */

    let time = <?php echo $callQuiz['timer'] ?> * 60;

    // Update the count down every 1 second
    var x = setInterval(function() {

        // Output the result in an element with id="demo"
        if(time > 60) document.getElementById("demo").innerHTML = parseInt(time/60) +"m " + time%60 + "s";
        else document.getElementById("demo").innerHTML = time + "s";
        
        //time - 1
        time = time - 1
        
        // If the count down is over, write some text 
        if (time < 0) {
            //stops the timer
            clearInterval(x);
            //to do after timer reaches 0
            alert("Time is up. Your answers will be submitted now.");
            document.getElementById('submit').click();
        }
    }, 1000); //<-- timer refreshes every 1 second

    $(document).ready(function() {
        $('.answer-selection').select2({
            width: 'resolve'
        });
    });
</script>

<?php 
include('std_footer.php')
?>