<?php
include("../inc/database.php");

$p=$_POST;
$title=$p['title'];
$points=$p['points'];
$timer=$p['timer'];
$status=$p['active'];
$pass=$p['pass'];
$id=$p['idquiz'];
$retake = $p['redo'];

// check retake if there's any values or not
if (!isset($retake)) {
    $retake = 0;
}

$sql = "UPDATE quiz_list 
SET title='$title', points='$points', is_active='$status', quiz_pw='$pass', timer='$timer', enable_retake_quiz='$retake'
WHERE id = '$id'";

if($conn->query($sql)) {
    header("Location:quiz_list.php");
}
?>