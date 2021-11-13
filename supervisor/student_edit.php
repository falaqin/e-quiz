<?php
//Import header file
include('sv_header.php');

//Import database connection
include('../inc/database.php');

//get data id
$id=$_GET['id'];

//Check existing data
//SQL statement
$sql_check="SELECT * FROM student WHERE std_id='$id'";

//Query
$query_check=$conn->query($sql_check);

//Get result
$result=mysqli_fetch_assoc($query_check);

//Process to update data
//if button save clicked
if(isset($_POST['save']))
{
    //Receive data from input form
    $p=$_POST;
    $name=$p['name'];
    $matric=$p['matrix'];
    $username=$p['username'];
    $password=md5($p['password']);
    $session=$p['session'];

    //SQL statement
    $sql="UPDATE student SET std_username='$username', std_password='$password', std_name='$name', std_matric='$matric', std_session='$session'
            WHERE std_id='$id'";

    //Check and run query
    if($conn->query($sql))
    {
        //redirect to home page
        header("Location:index.php");
    }
    else
    {
        //if there has any error
        die("SQL error report ".$conn->error);
    }
}
?>

<div class="container bg-gradient text-light">
    <br>
    <h2>Student Form</h2>

    <form method="post" action="">
        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" name="name" class="form-control" value="<?php echo $result['std_name']?>" required>
        </div>

        <div class="form-group">
            <label for="matrix">Matrix No.</label>
            <input type="text" name="matrix" class="form-control"value="<?php echo $result['std_matric']?>"  required>
        </div>

        <div class="form-group">
            <label for="username">Username</label>
            <input type="text" name="username" class="form-control" value="<?php echo $result['std_username'] ?>" required>
        </div>

        <div class="form-group">
            <label for="password">Password</label>
            <input type="password" name="password" class="form-control" value="<?php echo $result['std_password'] ?>" required>
        </div>

        <div class="form-group">
            <label for="session">Session</label>
            <input type="text" name="session" class="form-control" value="<?php echo $result['std_session']?>" required>
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
include('sv_footer.php');
?>