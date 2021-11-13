<?php
//header
include('sv_header.php');

//db con
include('../inc/database.php');

//sql
$sql = "SELECT * FROM `quiz_list` ORDER BY quiz_id;";

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
                <th>Config</th>
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
                <td><?php echo $row['quiz_title'] ?></td>
                <td><?php echo 'Placeholder' ?></td>
                <td>
                    <a href="quiz_manage.php?id=<?php echo $row['quiz_id'] ?>">Manage</a>
                    <a href="quiz_edit.php?id=<?php echo $row['quiz_id'] ?>">Edit</a>
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