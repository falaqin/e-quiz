<?php
//Import header file
include('admin_header.php');

//Import database connection
include('../inc/database.php');

if ($_GET['page'] == '') {
    $_GET['page'] = 1;
}

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
?>
<title>Student Info</title>

<div class="container text-light">
    <br>
    <h2 class="bi bi-file-person">
        Student Info <a href="std_form.php" class="btn btn-sm btn-primary">Add Student</a>
    </h2>

    <div class="card text-dark shadow" style="width: inherit;">
        <form action="import_process_std.php" method="post" enctype="multipart/form-data">
            <div class="card-header">
                Import Students with CSV
            </div>
            
            <div class="card-body">
                <input type="file" name="file" class="form-control" required> <br>
                <input type="submit" name="saveimport" value="Import" class="btn btn-sm btn-primary">
                <a href="../assets/student.csv" class="btn btn-sm btn-info" title="Student CSV" download>CSV Template Download</a>
            </div>
        </form>
    </div>
    <br>
    <form class="row g-2" method="POST">
        <div class="col-5">
            <input type="text" class="form-control" placeholder="Search name or class" name="search">
        </div>
        <div class="col-auto">
            <div class="btn-group" role="group">
                <input type="submit" class="btn btn-warning mb-3 shadow" name="submit" value="Search by Name">
                <input type="submit" class="btn btn-info mb-3 shadow" name="submitclass" value="Search by Class">
            </div>
            <a href="student_info.php?page=1" class="btn btn-secondary mb-3 shadow">Show All</a>
        </div>
    </form>
    <span>Page <?php echo $_GET['page']?></span>

    <div class="table-responsive table-scroll" style="max-height: 700px;">
        <table class="table table-dark table-striped table-bordered shadow table-hover">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>IC No.</th>
                    <th>Class</th>
                    <th>Session</th>
                    <th>Configuration</th>
                </tr>
            </thead>

            <tbody>
                <?php

                    if(isset($_POST['submit'])):
                        $qsearch = $_POST['search'];
                        $sql2 = "SELECT * FROM student s INNER JOIN class c WHERE c.class_id = s.class_id AND s.std_name LIKE '%$qsearch%'";
                    else:
                        $sql2="SELECT * FROM student s INNER JOIN class c WHERE c.class_id = s.class_id ORDER BY s.std_id LIMIT $start, $rpp";;
                    endif;
                    
                    if(isset($_POST['submitclass'])):
                        $qsearch = $_POST['search'];
                        $sql2 = "SELECT * FROM student s INNER JOIN class c WHERE c.class_id = s.class_id AND c.class_section = '$qsearch'";  
                    endif;
                    
                    $query2 = $conn->query($sql2); 
                    //initial value no
                    $no=1;

                    //loop while
                    while($row=mysqli_fetch_assoc($query2)):
                ?>

                <tr>
                    <td><?php echo $row['std_id'] ?></td>
                    <td><?php echo $row['std_name'] ?></td>
                    <td><?php echo $row['std_matric'] ?></td>
                    <td><?php echo $row['std_session'] ?></td>
                    <td><?php echo $row['class_section'] ?></td>
                    <td>
                        <a href="std_edit.php?id=<?php echo $row['std_id'] ?>" class="btn btn-sm btn-success bi bi-pencil-square" title="Edit"></a>
                        <a href="javascript:void(0)" onclick="delete_data('std_delete.php?id=<?php echo $row['std_id']?>')" class="btn btn-sm btn-danger bi bi-trash" title="Delete"></a>
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
    <?php if (!(isset($_POST['submit'])) and !(isset($_POST['submitclass']))): ?>
        <nav>
            <ul class="pagination">
                <li class="page-item <?php if ($_GET['page'] <= 1) { echo "disabled"; }?>">
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
    <?php endif ?>
</div>

<?php
//Import footer file
include('admin_footer.php');
?>