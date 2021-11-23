<?php
//import header
include("admin_header.php");

//import db con
include('../inc/database.php');

//sql statement
$sql="SELECT * FROM user ORDER BY user_name ASC";

//run query
$query=$conn->query($sql);
?>

<div class="container text-light">
    <br>
    <h2>
        User Info <a href="user_form.php" class="btn btn-sm btn-primary">Add User</a>
    </h2>

    <table class="table table-dark table-striped text-light">
        <thead>
            <tr>
                <th>No</th>
                <th>Name</th>
                <th>Username</th>
                <th>Staff ID</th>
                <th>Access Level</th>
                <th>Configuration</th>
            </tr>
        </thead>
        <tbody>

            <?php
                //set val for number of access lvl
                $access[1]='Admin';
                $access[2]='Lecturer';

                //initiate num
                $no=1;
                    //loop (while) data from query
                    while($row=mysqli_fetch_assoc($query)):
                        $level=$row['u_access_lvl'];
            ?>

            <tr>
                <td>
                    <?php
                    echo $no;
                    ?>
                </td>
                <td>
                    <?php
                    echo $row['user_name'];
                    ?>
                </td>
                <td>
                    <?php
                    echo $row['u_username'];
                    ?>
                </td>
                <td>
                    <?php 
                    echo $row['u_id'];
                    ?>
                </td>
                <td>
                    <?php
                    echo $access[$level];
                    ?>
                </td>
                <td>
                    <a href="user_edit.php?id=<?php echo $row['u_id'] ?>">Edit</a>
                    <a href="javascript:void(0)" onclick="delete_data('user_delete.php?id=<?php echo $row['u_id']?>')">Delete</a>
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

<?php
//import footer
include("admin_footer.php");
?>