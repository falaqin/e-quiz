<?php
//Import header file
include('admin_header.php');

//Import database connection
include('../inc/database.php');

//Get supervisor id
$id=$_GET['id'];

//Get data from table supervisor
//SQL statement
$sql_supervisor="SELECT * FROM user WHERE u_id='$id'";

//Query
$query_supervisor=$conn->query($sql_supervisor);

//Result
$res=mysqli_fetch_assoc($query_supervisor);


//Display student info that related to supervisor id
//SQL statement
$sql="SELECT * FROM student WHERE u_id='$id'";

//Query
$query=$conn->query($sql);
?>

<div class="container bg-gradient text-light">
    <br>
    <h2>Student Detail <a href="index.php" class="btn btn-primary btn-sm">Back</a></h2>
    <h6>Supervisor : <?php echo $res['user_name'] ?></h6>

    <table class="table text-light">
        <thead>
            <tr>
                <th>No</th>
                <th>Name</th>
                <th>Matric No.</th>
                <th>Session</th>
            </tr>
        </thead>
        <tbody>
        <?php
        //initial value no
        $no=1;

        //Looping (while)
        while($row=mysqli_fetch_assoc($query)):
        ?>

            <tr>
                <td><?php echo $no;?></td>
                <td><?php echo $row['std_name']?></td>
                <td><?php echo $row['std_matric'] ?></td>
                <td><?php echo $row['std_session'] ?></td>
            </tr>

        <?php
        // Increment no
        $no++;

        //end while
        endwhile;
        ?>
        </tbody>
    </table>
</div>

<?php
//Import footer file
include('admin_footer.php');
?>