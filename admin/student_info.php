<?php
//Import header file
include('admin_header.php');

//Import database connection
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

//SQL statement
$sql="SELECT * FROM student";
//run query
$query=$conn->query($sql);

//get total records
$numRows = $query->num_rows;

//total number of pages
$totalPages = $numRows / $rpp;

//sql statement
$sql2="SELECT * FROM student LIMIT $start, $rpp";
//run query
$query2=$conn->query($sql2);
?>

<div class="container text-light">
    <br>
    <h2>Student Info <a href="std_form.php" class="btn btn-sm btn-primary">Add Student</a></h2>

    <div class="card text-dark" style="width: 500px;">
        <form action="import_process_std.php" method="post" enctype="multipart/form-data" style="width: 500px;">
            <div class="card-header">
                Import Students with CSV
            </div>
            
            <div class="card-body">
                <input type="file" name="file" class="form-control" required> <br>
                <input type="submit" name="saveimport" value="Import" class="btn btn-sm btn-primary">
            </div>
        </form>
    </div>
    <br>

    <table class="table table-dark table-striped">
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
                //initial value no
                $no=1;

                //loop while
                while($row=mysqli_fetch_assoc($query2)):
            ?>

            <tr>
                <td><?php echo $no ?></td>
                <td><?php echo $row['std_name'] ?></td>
                <td><?php echo $row['std_matric'] ?></td>
                <td><?php echo $row['std_session'] ?></td>
                <td>
                    <a href="std_edit.php?id=<?php echo $row['std_id'] ?>">Edit</a>
                    <a href="javascript:void(0)" onclick="delete_data('std_delete.php?id=<?php echo $row['std_id']?>')">Delete</a>
                </td>
            </tr>

            <?php
                //increment no
                $no++;
                //end while
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
//Import footer file
include('admin_footer.php');
?>