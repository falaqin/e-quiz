<?php
include("../inc/database.php");
include("admin_header.php");

$quizID = $_GET['id'];

$sql="SELECT * FROM quiz_list WHERE id = $quizID";
$query=$conn->query($sql);
$callQuiz = mysqli_fetch_assoc($query);

$active[0] = 'Inactive';
$active[1] = 'Active';
?>
<title>Quiz View</title>
<br>
<div class="container">
    <div class="card shadow">
        <div class="card-header">
            <h2><?php echo $callQuiz['title'] ?></h2>
        </div>
        <div class="card-body">
            <div class="mb-3">
                <label class="form-label">Created By</label>
                <h5>
                    <?php
                        $userid = $callQuiz['u_id'];
                        $sql_name = 'SELECT user_name FROM user WHERE u_id=' . $userid . '';
                        $query_name=$conn->query($sql_name);
                        $row_name = mysqli_fetch_assoc($query_name);
                        echo $row_name['user_name'];
                    ?>
                </h5>
            </div>
            <div class="mb-3">
                <label class="form-label">Total Questions</label>
                <h5>
                    <?php
                        $sql_total_quiz = "SELECT COUNT(id) AS TOTALQUESTION FROM question WHERE quiz_id = ". $quizID ."";
                        $query_total_quiz = $conn->query($sql_total_quiz);
                        $row_total_quiz = mysqli_fetch_assoc($query_total_quiz);
                        echo $row_total_quiz['TOTALQUESTION'] . " in total";
                    ?>
                </h5>
            </div>
            <div class="mb-3">
                <label class="form-label">Time to Answer Quiz</label>
                <h5><?php echo $callQuiz['timer']?> Minutes</h5>
            </div>
            <div class="mb-3">
                <label class="form-label">Classes Assigned</label>
                <h5>
                    <?php
                        $SQL_ForClasses = "SELECT c.class_section FROM `quiz_list` ql JOIN student_quiz sq, class c WHERE ql.id = sq.quiz_id AND sq.class_id = c.class_id AND ql.id = $quizID";
                        $queryClasses = $conn->query($SQL_ForClasses);
                        while ($ClassesRow = mysqli_fetch_assoc($queryClasses)):
                        echo $ClassesRow['class_section'] . "<br>";
                        endwhile;
                    ?>
                </h5>
            </div>
            <div class="mb-3">
                <label class="form-label">Status</label>
                <h5><?php echo $active[$callQuiz['is_active']] ?></h5>
            </div>
            <div class="mb-3">
                <label class="form-label">Time/Date Created</label>
                <h5><?php echo $callQuiz['date_updated']?></h5>
            </div>
            <p>
                <a href="quiz.php" class="btn btn-primary shadow">Back</a>
            </p>
        </div>
    </div>
</div>

<style>
    .container {
        max-width: 600px;
        margin: 0 auto;
    }
</style>
<?php
include("admin_footer.php")
?>