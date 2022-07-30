<?php
include('../inc/database.php');

if (isset($_POST['submit'])) {
    /* receive data from form */
    $p=$_POST;
    $title = $p['title'];
    $point=$p['points'];
    $pw=$p['pw'];
    $retake = $p['redo'];
    $timer = $p['timer'];
    $id=$p['lecturer'];
    $active=$p['toggle'];

    // check retake if there's any values or not
    if (!isset($retake)) {
        $retake = 0;
    }

    echo $retake;

    if ($active == '1') {
        /* sql statement */
        $quiz_query = "INSERT INTO quiz_list (title, points, timer, u_id, is_active, quiz_pw, enable_retake_quiz)
        VALUES('$title','$point', '$timer', '$id', '$active', '$pw', '$retake')";

        $quiz_query_run = mysqli_query($conn, $quiz_query);

        if ($quiz_query_run) {
            echo '<script> alert("Data Saved"); </script>';
            header("Location:quiz_list.php");
        } else {
            die("SQL error report ".$conn->error);
        }
    } elseif ($active != '1') {
        $active = '0';

        /* sql statement */
        $quiz_query = "INSERT INTO quiz_list (title, points, timer, u_id, is_active, quiz_pw, enable_retake_quiz)
        VALUES('$title','$point', '$timer', '$id', '$active', '$pw', '$retake')";

        $quiz_query_run = mysqli_query($conn, $quiz_query);

        if ($quiz_query_run) {
            echo '<script> alert("Data Saved"); </script>';
            header("Location:quiz_list.php");
        } else {
            die("SQL error report ".$conn->error);
        }
    }
}
?>