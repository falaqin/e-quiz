<?php
include('admin_header.php');

//db conns
include('../inc/database.php');

//get id
$id=$_GET['id'];

//get existing data
//sql statement to check existing data
$sql_check="SELECT * FROM student WHERE std_id='$id'";

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
    $name = $p['name'];
    $username=$p['username'];
    $matric = $p['matric'];
    $session = $p['session'];

    //sql statement
    $sql="UPDATE student
    SET std_username='$username', std_name='$name', std_session='$session'
    WHERE std_id='$id'";
    //if query no error
    if($conn->query($sql))
    {
        //redirect to userphp page
        header("Location:student_info.php");
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
        Student Form <a href="student_info.php" class="btn btn-sm btn-secondary">Back</a>
    </h2>

    <form method="post" action="">
        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" name="name" id="" class="form-control" value="<?php echo $rslt['std_name'] ?>" required>
        </div>

        <div class="form-group">
            <label for="matric">Matric Number</label>
            <input type="text" name="matric" class="form-control" value="<?php echo $rslt['std_matric'] ?>">
        </div>

        <div class="form-group">
            <label for="username">Username</label>
            <input type="text" name="username" id="" class="form-control" value="<?php echo $rslt['std_username'] ?>" required>
        </div>

        <div class="form-group">
            <label for="Session">Session</label>
            <input type="text" name="session" class="form-control" value="<?php echo $rslt['std_session'] ?>">
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