<?php
//header
include('sv_header.php');

//db con
include('../inc/database.php');

//sql
$sql = "SELECT * FROM quiz_list WHERE u_id = $user_id ORDER BY title ASC";

//query
$query=$conn->query($sql);

//get total count of questions from table question
//$sql2 = "SELECT question, COUNT(question) AS total_question FROM `questions` WHERE qid = '". $row['quiz_id'] ."'";
//get result
//$res=$conn->query($sql2);
?>

<div class="container text-light bg-gradient">
    <br>
    <h2>
        Quiz List <a href="quiz_add.php" class="btn btn-sm btn-primary">Add Quiz</a></h2>
    </h2>

    <table class="table text-light">
        <thead>
            <tr>
                <th>No</th>
                <th>Title</th>
                <th>Amount of Questions</th>
                <th>Lecturer </th>
                <th>Configuration</th>
            </tr>
        </thead>
        <tbody>
            <?php 
            $no=1;
            //$row2 = mysqli_fetch_assoc($res);
            while($row=mysqli_fetch_assoc($query)):
            ?>
            <tr>
                <td><?php echo $no ?></td>
                <td><?php echo $row['title'] ?></td>
                <td>Test</td>
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
                    <a href="quiz_manage.php?id=<?php echo $row['id'] ?>">Manage</a>
                    <a href="quiz_edit.php?id=<?php echo $row['id'] ?>">Edit</a>
                </td>
            </tr>

            <?php
                //increment variable no
                $no++;

                //end while loop
                    endwhile;
            ?>
        </tbody>
    </table>
</div>

<?php include("sv_footer.php") ?>