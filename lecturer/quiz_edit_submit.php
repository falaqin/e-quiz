<?php
include("../inc/database.php");

$p=$_POST;
$title=$p['title'];
$points=$p['points'];
$timer=$p['timer'];
$status=$p['active'];
$pass=$p['pass'];
$id=$p['idquiz'];

$sql = "UPDATE quiz_list 
SET title='$title', points='$points', is_active='$status', quiz_pw='$pass', timer='$timer'
WHERE id = '$id'";

if($conn->query($sql)) {
    header("Location:quiz_list.php");
}
?>