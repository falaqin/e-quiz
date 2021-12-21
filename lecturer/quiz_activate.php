<?php
//Import database connection
include('../inc/database.php');

//Get id
$id = $_GET['id'];
if ($_GET['act'] == 0) {
    $active = 1;
} else {
    $active = 0;
}

//SQL statement
$sql="UPDATE quiz_list
SET is_active = $active
WHERE id = $id";

//Check and run query
if($conn->query($sql))
{
    //redirect to home page
    header("Location:quiz_list.php");
}
else
{
    die("SQL error report ".$conn->error);
}
?>