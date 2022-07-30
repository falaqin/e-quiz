<?php
include('../inc/database.php');

//receive data from input
$p=$_POST;
echo $id = $p['stdid'];
echo $name = $p['name'];
echo $username=$p['username'];
echo $matric = $p['matric'];
echo $session = $p['session'];
echo $class = $p['class'];

//sql statement
$sql="UPDATE student
SET std_username='$username', std_name='$name', std_session='$session', std_matric='$matric', class_id='$class'
WHERE std_id='$id'";
//if query no error
if($conn->query($sql))
{
    //redirect to userphp page
    header("Location:student_info.php?page=1");
}
else
{
    //if error
    die("SQL error report ".$conn->error);
}
?>