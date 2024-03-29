<?php
//start session
session_start(); 
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <link rel="icon" href="assets/logo_equiz_no_text_smallest.png">  
        <title>E-QUIZ Student Login</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet">
    </head>

    <body>

    <?php 
    //initial value for login_error and user
    $login_error='';
    $user='';

    //if submit button is clicked
    if(isset($_POST['submit']))
    {
        //Receive data from INPUT
        $p=$_POST;
        $user=$p['user'];
        $pass=md5($p['pass']); //encrypt pass with md5

        //import db con
        include('inc/database.php');

        //sql statement
        $sql="SELECT * FROM student WHERE std_username='$user' AND std_password='$pass'";

        //query the sql
        $query=$conn->query($sql);

        //get result from query
        $result=mysqli_fetch_assoc($query);

        if($result) //if data exists
        {
            $_SESSION['student_id']=$result['std_id'];
            header("Location:student");
        }
        else //no data
        {
            //set message to loginerror
            $login_error='<div style="color:red;">Invalid Username or Password </div>';
        }
    }
    ?>
    
        <!-- create login form -->
        <div class="login-box">
            <div>
                <img src="assets/logo_equiz_edit.png" alt="" style="width: 200px;">
                <form action="" method="post">
                    <div class="form-group">
                        <input type="text" name="user" class="form-control" placeholder="IC Number" value="">
                    </div>

                    <div class="form-group">
                        <input type="password" name="pass" class="form-control" placeholder="Password" value="">
                    </div>

                    <input type="submit" value="Login" name="submit" class="btn btn-primary">
                    <button type="button" class="btn btn-dark" id="btnback">Back</button>
                    <script type="text/javascript">
                    document.getElementById("btnback").onclick = function () {
                        location.href = "index.php";
                    };
                    </script>
                    <?php
                        echo $login_error;
                    ?>
                </form>
            </div>
        </div>
    </body>
</html>

<style>
    body { 
        margin: 0;
        height: 100vh;
        display: flex;
        justify-content: center;
        align-items: center;
        background-color: grey;
    }

    .login-box
    {
        text-align: center;
        width: 450px;
    }

    .form-group
    {
        margin-bottom: 10px;
    }

    .btn-primary, .btn-primary:hover, .btn-primary:active, .btn-primary:visited {
        max-width: 50%;
        border-radius: 50px !important;
        background-color: #683aa4 !important;
    }

    .btn {
        max-width: 50%;
        border-radius: 50px !important;
    }
</style>