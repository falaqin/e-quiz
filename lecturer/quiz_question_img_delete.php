<?php
include("../inc/database.php");

$questionID = $_GET['questionid'];
$quizID = $_GET['quiz_id'];

$SQLoption = "SELECT * FROM question_option WHERE question_id = $questionID";
$queryOption = $conn->query($SQLoption);

while ($callOption = mysqli_fetch_assoc($queryOption)) {
    $id[] = $callOption['id'];
}

$a = 0;
while ($a <= 4) {
    echo $a;
    $sql = "SELECT * FROM question_option WHERE id = $id[$a]";
    $query=$conn->query($sql);
    $row=mysqli_fetch_assoc($query);

    $dir = "../uploads/";
    $file = $row['option_img'];

    unlink($dir . $file);

    $a++;
}

//SQL statement
$conn->query("DELETE FROM question WHERE id = ".$questionID);
$conn->query("DELETE FROM question_option WHERE quiz_id = ".$questionID);

//Check and run query
if($conn->commit())
{
    //redirect to home page
    header("Location:quiz_manage.php?id=$quizID");
}
else
{
    die("SQL error report ".$conn->error);
}
?>