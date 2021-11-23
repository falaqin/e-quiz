<?php
include('admin_header.php');

//db cons
include('../inc/database.php');

//get id
$id = $_GET['id'];

//get existing data
//sql statement to check existing data
$sql_check="SELECT * FROM quiz_list WHERE id='$id'";

//query sql statement
$query_check = $conn->query($sql_check);

//get result
$rslt = mysqli_fetch_assoc($query_check);

//update process
//if button click save
if(isset($_POST['save'])) {
    //receive data
    $p = $_POST;
    $title = $p['title'];
    $points = $p['points'];
    $assigned = $p['lecturer'];
    $status = $p['active'];

    //sql
    $sql = "UPDATE quiz_list
    SET title='$title', points='$points', u_id='$assigned', is_active='$status'
    WHERE id='$id'";

    if($conn->query($sql))
    {
        //redirect to userphp page
        header("Location:quiz.php");
    }
    else
    {
        //if error
        die("SQL error report ".$conn->error);
    }
}
?>

<div class="container bg-gradient text-light">
    <br>
    <h2>
        Edit Quiz <a href="quiz.php" class="btn btn-sm btn-secondary">Back</a>
    </h2>

    <form method="post">
        <div class="form-group">
            <label for="title">Title</label>
            <input type="text" name="title" id="" class="form-control" value="<?php echo $rslt['title'] ?>" required>
        </div>

        <div class="form-group">
            <label for="points">Points per question</label>
            <input type="text" name="points" class="form-control" value="<?php echo $rslt['points']?>">
        </div>

        <div class="form-group">
            <label for="lecturer">Lecturer</label>
            <select name="lecturer" id="lecturer" class="form-control" required>
                <option value="" selected="" disabled="">Select Here</option>
                <?php 
                $qry = $conn->query("SELECT * FROM user WHERE u_access_lvl = 2 ORDER BY user_name ASC");
                while($row_user = $qry->fetch_assoc()) {
                ?>
                <option value="<?php echo $row_user['u_id'] ?>"><?php echo $row_user['user_name'] ?></option>
                <?php }?>
            </select>
        </div>

        <div class="form-group">
            <label for="active">Quiz Status</label>
            <select name="active" id="active" class="form-control" required>
                <option value="" selected="" disabled="">Select Here</option>
                <option value="0">Disable</option>
                <option value="1">Enable</option>
            </select>
        </div>

        <div>
            <input type="submit" name="save" id="" class="btn btn-primary">
        </div>
    </form>
</div>

<style>
    .form-group {
        padding-bottom: 15px;
    }
</style>

<?php
include('admin_footer.php');
?>