<?php
date_default_timezone_set("Asia/Kuala_Lumpur");

//start session
session_start();

//if session not found
if(!isset($_SESSION['user_id']))
{
    header('Location:../adminlogin.php');
}
else
{
    $user_id=$_SESSION['user_id'];
}

include('../inc/database.php');

//sql statement
$sql="SELECT * FROM user WHERE u_id = " . $_SESSION['user_id'] . " ";

//run query
$query=$conn->query($sql);

//add variable for query to call
$call=mysqli_fetch_assoc($query);
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <link rel="icon" href="../assets/logo_equiz_no_text_smallest.png">  
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" />
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.2.0/dist/select2-bootstrap-5-theme.min.css" />
        <script src="../assets/jquery-3.4.1.min.js"></script>
        <script src="../assets/jquery-3.4.1.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>        
        
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

        <style>
            .bg-style {
                background-color: #B7B7A4;
            }

            html,
            body,
            .intro {
            height: 100%;
            }

            table td,
            table th {
            text-overflow: ellipsis;
            white-space: nowrap;
            overflow: hidden;
            }

            .card {
            border-radius: .5rem;
            }

            .table-scroll {
            border-radius: .5rem;
            }

            .table-scroll table thead th {
            font-size: 1.25rem;
            }
        </style>
    </head>

    <body class="bg-dark">
    <!-- navbar here -->
    <nav class="navbar navbar-expand-lg navbar-light bg-style shadow-lg">
        <div class="container-fluid">
            <a class="navbar-brand" href="index.php">
                <img src="../assets/logo_equiz_no_text.png" style="width:50px; margin-left: 10px;">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarText" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarText">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item active">
                        <a class="nav-link" href="index.php">Home</a>
                    </li>

                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Students
                        </a>
                        <ul class="dropdown-menu dropdown-menu-dark">
                            <li>
                                <a class="dropdown-item" href="student_info.php">Students Info</a>
                                <a class="dropdown-item" href="student_form.php">Add new Student</a>
                            </li>
                        </ul>
                    </li>

                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Class
                        </a>
                        <ul class="dropdown-menu dropdown-menu-dark">
                            <li>
                                <a class="dropdown-item" href="class_info.php">Classes Info</a>
                                <a class="dropdown-item" href="class_form.php">Add new Class</a>
                            </li>
                        </ul>
                    </li>

                    <li class="nav-item active">
                        <a class="nav-link" href="quiz_list.php">Quiz List</a>
                    </li>

                    <li class="nav-item active">
                        <a class="nav-link" href="reports.php">Reports</a>
                    </li>
                </ul>

                <span class="navbar-text">
                    <?php echo "Welcome, ".$call['user_name']. "." ?>
                </span>
                
                <span class="navbar-text">
                    <a class="nav-link" style="color: #0B3142;" href="logout.php">Logout</a>
                </span>
            </div>
        </div>
    </nav>
        