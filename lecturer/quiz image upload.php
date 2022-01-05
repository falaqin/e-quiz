<?php
include("../inc/database.php");

$quizid = $_POST['id'];
$type = $_POST['type'];

if ($_POST['iscorrect1'] == '') {
    $answer1 = 0;
} else {
    $answer1 = 1;
}

if ($_POST['iscorrect2'] == '') {
    $answer2 = 0;
} else {
    $answer2 = 1;
}

if ($_POST['iscorrect3'] == '') {
    $answer3 = 0;
} else {
    $answer3 = 1;
}

if ($_POST['iscorrect4'] == '') {
    $answer4 = 0;
} else {
    $answer4 = 1;
}

if ($_POST['iscorrect5'] == '') {
    $answer5 = 0;
} else {
    $answer5 = 1;
}

$questiontxt = $_POST['question'];

$filename1 = rand(1000,10000)."-".$_FILES["image1"]["name"];
$tempname1 = $_FILES["image1"]["tmp_name"];
$filename2 = rand(1000,10000)."-".$_FILES["image2"]["name"];
$tempname2 = $_FILES["image2"]["tmp_name"];
$filename3 = rand(1000,10000)."-".$_FILES["image3"]["name"];
$tempname3 = $_FILES["image3"]["tmp_name"];
$filename4 = rand(1000,10000)."-".$_FILES["image4"]["name"];
$tempname4 = $_FILES["image4"]["tmp_name"];
$filename5 = rand(1000,10000)."-".$_FILES["image5"]["name"];
$tempname5 = $_FILES["image5"]["tmp_name"];

$folder = "../uploads/";

$conn->query("INSERT INTO question(question, quiz_id, question_type) VALUES ('$questiontxt','$quizid','$type')");
$questionid = $conn->insert_id;

if (move_uploaded_file($tempname1, "$folder/$filename1"))  {
    $conn->query("INSERT INTO question_option (option_img, question_id, is_right) VALUES ('$filename1', '$questionid', '$answer1')");
    echo $msg = "Image question uploaded successfully to folder and database";
}

if (move_uploaded_file($tempname2, "$folder/$filename2"))  {
    $conn->query("INSERT INTO question_option (option_img, question_id, is_right) VALUES ('$filename2', '$questionid', '$answer2')");
    echo $msg = "Image question uploaded successfully to folder and database";
}

if (move_uploaded_file($tempname3, "$folder/$filename3"))  {
    $conn->query("INSERT INTO question_option (option_img, question_id, is_right) VALUES ('$filename3', '$questionid', '$answer3')");
    echo $msg = "Image question uploaded successfully to folder and database";
}

if (move_uploaded_file($tempname4, "$folder/$filename4"))  {
    $conn->query("INSERT INTO question_option (option_img, question_id, is_right) VALUES ('$filename4', '$questionid', '$answer4')");
    echo $msg = "Image question uploaded successfully to folder and database";
}

if (move_uploaded_file($tempname5, "$folder/$filename5"))  {
    $conn->query("INSERT INTO question_option (option_img, question_id, is_right) VALUES ('$filename5', '$questionid', '$answer5')");
    echo $msg = "Image question uploaded successfully to folder and database";
}

if ($conn->commit()) {
    header("Location: quiz_manage.php?id=$quizid");
}
?>