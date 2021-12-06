<?php
include('inc/database.php');
include('std_header.php');

$quizID = $_GET['quizid'];
$sqlCheck = "SELECT s.std_id, ql.id, ql.title, ql.quiz_pw FROM student s, quiz_list ql, student_quiz sq WHERE s.std_id = $SQLstd_id AND s.std_id = sq.std_id AND ql.id = $quizID AND ql.id = sq.quiz_id";
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

<div class="test">
    <div class="login-box">
        <form action="" method="post">
            <h1><?php echo $checkUnique['title']?></h1>
            <div class="form-group">
                <input type="password" name="key" class="form-control" placeholder="Unique Key" value="">
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