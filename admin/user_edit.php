<?php
include('admin_header.php');

//db conns
include('../inc/database.php');

//get id
$id=$_GET['id'];

//get existing data
//sql statement to check existing data
$sql_check="SELECT * FROM user WHERE u_id='$id'";

//query sql statement
$query_check=$conn->query($sql_check);

//get result
$rslt=mysqli_fetch_assoc($query_check);

?>

<div class="container bg-gradient text-light">
    <br>
    <h2>
        User Form <a href="user_info.php" class="btn btn-sm btn-secondary">Back</a>
    </h2>

    <form method="post" action="user_edit_submit.php">

        <div class="form-group">
            <input type="hidden" name="userid" value="<?php echo $id ?>">
        </div>

        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" name="name" id="" class="form-control" value="<?php echo $rslt['user_name'] ?>" required>
        </div>

        <div class="form-group">
            <label for="username">Username</label>
            <input type="text" name="username" id="" class="form-control" value="<?php echo $rslt['u_username'] ?>" required>
        </div>

        <div class="form-group">
            <label for="access_level">Access Level</label>
            <select name="access_level" id="access_level" class="form-control" required>
                <option value="1">Admin</option>
                <option value="2" <?php if($rslt['u_access_lvl']==2) {echo ' selected=selected"';} ?> >Lecturer</option>
            </select>
        </div>

        <div>
            <input type="submit" name="save" class="btn btn-primary">
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