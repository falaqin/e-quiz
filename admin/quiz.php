<?php
//import header
include("admin_header.php");

//import db con
include('../inc/database.php');

$rpp = 8;
//check set page
isset($_GET['page']) ? $page = $_GET['page'] : $page = 0;
//check if page 1
if($page > 1) {
    $start = ($page * $rpp) - $rpp;
} else {
    $start = 0;
}
//SQL statement
$sql="SELECT * FROM quiz_list";
//run query
$query=$conn->query($sql);

//get total records
$numRows = $query->num_rows;

//total number of pages
$totalPages = $numRows / $rpp;

//sql statement
$sql2="SELECT * FROM quiz_list ORDER BY date_updated DESC";

//run query
$query2=$conn->query($sql2);
?>
<title>Quiz Details</title>

<style>
    .form-group
    {
        margin-bottom: 10px;
    }
</style>

<br>
<div class="container text-light">
    <h1 class="bi bi-bar-chart-fill"> Reports <h4>Quiz Details</h4></h1>
    <a href="reports.php" class="btn btn-outline-primary text-light shadow">Quiz Results</a>
    <a href="quiz.php" class="btn btn-outline-info text-light shadow disabled">Quiz Detail</a>
    <a href="summary_report.php" class="btn btn-outline-primary text-light shadow">Summary PDF</a>
    <br><br>
    <div class="table-responsive table-scroll">
        <table class="table table-dark table-striped table-bordered shadow table-hover">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Title Quiz</th>
                    <th>Created By</th>
                    <th>View Detail</th>
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
                    <td><?php echo $row['id'] ?></td>
                    <td><?php echo $row['title'] ?></td>
                    <td>
                        <?php 
                        $userid = $row['u_id'];
                        $sql_name = 'SELECT user_name FROM user WHERE u_id=' . $userid . '';
                        $query_name=$conn->query($sql_name);
                        $row_name = mysqli_fetch_assoc($query_name);
                        echo $row_name['user_name'];
                        ?>
                    </td>


                    <td>
                        <a href="view_quiz.php?id=<?php echo $row['id']; ?>" class="btn btn-sm btn-success bi bi-eye-fill"></a>
                        
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
include('admin_footer.php');
?>
</div>