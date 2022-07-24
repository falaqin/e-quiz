<?php
include('../inc/database.php');
include('std_header.php');

$quizSQL = "SELECT s.std_id, s.class_id, ql.id AS quiz_id, sq.id, ql.title, ql.quiz_pw, u.user_name, ql.is_active, 
ql.timer FROM student_quiz sq INNER JOIN student s, quiz_list ql, user u
WHERE sq.class_id = $classID 
AND s.std_id = $SQLstd_id 
AND ql.id = sq.quiz_id 
AND u.u_id = ql.u_id 
AND sq.class_id = s.class_id
ORDER BY ql.date_updated DESC";
$quizQuery = $conn->query($quizSQL);
?>
<title>Student Quiz Page</title>

<div class="container">
    <br>
    <h1>Answer your quiz here!</h1>
    <br>
    <div class="table-responsive" style="max-height: 500px;">
        <table class="table table-striped table-hover shadow table-bordered">
            <thead>
                <tr>
                    <th scope="col">No</th>
                    <th scope="col">Title</th>
                    <th scope="col">Created by</th>
                    <th scope="col">Time to answer</th>
                    <th scope="col">Total questions</th>
                    <th scope="col"></th>
                </tr>
            </thead>
            <tbody>
                <?php
                $no = 0;
                    while ($callQuiz = mysqli_fetch_assoc($quizQuery)):
                        $no++;
                ?>
                <tr>
                    <th scope="row"><?php echo $no; ?></th>
                    <td><?php echo $callQuiz['title']; ?></td>
                    <td><?php echo $callQuiz['user_name']; ?></td>
                    <td><?php echo $callQuiz['timer'] . " minutes" ?></td>
                    <td>
                        <?php 
                        $quiz_id = $callQuiz['quiz_id'];
                        $sql_total_quiz = "SELECT COUNT(id) AS TOTALQUESTION FROM question WHERE quiz_id = ". $quiz_id ."";
                        $query_total_quiz = $conn->query($sql_total_quiz);
                        $row_total_quiz = mysqli_fetch_assoc($query_total_quiz);
                        echo $row_total_quiz['TOTALQUESTION'];
                        ?>
                    </td>
                    <td>
                        <center>
                        <?php
                        if ($callQuiz['is_active'] == '0') {
                            ?> <a href="" class="btn btn-sm btn-danger disabled">Disabled</a> <?php
                        } else {
                            $quizid1 = $callQuiz['quiz_id'];
                            $sqlToCheckAvail = "SELECT sc.std_points FROM student_score sc LEFT JOIN student_quiz sq ON sc.quiz_id = sq.quiz_id WHERE sc.std_id = $SQLstd_id AND sc.quiz_id = $quizid1";
                            $queryAvail = $conn->query($sqlToCheckAvail);

                            // check if query return true or false boolean
                            $queryReturnStatus = mysqli_connect_errno($queryAvail);

                            if ($queryReturnStatus) {
                                $callAvail = mysqli_fetch_assoc($queryAvail);
                            }

                            if (isset($callAvail['std_points'])) {
                                if ($callAvail['std_points'] == '') { ?>
                                    <a href="quiz_check_unique.php?quizid=<?php echo $callQuiz['quiz_id'] ?>" class="btn btn-sm btn-success">Start</a>
                                <?php } else { ?>
                                    <a href="quiz_check_unique.php?quizid=<?php echo $callQuiz['quiz_id'] ?>" class="btn btn-sm btn-danger disabled">Answered</a>
                                <?php }
                            } else { ?>
                                <a href="quiz_check_unique.php?quizid=<?php echo $callQuiz['quiz_id'] ?>" class="btn btn-sm btn-success">Start</a>
                            <?php }
                        }
                        ?>
                        </center>
                    </td>
                </tr>
                <?php
                endwhile;
                ?>
            </tbody>
        </table>
    </div>
    <br>
</div>

<div class="fixed-bottom">
<?php
include('std_footer.php');
?>
</div>