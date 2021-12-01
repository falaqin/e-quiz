<?php
//import header
include("admin_header.php");

//import db con
include('../inc/database.php');

//sql statement
$sql="SELECT * FROM quiz_list ORDER BY title ASC";

//run query
$query=$conn->query($sql);
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

    <table class="table table-dark table-striped">
        <thead>
            <tr>
                <th>No</th>
                <th>Title Quiz</th>
                <th>Total questions</th>
                <th>Assigned To</th>
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
                while ($row=mysqli_fetch_assoc($query)):
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
    <br>
</div>

<?php
include("admin_footer.php");
?>