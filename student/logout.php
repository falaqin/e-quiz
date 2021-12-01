<?php
//start sesh
session_start();

//destroy sesh
session_destroy();

//redirect to login page
header("Location:../studentlogin.php")
?>