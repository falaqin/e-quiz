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
//sql statement
$sql="SELECT * FROM user";
//run query
$query=$conn->query($sql);

//get total records
$numRows = $query->num_rows;

//total number of pages
$totalPages = $numRows / $rpp;

//sql statement
$sql2="SELECT * FROM user ORDER BY date_updated LIMIT $start, $rpp";
//run query
$query2=$conn->query($sql2);
?>

<div class="container text-light">
    <br>
    <h2>
        User Info <a href="user_form.php" class="btn btn-sm btn-primary">Add User</a>
    </h2>

    <div class="card text-dark" style="width: 500px;">
        <form action="import_process.php" method="post" enctype="multipart/form-data" style="width: 500px;">
            <div class="card-header">
                Import Users with CSV
            </div>
            
            <div class="card-body">
                <input type="file" name="file" class="form-control" required> <br>
                <input type="submit" name="saveimport" value="Import" class="btn btn-sm btn-primary">
            </div>
        </form>
    </div>

    <br>
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
                    while($row=mysqli_fetch_assoc($query2)):
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
    
    <?php
        for ($i=1; $i < $totalPages + 1; $i++) { 
            echo "<a class='btn btn-primary btn-sm' href='?page=$i'>$i</a> ";
        }
    ?>
</div>

<?php
//import footer
include("admin_footer.php");
?>