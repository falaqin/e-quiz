<?php
//Import header file
include('admin_header.php');

//Import database connection
include('../inc/database.php');

//SQL statement
$sql="SELECT * FROM student ORDER BY std_name ASC";

//run query
$query=$conn->query($sql);

//sql statement for supervisor
$sql_supervisor="SELECT * FROM user ORDER BY user_name ASC";

//run supervisor query
$query_supervisor=$conn->query($sql_supervisor);
?>

<div class="container text-light">
    <br>
    <h2>Student Info</h2>

    <table class="table table-dark table-striped">
        <thead>
            <tr>
                <th>No</th>
                <th>Name</th>
                <th>Matric No.</th>
                <th>Session</th>
                <th>Supervisor</th>
            </tr>
        </thead>

        <tbody>
            <?php
                //initial value no
                $no=1;

                //loop while
                while($row=mysqli_fetch_assoc($query)):
            ?>

            <tr>
                <td><?php echo $no ?></td>
                <td><?php echo $row['std_name'] ?></td>
                <td><?php echo $row['std_matric'] ?></td>
                <td><?php echo $row['std_session'] ?></td>
                <td><?php echo $row['u_id'] ?></td>
            </tr>

            <?php
                //increment no
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