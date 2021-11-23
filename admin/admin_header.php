<?php
date_default_timezone_set("Asia/Kuala_Lumpur");
//start session
session_start();

//if session not found
if(!isset($_SESSION['user_id']))
{
    header('Location:../adminlogin.php');
}

include('../inc/database.php');

//sql statement
$sql="SELECT * FROM user WHERE u_id = " . $_SESSION['user_id'] . " ";

//run query
$query=$conn->query($sql);

//add variable for query to call
$call=mysqli_fetch_assoc($query)
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <title>E-QUIZ System (EQS)</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="stylish.css">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet">
        <link href="css/bootstrap-switch/bootstrap-switch.css" rel="stylesheet">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js"></script>
        <script>
        function delete_data(url)
        {
            var conf=confirm('Are you sure you want to delete?');
            if(conf)
            {
                window.location=url;
            }
            else
            {
                return false;
            }
        }
        </script>
        <script src = "assets/js/bootstrap.min.js"></script>
        <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js" crossorigin="anonymous"></script>
        <script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>
    </head>
    
    <style>
        .bg-style {
            background-color: #C77DFF;
        }
    </style>

    <body class="bg-dark">
    <!-- navbar here -->
    <nav class="navbar navbar-expand-lg navbar-light bg-style">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">
                <img src="../assets/logo_equiz_no_text.png" style="width:50px; margin-left: 10px;">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarText">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item active">
                        <a class="nav-link" href="index.php">Home</a>
                    </li>

                    <li class="nav-item active">
                        <a class="nav-link" href="user_info.php">User Info</a>
                    </li>

                    <li>
                        <a class="nav-link" href="student_info.php">Students Info</a>
                    </li>

                    <li>
                        <a class="nav-link" href="quiz.php">Quiz List</a>
                    </li>

                    <li>
                        <a class="nav-link" href="">Reports</a>
                    </li>

                    <li>
                        <a class="nav-link" href="admin_debug.php">debug</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="logout.php">Logout</a>
                    </li>
                </ul>
                <span class="navbar-text">
                    <?php echo "Welcome, ".$call['user_name'] ?>
                </span>
            </div>
        </div>
    </nav>
        