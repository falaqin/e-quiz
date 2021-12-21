<?php
//import data cons
include('../inc/database.php');

$className = $_POST['class'];

$sqlAddClass = "INSERT INTO class(class_section)
VALUES ('$className')";

if ($conn->query($sqlAddClass)) {
    header("Location:class_info.php");
} else {
    die('SQL report error' .$conn->error);
}
?>