<?php
//import header
include('lecturer_header.php');

//import data cons
include('../inc/database.php');

if ($_GET['page'] == '') {
    $_GET['page'] = 1;
}


$rpp = 7;
//check set page
isset($_GET['page']) ? $page = $_GET['page'] : $page = 0;
//check if page 1
if($page > 1) {
    $start = ($page * $rpp) - $rpp;
} else {
    $start = 0;
}
$sqlClassPage = "SELECT * FROM class";
$queryClassPage = $conn->query($sqlClassPage);
//get total records
$numRows = $queryClassPage->num_rows;
//total number of pages
$totalPages = $numRows / $rpp;

$sqlClass = "SELECT * FROM class LIMIT $start, $rpp";
$queryClass = $conn->query($sqlClass);
?>

<div class="container">
    <br>
    <h2 class="bi bi-folder">
        Class List <a href="class_form.php" class="btn btn-sm btn-primary">Add Class</a>
    </h2>
    <span>Page <?php echo $_GET['page']?></span>
    <div class="table-responsive table-scroll">
        <table class="table table-sm table-light table-striped shadow table-hover table-bordered" style="text-align: center;">
            <thead>
                <tr>
                    <th>Class ID</th>
                    <th>Class Name</th>
                    <th>Total Students</th>
                    <th>Configuration</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($rowClass = mysqli_fetch_assoc($queryClass)) { ?>
                <tr>
                    <td><?php echo $classID = $rowClass['class_id'] ?></td>
                    <td><?php echo $rowClass['class_section'] ?></td>
                    <td>
                        <?php

                        $sql_total_students = "SELECT COUNT(std_id) AS TOTALSTUDENTS FROM student WHERE class_id = ". $classID ."";
                        $query_total_students = $conn->query($sql_total_students);
                        $row_total_students = mysqli_fetch_assoc($query_total_students);
                        echo $row_total_students['TOTALSTUDENTS'];

                        ?>
                    </td>
                    <td>
                        <a href="class_edit.php?id=<?php echo $rowClass['class_id'] ?>" class="btn btn-sm btn-success bi bi-pencil-square"></a>
                        <a 
                            href="javascript:void(0)" 
                            onclick="delete_data('class_delete.php?id=<?php echo $rowClass['class_id']; ?>&page=<?php echo $page ?>')" 
                            class="btn btn-sm btn-danger bi bi-trash">
                        </a>
                    </td>
                </tr>
                <?php } ?>
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
            <li class="page-item <?php if ($_GET['page'] == $i - 1) { echo "disabled"; } ?>">
                <a class="page-link" href="?page=<?php echo $_GET['page'] + 1 ?>"><span aria-hidden="true">&raquo;</span></a>
            </li>
        </ul>
        
    </nav>
        
</div>

<?php
//footer
include('lecturer_footer.php');
?>