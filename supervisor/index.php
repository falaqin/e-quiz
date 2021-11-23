<?php
//Import header file
include('sv_header.php');

//Import database connection
include('../inc/database.php');

//SQL statement
$sql="SELECT * FROM student";

//Query
$query=$conn->query($sql);
?>

<div class="container bg-transparent text-light">
    <br>
    <h2>Student Info <a href="student_form.php" class="btn btn-primary btn-sm">Add</a></h2>

    <table class="table table-light table-striped">
        <thead>
            <tr>
                <th>No</th>
                <th>Name</th>
                <th>Matric No.</th>
                <th>Session</th>
                <th>Configuration</th>
            </tr>
        </thead>
        <tbody>
        <?php
        //Initial no
        $no=1;

        //Looping while and get result
        while($row=mysqli_fetch_assoc($query)):
        ?>

            <tr>
                <td><?php echo $no; ?></td>
                <td><?php echo $row['std_name']; ?></td>
                <td><?php echo $row['std_matric']; ?></td>
                <td><?php echo $row['std_session']; ?></td>
                <td>
                    <a href="student_edit.php?id=<?php echo $row['std_id']; ?>">Edit</a>
                    <a href="javascript:void(0)" onclick="delete_data('student_delete.php?id=<?php echo $row['std_id'] ?>')">Delete</a>
                </td>
            </tr>

        <?php
        //Increment no
        $no++;

        //End looping while
        endwhile;
        ?>
        </tbody>
    </table>
</div>

<?php
//Import footer file
include('sv_footer.php');
?>