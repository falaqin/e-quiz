<?php 
//Import header file
include('lecturer_header.php');

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
$sql2="SELECT * FROM student s INNER JOIN class c WHERE c.class_id = s.class_id LIMIT $start, $rpp";
//run query
$query2=$conn->query($sql2);
?>

<div class="container text-light">
    <br>
    <h2 class="bi bi-file-person">
        Student Info <a href="student_form.php" class="btn btn-sm btn-primary">Add Student</a>
    </h2>

    <div class="card text-dark" style="width: inherit;">
        <form action="import.php" method="post" enctype="multipart/form-data">
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

    <div class="table-responsive">
        <table class="table table-light table-striped">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Name</th>
                    <th>Matric No.</th>
                    <th>Class</th>
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
                    <td><?php echo $row['class_section'] ?></td>
                    <td>
                        <a href="student_edit.php?id=<?php echo $row['std_id'] ?>" class="btn btn-sm btn-success bi bi-pencil-square" title="Edit"></a>
                        <a href="javascript:void(0)" onclick="delete_data('student_delete.php?id=<?php echo $row['std_id']?>')" class="btn btn-sm btn-danger bi bi-trash" title="Delete"></a>
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

    </div>
    <nav>
        <ul class="pagination">
            <li class="page-item <?php if ($_GET['page'] <= 1) { echo "disabled"; } ?>">
                <a class="page-link" href="?page=<?php echo $_GET['page'] - 1 ?>"><span aria-hidden="true">&laquo;</span></a>
            </li>
        <?php
        for ($i=1; $i < $totalPages + 1; $i++) { ?>
            <li class="page-item"><a class="page-link" href="?page=<?php echo $i ?>"><?php echo $i ?></a></li>
        <?php } ?>
            <li class="page-item <?php if ($_GET['page'] == $i - 1 or $_GET['page'] == '') { echo "disabled"; } ?>">
                <a class="page-link" href="?page=<?php echo $_GET['page'] + 1 ?>"><span aria-hidden="true">&raquo;</span></a>
            </li>
        </ul>
    </nav>
</div>
<?php
//Import header file
include('lecturer_footer.php');
?>