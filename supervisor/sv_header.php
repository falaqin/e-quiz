<?php
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
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <title>E-QUIZ System (EQS)</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet">
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
    </head>

    <body class="bg-dark">
        
        <nav class="navbar navbar-expand-lg navbar-dark bg-gradient">
            <div class="container-fluid">
                <a class="navbar-brand" href="index.php">
                    <img src="../assets/logo_equiz_no_text.png" style="width:50px; margin-left: 10px;">
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav">
                        <li class="nav-item active">
                            <a class="nav-link" href="index.php">Home</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" href="quiz_list.php">Quiz List</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" href="quiz_report.php">Quiz Report</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" href="logout.php">Logout</a>
                        </li>                   
                    </ul>
                </div>
            </div>
        </nav>
        