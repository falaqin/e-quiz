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

//update process
//if button click save
if(isset($_POST['save']))
{
    //receive data from input
    $p=$_POST;
    $name=$p['name'];
    $staff_no=$p['staff_no'];
    $username=$p['username'];
    $password=md5($p['password']);
    $access_level=$p['access_level'];

    //sql statement
    $sql="UPDATE user
    SET user_name='$name', user_staffno='$staff_no', u_username='$username', u_password='$password',u_access_lvl='$access_level'
    WHERE u_id='$id'";
    //if query no error
    if($conn->query($sql))
    {
        //redirect to userphp page
        header("Location:user_info.php");
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
        User Form <a href="index.php" class="btn btn-sm btn-secondary">Back</a>
    </h2>

    <form method="post" action="">
        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" name="name" id="" class="form-control" value="<?php echo $rslt['user_name'] ?>" required>
        </div>

        <div class="form-group">
            <label for="staff_no">Staff No</label>
            <input type="text" name="staff_no" id="" class="form-control" value="<?php echo $rslt['user_staffno'] ?>" required>
        </div>

        <div class="form-group">
            <label for="username">Username</label>
            <input type="text" name="username" id="" class="form-control" value="<?php echo $rslt['u_username'] ?>" required>
        </div>

        <div class="form-group">
            <label for="password">Password</label>
            <input type="password" name="password" id="" class="form-control" value="<?php echo $rslt['u_password'] ?>" required>
        </div>

        <div class="form-group">
            <label for="access_level">Access Level</label>
            <select name="access_level" id="access_level" class="form-control" required>
                <option value="1">Admin</option>
                <option value="2" <?php if($rslt['u_access_lvl']==2) {echo ' selected=selected"';} ?> >Supervisor</option>
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