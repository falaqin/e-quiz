<?php
//import header
include("admin_header.php");

//import db con
include('../inc/database.php');

$rpp = 10;
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
$sql2="SELECT * FROM quiz_list ORDER BY date_updated ASC";

//run query
$query2=$conn->query($sql2);
?>

<style>
    .form-group
    {
        margin-bottom: 10px;
    }
</style>


<div class="container text-light">
    <br>
    <h2>Quiz List
    </h2>

    <div class="table-responsive">
        <table class="table table-dark table-striped">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Title Quiz</th>
                    <th>Total questions</th>
                    <th>Created By</th>
                    <th>Status</th>
                    <th>Unique Key</th>
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

                    <td>
                        <?php echo $active[$row['is_active']] ?>
                    </td>

                    <td>
                        <?php echo md5($row['quiz_pw']); ?>
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

<?php
include("admin_footer.php");
?>