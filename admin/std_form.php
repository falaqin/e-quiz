<?php
//Import header file
include('admin_header.php');

//Import database connection
include('../inc/database.php');

//if button save clicked
if(isset($_POST['save']))
{
    //Receive data from input form
    $p=$_POST;
    $password=md5($p['password']);
    $username=$p['username'];
    $name=$p['name'];
    $matrix_no=$p['matric'];
    $session=$p['session'];
    //$u_id=$user_id; //from session $_SESSION['user_id']

    //SQL statement
    $sql="INSERT INTO student(std_username,std_password,std_name,std_matric,std_session)
            VALUES('$username','$password','$name','$matrix_no','$session')";

    //Check and run query
    if($conn->query($sql))
    {
        //Redirect to home page
        header("Location:student_info.php");
    }
    else
    {
        //if there has any error
        die('SQL report error '.$conn->error);
    }
}
?>

<div class="container bg-gradient text-light">
    <br>
    <h2>Student Form</h2>

    <form method="post" action="">
        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" name="name" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="matrix">Matrix No.</label>
            <input type="text" name="matric" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="username">Username</label>
            <input type="text" class="form-control" name="username" required>
        </div>

        <div class="form-group">
            <label for="password">Password</label>
            <input type="password" class="form-control" name="password" required>
        </div>

        <div class="form-group">
            <label for="session">Session</label>
            <input type="text" name="session" class="form-control" required>
        </div>

        <input type="submit" name="save" value="Save" class="btn btn-primary">
    </form>

</div>

<style>
    .form-group
    {
        margin-bottom: 10px;
    }
</style>

<?php
//Import footer file
include('admin_footer.php');
?>