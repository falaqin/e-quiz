<?php
//import header
include("lecturer_header.php");

//import db con
include('../inc/database.php');

//get user id
$lecid = $_SESSION['user_id'];

if ($_GET['page'] == '') {
    $_GET['page'] = 1;
}

$rpp = 10;
//check set page
isset($_GET['page']) ? $page = $_GET['page'] : $page = 0;
//check if page 1
if($page > 1) {
    $start = ($page * $rpp) - $rpp;
} else {
    $start = 0;
}

//sql statement
$sql="SELECT * FROM quiz_list WHERE u_id = $lecid ORDER BY id ASC";

//run query
$query=$conn->query($sql);

//get total records
$numRows = $query->num_rows;

//total number of pages
$totalPages = $numRows / $rpp;

//sql statement
$sql2="SELECT * FROM quiz_list WHERE u_id = $lecid ORDER BY id ASC LIMIT $start, $rpp";
//run query
$query2=$conn->query($sql2);
?>
<title>Quiz List</title>
<style>
    .form-group
    {
        margin-bottom: 10px;
    }
</style>


<div class="container">
    <br>
    <h2>Quiz List
        <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#addquiz">
            Add Quiz
        </button>
    </h2>

    <div class="modal fade text-light" id="addquiz" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog bg-dark">
            <div class="modal-content bg-dark">
                <div class="modal-header bg-dark">
                    <h5 class="modal-title" id="exampleModalLabel">Add Quiz</h5>
                    <button type="button" class="btn-close text-light" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <form action="insert_quiz_title.php" method="post">
                    <div class="modal-body">    
                        <div class="form-group">
                            <label for="title">Quiz Title</label>
                            <input type="text" name="title" class="form-control" required>
                        </div>

                        <div class="form-group">
                            <label for="points">Points per question</label>
                            <input type="number" name="points" min="1" max="10" class="form-control" required>
                        </div>

                        <div class="form-group">
                            <label for="timer">Timer in minutes</label>
                            <input type="number" name="timer" min="5" max="30" class="form-control" required>
                        </div>

                        <div class="form-group">
                            <label for="pw">Unique Key</label>
                            <input type="password" name="pw" class="form-control" required>
                        </div>
                        
                        <div class="form-group">
                            <input type="hidden" name="lecturer" value="<?php echo $lecid ?>">
                        </div>
                        <br>
                        <div class="form-group">
                            <input type="checkbox" class="btn-check" id="btn-check-outlined" autocomplete="off" value="1" name="toggle">
                            <label class="btn btn-outline-warning" for="btn-check-outlined">Toggle to make quiz available for students.</label>
                        </div>
                    </div>

                    <div class="modal-footer bg-dark">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Exit</button>
                        <input type="submit" class="btn btn-primary" name="submit" value="Save Quiz"></input>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <span>Page <?php echo $_GET['page']?></span>
    <div class="table-responsive table-scroll">
        <table class="table table-light table-striped shadow table-hover table-bordered">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Title Quiz</th>
                    <th>Total questions</th>
                    <th>Created By</th>
                    <th>Time to Answer</th>
                    <th>Status</th>
                    <th>Configuration</th>
                </tr>
            </thead>

            <tbody>
                <tr>
                    <?php 
                    $active[0] = 'Inactive';
                    $active[1] = 'Active';

                    $no=0;
                    while ($row=mysqli_fetch_assoc($query2)):
                        $no++;
                    ?>
                    <td><?php echo $no ?></td>
                    <td><?php echo $row['title'] ?></td>
                    <td>
                        <?php 
                        $quiz_id = $row['id'];
                        $sql_total_quiz = "SELECT COUNT(id) AS TOTALQUESTION FROM question WHERE quiz_id = ". $quiz_id ."";
                        $query_total_quiz = $conn->query($sql_total_quiz);
                        $row_total_quiz = mysqli_fetch_assoc($query_total_quiz);
                        echo $row_total_quiz['TOTALQUESTION'];
                        ?>
                    </td>
                    <td>
                        <?php 
                        $userid = $row['u_id'];
                        $sql_name = 'SELECT user_name FROM user WHERE u_id=' . $userid . '';
                        $query_name=$conn->query($sql_name);
                        $row_name = mysqli_fetch_assoc($query_name);
                        echo $row_name['user_name'];
                        ?>
                    </td>
                    
                    <td><?php echo $row['timer'] . " Minutes" ?></td>

                    <td>
                        <a href="quiz_activate.php?id=<?php echo $row['id'] ?>&act=<?php echo $row['is_active'] ?>" class="btn btn-sm btn-warning"><?php echo $active[$row['is_active']] ?></a>
                    </td>
                    
                    <td>
                        <a href="quiz_manage.php?id=<?php echo $row['id'] ?>" class="btn btn-sm btn-info bi bi-file-earmark-plus" title="Manage"></a>
                        <a href="quiz_edit.php?id=<?php echo $row['id'] ?>" class="btn btn-sm btn-success bi bi-pencil-square" title="Edit"></a>
                        <a href="javascript:void(0)" onclick="delete_data('quiz_delete.php?id=<?php echo $row['id']?>')" class="btn btn-sm btn-danger bi bi-trash" title="Delete"></a>
                    </td>
                </tr>

                <?php 
                endwhile;
                ?>

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
    <br>
</div>

<div class="fixed-bottom">
<?php
include("lecturer_footer.php");
?>
</div>