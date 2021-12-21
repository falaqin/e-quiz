<?php 
include("../inc/database.php");

//get other variables for question table
$quizid = $_POST['quizid'];
$questiontxt = $_POST['question'];
$answer1 = $_POST['answer1'];
$answer2 = $_POST['answer2'];
$answer3 = $_POST['answer3'];
$answer4 = $_POST['answer4'];

$isc1 = $_POST['iscorrect'][0];
if ($isc1 != 1) {
    $isc1 = 0;
}
$isc2 = $_POST['iscorrect'][1];
if ($isc2 != 1) {
    $isc2 = 0;
}
$isc3 = $_POST['iscorrect'][2];
if ($isc3 != 1) {
    $isc3 = 0;
}
$isc4 = $_POST['iscorrect'][3];
if ($isc4 != 1) {
    $isc4 = 0;
}   

echo $quizid . " " . $questiontxt . " " . "<br>";
echo $answer1." ".$isc1." ".$answer2." ".$isc2." ".$answer3." ".$isc3." ".$answer4." ".$isc4 . " "; 
echo $isc1 . $isc2 . $isc3 . $isc4;

//for question image
//$pname = rand(1000,10000)."-".$_FILES["image"]["name"];
$filename = $_FILES["image"]["name"];
$tempname = $_FILES["image"]["tmp_name"];
$folder = "../uploads/";
// Now let's move the uploaded image into the folder: image
if (move_uploaded_file($tempname, "$folder/$filename"))  {
    echo $msg = "Image uploaded successfully";
}else{
    echo $msg = "Either failed to upload the image or no image has been uploaded.";
}


if ($filename == '') {
    $conn->query("INSERT INTO question(question, quiz_id) VALUES ('$questiontxt','$quizid')");
} else {
    $conn->query("INSERT INTO question(question, question_img, quiz_id) VALUES ('$questiontxt', '$filename', '$quizid')");
}
$questionid = $conn->insert_id;

$conn->query("INSERT INTO question_option (option_text, question_id, is_right) VALUES ('$answer1', '$questionid', '$isc1')");
$conn->query("INSERT INTO question_option (option_text, question_id, is_right) VALUES ('$answer2', '$questionid', '$isc2')");
$conn->query("INSERT INTO question_option (option_text, question_id, is_right) VALUES ('$answer3', '$questionid', '$isc3')");
$conn->query("INSERT INTO question_option (option_text, question_id, is_right) VALUES ('$answer4', '$questionid', '$isc4')");

if ($conn->commit()) {
    header("Location: quiz_manage.php?id=$quizid");
    echo $quizid . " " . $questiontxt . " " . "<br>";
    echo $answer1." ".$isc1." ".$answer2." ".$isc2." ".$answer3." ".$isc3." ".$answer4." ".$isc4."<br>";
    echo $questionid; 
}

?>