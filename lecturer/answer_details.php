<?php 
include("../inc/database.php");
include("lecturer_header.php");

$quizID = $_GET['quiz'];
$class = $_GET['class'];
$stdID = $_GET['id'];

$sql="SELECT * FROM quiz_list WHERE id = $quizID";
$query=$conn->query($sql);
$callQuiz = mysqli_fetch_assoc($query);

$sql2 = "SELECT * FROM `student_answer` sa INNER JOIN question q WHERE q.id = sa.question_id AND sa.std_id = $stdID AND q.quiz_id = $quizID";
$query2 = $conn->query($sql2);
?>
<br>
<div class="container">
    <div class="card shadow">
        <div class="card-header">
            <h2><?php echo $callQuiz['title'] ?></h2>
        </div>
        <div class="card-body">
            <div class="mb-3">
                <label class="form-label">Answered By:</label>
                <h5>
                    <?php
                        $sql_name = 'SELECT std_name FROM student WHERE std_id =' . $stdID . '';
                        $query_name=$conn->query($sql_name);
                        $row_name = mysqli_fetch_assoc($query_name);
                        echo $name = $row_name['std_name'];
                    ?>
                </h5>
            </div>

            <div class="table-responsive table-scroll shadow">
                <table class="table table-striped mb-0">
                    <thead style="background-color: #002d72;" class="text-light">
                        <tr>
                            <th scope="col">Question</th>
                            <th scope="col">Question Type</th>
                            <th scope="col">Answer (Right/False)</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $answer[0]='Incorrect';
                        $answer[1]='Correct';

                        $type[1]='Selection';
                        $type[2]='Image';
                        $type[3]='Combo';
                        while ($callResult = mysqli_fetch_assoc($query2)):
                        ?>
                        <tr>
                            <td><?php echo $callResult['question'] ?></td>
                            <td><?php echo $type[$callResult['question_type']] ?></td>
                            <td><?php echo $answer[$callResult['is_right']] ?></td>
                        </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            </div>
            <br>
            <div class="mb-3">
                <label class="form-label">Score received:</label>
                <h5>
                    <?php
                        $sql_marks = 'SELECT * FROM student_score WHERE std_id =' . $stdID . ' AND quiz_id = ' . $quizID . '';
                        $query_marks=$conn->query($sql_marks);
                        $stdMarks = mysqli_fetch_assoc($query_marks);
                        echo $stdMarks['std_points'] . " out of " . $stdMarks['total_points'];
                    ?>
                </h5>
            </div>

            <br>

            <p>
                <a href="std_score.php?id=<?php echo $quizID ?>&class=<?php echo $class ?>" class="btn btn-primary shadow">Back</a>
            </p>
        </div>
    </div>
</div>

<style>
    .container {
        max-width: 1236px;
        margin: 0 auto;
    }
</style>
<?php
include("lecturer_footer.php");
?>