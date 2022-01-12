<?php
include('inc/database.php');
include('std_header.php');

$quizID = $_GET['quizid'];
$sqlCheck = "SELECT s.std_id, ql.id, ql.title, ql.quiz_pw FROM student s, quiz_list ql, student_quiz sq WHERE s.std_id = $SQLstd_id AND s.class_id = sq.class_id AND ql.id = $quizID AND ql.id = sq.quiz_id";
$queryCheck = $conn->query($sqlCheck);
$checkUnique=mysqli_fetch_assoc($queryCheck);

if (isset($_POST['submit'])) {
    $key = $checkUnique['quiz_pw'];
    $keyInput = $_POST['key'];

    if ($keyInput == $key) {
        header("Location:quiz_sheet.php?quizid=$quizID");
    } else {
        $result = "Wrong key!";
    }
}
?>
<title>Quiz Unique Key</title>

<div class="test">
    <div class="login-box">
        <form action="" method="post">
            <h1><?php echo $checkUnique['title']?></h1>
            <br>
            <div class="card shadow">
                <div class="card-header"><h2 style="color: red;"><b>Warning</b></h2></div>
                <div class="card-body">
                    <p>
                        If you <b>navigate to previous page OR refresh</b> while answering the quiz, you can no longer participate in the test, and <b style="color: red;">your marks will be 0</b>.
                    </p>
                </div>
            </div>
            <br>
            <div class="alert alert-primary shadow-sm">A <b>unique key</b> is given by the lecturers for the students to key in inside the textbox below, so they can answer the question.</div>
            <br>
            <div class="form-group">
                    <?php 
                        $sqlToCheckAvail = "SELECT sc.std_points FROM student_score sc LEFT JOIN student_quiz sq ON sc.quiz_id = sq.quiz_id WHERE sc.std_id = $SQLstd_id AND sc.quiz_id = $quizID";
                        $queryAvail = $conn->query($sqlToCheckAvail);
                        $callAvail = mysqli_fetch_assoc($queryAvail);

                        if ($callAvail['std_points'] == '') { ?>
                            <input type="password" name="key" class="form-control" placeholder="Unique Key" value="">
                        <?php } else { ?>
                            <input type="password" name="key" class="form-control" placeholder="You have answered the quiz." value="" disabled>
                        <?php }
                    ?>
                
                <span class="error"><?php echo $result ?></span><br>
                <input type="hidden" name="quizid" value="<?php $quizID ?>">
            </div>
            
            <button type="button" class="btn btn-dark" id="btnback">Back</button>
            <script type="text/javascript">
            document.getElementById("btnback").onclick = function () {
                location.href = "quiz.php";
            };
            </script>
            <input type="submit" value="Enter" name="submit" class="btn btn-primary">
        </form>
    </div>
</div>

<style>
    .test { 
        margin: 0;
        height: 100vh;
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .login-box
    {
        text-align: center;
        width: 450px;
    }

    .form-group
    {
        margin-bottom: 10px;
    }
    
    .error {
        color: red;
    }
</style>