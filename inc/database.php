<?php 
//php login cred
$host_name = "localhost";
$host_user = "root";
$host_pwd = ""; //usually blank because lol
$db_name = "equiz";
//create connection
$conn=new mysqli($host_name,$host_user,$host_pwd,$db_name);

//check connection
if($conn->connect_error)
{
    die("Connection failed".$conn->connect_error);
}
?>