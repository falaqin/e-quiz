<?php
//import header
include('admin_header.php');

//import data cons
include('../inc/database.php');

//if button save clicked
if(isset($_POST['save']))
{
    //receive data from input
    $p=$_POST;
    $name=$p['name'];
    $staff_no=$p['staff_no'];
    $username=$p['username'];
    $password=md5($p['password']); //encrypt password
    $access_level=$p['access_level'];

    //run sql
    $sql="INSERT INTO user(user_name, user_staffno, u_username, u_password, u_access_lvl)
    VALUES ('$name', '$staff_no', '$username', '$password', '$access_level')";

    //if sql statement no error
    if($conn->query($sql))
    {
        //redirect to user page
        header("Location:user.php");
    }
    else
    {
        //if theres error
        die("SQL error report ".$conn->error);
    }

}
?>

<div class="container bg-gradient text-light">
    <br>
    <h2>
        User Form <a href="user.php" class="btn btn-sm btn-secondary">Back</a>
    </h2>

    <form method="post" action="">
        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" name="name" id="" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="staff_no">Staff No</label>
            <input type="text" name="staff_no" id="" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="username">Username</label>
            <input type="text" name="username" id="" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="password">Password</label>
            <input type="password" name="password" id="" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="access_level">Access Level</label>
            <select name="access_level" id="access_level" class="form-control" required>
                <option value="">Please Choose</option>
                <option value="1">Admin</option>
                <option value="2">Supervisor</option>
            </select>
        </div>

        <div>
            <input type="submit" name="save" id="" class="btn btn-primary">
        </div>
    </form>
</div>

<style>
        .form-group
    {
        margin-bottom: 10px;
    }
</style>

<?php
//footer
include('admin_footer.php');
?>