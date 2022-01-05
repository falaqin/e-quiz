<?php
include("../inc/database.php");

echo $stdID = $_GET['id'];
echo $quizID = $_GET['quiz'];
echo $classID = $_GET['class'];

$conn->query("DELETE FROM student_score WHERE quiz_id = $quizID AND std_id = $stdID");
$conn->query("DELETE FROM student_answer WHERE quiz_id = $quizID AND std_id = $stdID");
/* $result = mysqli_query($conn, $sql) or trigger_error("Query Failed! SQL: $sql - Error: ".mysqli_error($conn), E_USER_ERROR); */

if ($conn->commit()) {
    echo "werks";
    header("Location:std_score.php?id=$quizID&class=$classID");
}
?>

<?php include("lecturer_footer.php") ?>