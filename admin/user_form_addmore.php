<?php
//import header
include('admin_header.php');

//import data cons
include('../inc/database.php');

$_SESSION["amountuser"] = $i;

//if button save clicked
if(isset($_POST['save']))
{
    //receive data from input
    $p=$_POST;
    $name=($p['name']);
    $username=$p['username'];
    $password=md5($p['password']); //encrypt password
    $access_level=$p['access_level'];

    //run sql
    /* if possible do $name[$number] then do for loop to insert data more than 1 */
    $sql="INSERT INTO user(user_name, u_username, u_password, u_access_lvl)
    VALUES ('$name', '$username', '$password', '$access_level')";

    //if sql statement no error
    if($conn->query($sql))
    {
        //redirect to user page
        /* header("Location:user_form.php"); */
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
        User Form <input type="submit" name="addmore" id="" class="btn btn-sm btn-success" value="Add More">
    </h2>

    <p> <?php echo "The number value is " . $i?> (testing purposes)</p>
    <div class="container text-light row">
        <form method="post" action="" style="width: 530px;">
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" name="name" id="" class="form-control" required>
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
                    <option value="2">Lecturer</option>
                </select>
            </div>

            <div>
                <a href="user_info.php" class="btn btn-secondary">Back</a>
                <input type="submit" name="addmore" id="" class="btn btn-success" value="Add More">
                <input type="submit" name="save" id="" class="btn btn-primary">
            </div>
        </form>
    </div>
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