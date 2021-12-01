<?php
//import header
include("lecturer_header.php");

//import db con
include('../inc/database.php');

//get user id
$lecid = $_SESSION['user_id'];

//sql statement
$sql="SELECT * FROM quiz_list WHERE u_id = $lecid ORDER BY date_updated ASC";

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
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addquiz">
            Add Quiz
        </button>
    </h2>

    <div class="modal fade bg-dark" id="addquiz" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog bg-dark">
            <div class="modal-content bg-dark">
                <div class="modal-header bg-dark">
                    <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <form action="insert_quiz_title.php" method="post">
                    <div class="modal-body">    
                        <div class="form-group">
                            <label for="title">Quiz Title</label>
                            <input type="text" name="title" class="form-control" required>
                        </div>

                        <div class="form-group">
                            <label for="class">Class</label>
                            <input type="text" name="class" class="form-control" required>
                        </div>

                        <div class="form-group">
                            <label for="points">Points per question</label>
                            <input type="number" name="points" min="1" max="10" class="form-control" required>
                        </div>

                        <div class="form-group">
                            <label for="pw">Unique Key</label>
                            <input type="text" name="pw" class="form-control" required>
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
    <table class="table table-light table-striped">
        <thead>
            <tr>
                <th>No</th>
                <th>Title Quiz</th>
                <th>Total questions</th>
                <th>Assigned To</th>
                <th>Status</th>
                <th>Unique Key</th>
                <th>Configuration</th>
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
                    <?php echo $row['quiz_pw']; ?>
                </td>

                <td>
                    <a href="quiz_edit.php?id=<?php echo $row['id'] ?>">Edit</a>
                    <a href="quiz_manage.php?id=<?php echo $row['id'] ?>">Manage</a>
                    <a href="javascript:void(0)" onclick="delete_data('quiz_delete.php?id=<?php echo $row['id']?>')">Delete</a>
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
include("lecturer_footer.php");
?>