<?php
include('inc/database.php');
include('std_header.php');

$quizSQL = "SELECT s.std_id, ql.id AS quiz_id, sq.id, ql.title, ql.quiz_pw, u.user_name, ql.is_active FROM student_quiz sq INNER JOIN student s, quiz_list ql, user u WHERE sq.std_id = $SQLstd_id AND ql.id = sq.quiz_id AND u.u_id = ql.u_id AND sq.std_id = s.std_id";
$quizQuery = $conn->query($quizSQL);
?>

<div class="container">
    <br>
    <table class="table table-striped table-hover">
        <thead>
            <tr>
                <th scope="col">No</th>
                <th scope="col">Title</th>
                <th scope="col">Created by</th>
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
                <td>
                    <?php 
                    if ($callQuiz['is_active'] == '0') {
                        ?> <a href="" class="btn btn-sm btn-danger disabled">Disabled</a> <?php
                    } else {
                        ?> <a href="quiz_check_unique.php?quizid=<?php echo $callQuiz['quiz_id'] ?>" class="btn btn-sm btn-success">Start</a> <?php
                    }
                    ?>
                </td>
            </tr>
            <?php
            endwhile;
            ?>
        </tbody>
    </table>
</div>

<?php
include('std_footer.php');
?>