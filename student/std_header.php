<?php
//start session
session_start();

include('../inc/database.php');

//if session not found
if(!isset($_SESSION['student_id']))     
{
    header("Location:../studentlogin.php");
}
else
{
    $SQLstd_id=$_SESSION['student_id'];
}

$sql = "SELECT * FROM student WHERE std_id = $SQLstd_id";
$query=$conn->query($sql);

?>

<!DOCTYPE html>
<html lang="en">
    <head>
    <meta charset="utf-8">
        <link rel="icon" href="../assets/logo_equiz_no_text_smallest.png">  
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" />
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.2.0/dist/select2-bootstrap-5-theme.min.css" />
        <script src="../assets/jquery.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>        
    </head>

    <body>
        <nav class="navbar navbar-expand-lg navbar-light bg-light shadow">
            <div class="container-fluid">
                <a class="navbar-brand" href="index.php">
                    <img src="../assets/logo_equiz_no_text.png" alt="logo" style="width: 50px; margin-left: 10px;">
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">

                        <li class="nav-item">
                            <a class="nav-link" href="index.php">Home</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" href="quiz.php">Quiz</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" href="history.php">History</a>
                        </li>
                    </ul>

                    <span class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" role="button" data-bs-toggle="dropdown"><?php
                            if ($call=mysqli_fetch_assoc($query)) {
                                echo "Welcome, ".$call['std_name'].".";
                                $classID = $call['class_id'];
                            }
                            ?>
                        </a>
                        <ul class="dropdown-menu">
                            <li>
                                <a href="logout.php" class="dropdown-item">Logout</a>
                            </li>
                        </ul>
                    </span>
                </div>
            </div>
        </nav>
        