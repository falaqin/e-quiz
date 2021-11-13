<?php
//Import header file
include("admin_header.php");

//Import database connection
include('../inc/database.php');

//SQL statement
$sql="SELECT user.u_id, user_name, COUNT(student.std_id) AS total_student
        FROM user, student
        WHERE user.u_id=student.u_id
        GROUP BY student.u_id";

//Run query
$query=$conn->query($sql);
?>

<div class="container text-light">
    <br>
    
    <h2>Student Statistics by Supervisor</h2>

    <table class="table table-dark table-striped">
        <thead>
            <tr>
                <th>Supervisor</th>
                <th>Total Student</th>
                <th>#</th>
            </tr>
        </thead>
        <tbody>
        <?php
        //for while looping
        while($row=mysqli_fetch_assoc($query)):
        ?>
            <tr>
                <td><?php echo $row['user_name'] ?></td>
                <td><?php echo $row['total_student'] ?></td>
                <td>
                    <a href="student_detail.php?id=<?php echo $row['u_id'] ?>">Detail</a>
                </td>
            </tr>
        <?php
        //endwhile looping
        endwhile;
        ?>
        </tbody>
    </table>
</div>

<?php
//Import footer file
include("admin_footer.php");
?>