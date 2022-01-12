<?php 
include("../inc/database.php");
include("lecturer_header.php");

$rpp = 5;
//check set page
isset($_GET['page']) ? $page = $_GET['page'] : $page = 0;
//check if page 1
if($page > 1) {
    $start = ($page * $rpp) - $rpp;
} else {
    $start = 0;
}
//sql statement
$sql="SELECT ql.id, ql.title, ql.date_updated, u.user_name AS created_by, c.class_section AS std_class, c.class_id FROM `quiz_list` ql JOIN user u, student_quiz sq, class c WHERE ql.u_id = u.u_id AND ql.id = sq.quiz_id AND sq.class_id = c.class_id AND ql.u_id = $user_id";
//run query
$query=$conn->query($sql);
//get total records
$numRows = $query->num_rows;
//total number of pages
$totalPages = $numRows / $rpp;


$SQLforQuizBasedOnClass = "SELECT ql.id, ql.title, ql.date_updated, u.user_name AS created_by, c.class_section AS std_class, c.class_id FROM `quiz_list` ql JOIN user u, student_quiz sq, class c WHERE ql.u_id = u.u_id AND ql.id = sq.quiz_id AND sq.class_id = c.class_id AND ql.u_id = $user_id LIMIT $start, $rpp";
$QueryQBOC = $conn->query($SQLforQuizBasedOnClass);
?>
<title>Quiz Reports</title>
<br>
<div class="container text-dark">
    <h1 class="bi bi-bar-chart-fill"> Reports <h4>Quiz Results</h4></h1>
    <a href="summary_report.php?id=<?php echo $user_id ?>" class="btn btn-outline-primary shadow">Your Summary PDF</a>
    <br>
    <br>
    <div class="alert alert-primary shadow" role="alert">
        If the button is disabled, it means no one has answered the question.
    </div>
    <div class="table-responsive table-scroll">
        <table class="table table-light text-dark table-striped shadow table-bordered table-hover">
            <thead style="background-color: #002d72;">
                <tr>
                    <th>Quiz Title</th>
                    <th>Date Updated</th>
                    <th>Created By</th>
                    <th>Classes</th>
                    <th>See Results</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($callQBOC = mysqli_fetch_assoc($QueryQBOC)): ?>
                <tr>
                    <td><?php echo $callQBOC['title'] ?></td>
                    <td><?php echo $callQBOC['date_updated'] ?></td>
                    <td><?php echo $callQBOC['created_by'] ?></td>
                    <td><?php echo $callQBOC['std_class'] ?></td>
                    <td>
                        <?php
                            $SQL_DisableIfNoAnswer = "SELECT sc.std_points FROM student_quiz sq JOIN student_score sc, student s WHERE sq.quiz_id = sc.quiz_id AND s.std_id = sc.std_id AND sq.class_id = s.class_id AND sq.class_id = " . $callQBOC['class_id'] . " AND sq.quiz_id = ". $callQBOC['id'] ."";
                            $queryDisableIfNoAnswer = $conn->query($SQL_DisableIfNoAnswer);
                            $callDisable = mysqli_fetch_assoc($queryDisableIfNoAnswer);

                            if ($callDisable['std_points'] == ''): ?>
                            <a href="std_score.php?id=<?php echo $callQBOC['id'] ?>&class=<?php echo $callQBOC['class_id'] ?>" class="btn btn-sm btn-danger bi bi-eye-slash disabled shadow"></a>
                            <?php else: ?>
                                <a href="std_score.php?id=<?php echo $callQBOC['id'] ?>&class=<?php echo $callQBOC['class_id'] ?>" class="btn btn-sm btn-info bi bi-eye shadow"></a>
                            <?php endif; ?>

                    </td>
                </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>
    <nav>
        <ul class="pagination">
            <li class="page-item <?php if ($_GET['page'] <= 1) { echo "disabled"; } ?>">
                <a class="page-link" href="?page=<?php echo $_GET['page'] - 1 ?>"><span aria-hidden="true">&laquo;</span></a>
            </li>
        <?php
        for ($i=1; $i < $totalPages + 1; $i++) { ?>
            <li class="page-item"><a class="page-link" href="?page=<?php echo $i ?>"><?php echo $i ?></a></li>
        <?php } ?>
            <li class="page-item <?php if ($_GET['page'] == $i - 1 or $_GET['page'] == '') { echo "disabled"; } ?>">
                <a class="page-link" href="?page=<?php echo $_GET['page'] + 1 ?>"><span aria-hidden="true">&raquo;</span></a>
            </li>
        </ul>
    </nav>
</div>

<div class="fixed-bottom">
<?php
include("lecturer_footer.php");
?>
</div>