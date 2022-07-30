<?php
//import header
include("admin_header.php");

//import db con
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
//sql statement
$sql="SELECT * FROM user";
//run query
$query=$conn->query($sql);

//get total records
$numRows = $query->num_rows;

//total number of pages
$totalPages = $numRows / $rpp;

/* $sql2="SELECT * FROM user ORDER BY u_id LIMIT $start, $rpp";
$query2=$conn->query($sql2); */
?>
<title>User Info</title>

<div class="container text-light">
    <br>
    <h2 class="bi bi-file-person">
        User Info <a href="user_form.php" class="btn btn-sm btn-primary">Add User</a>
    </h2>

    <div class="card text-dark" style="width: inherit;">
        <form action="import_process.php" method="post" enctype="multipart/form-data">
            <div class="card-header">
                Import Users with CSV
            </div>
            
            <div class="card-body shadow">
                <input type="file" name="file" class="form-control" required> <br>
                <input type="submit" name="saveimport" value="Import" class="btn btn-sm btn-primary">
                <a href="../assets/user.csv" class="btn btn-sm btn-info" title="User CSV" download>CSV Template Download</a>
            </div>
        </form>
    </div>
    <br>
    <form class="row g-2" method="POST">
        <div class="col-5">
            <input type="text" class="form-control" placeholder="Search name or username" name="search">
        </div>
        <div class="col-auto">
            <div class="btn-group" role="group">
                <input type="submit" class="btn btn-info mb-3 shadow" name="submit" value="Search">
                <a href="user_info.php?page=1" class="btn btn-secondary mb-3 shadow">Show All</a>
            </div>
        </div>
    </form>
    <span>Page <?php echo $_GET['page']?></span>
    <div class="table-responsive table-scroll" style="max-height: 700px;">
        <table class="table table-dark table-striped text-light shadow table-bordered table-hover">
            <thead>
                <tr>
                    <th>Staff ID</th>
                    <th>Name</th>
                    <th>Username</th>
                    <th>Access Level</th>
                    <th>Configuration</th>
                </tr>
            </thead>
            <tbody>

                <?php
                    if(isset($_POST['submit'])):
                        $qsearch = $_POST['search'];
                        $sql2 = "SELECT * FROM user WHERE user_name LIKE '%$qsearch%' OR u_username LIKE '%$qsearch%'";
                    else:
                        $sql2="SELECT * FROM user ORDER BY u_id LIMIT $start, $rpp";;
                    endif;
                    $query2 = $conn->query($sql2); 
                    //set val for number of access lvl
                    $access[1]='Admin';
                    $access[2]='Teacher';

                    //initiate num
                    $no=1;
                        //loop (while) data from query
                        while($row=mysqli_fetch_assoc($query2)):
                            $level=$row['u_access_lvl'];
                ?>

                <tr>
                    <td>
                        <?php
                        echo $row['u_id'];
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
                        echo $access[$level];
                        ?>
                    </td>
                    <td>
                        <?php if ($level == 2): ?>
                        <a href="user_edit.php?id=<?php echo $row['u_id'] ?>" class="btn btn-sm btn-success bi bi-pencil-square" title="Edit"></a>
                        <a href="javascript:void(0)" onclick="delete_data('user_delete.php?id=<?php echo $row['u_id']?>')" class="btn btn-sm btn-danger bi bi-trash" title="Delete"></a>
                        <?php else: ?>
                        <a href="user_edit.php?id=<?php echo $row['u_id'] ?>" class="btn btn-sm btn-success bi bi-pencil-square disabled" title="Edit"></a>
                        <a href="javascript:void(0)" onclick="delete_data('user_delete.php?id=<?php echo $row['u_id']?>')" class="btn btn-sm btn-danger bi bi-trash disabled" title="Delete"></a>
                        <?php endif; ?>
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
    <?php if (!(isset($_POST['submit']))): ?>
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
//import footer
include("admin_footer.php");
?>