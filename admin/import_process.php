<?php
//Import database connection
include('../inc/database.php');
include('./script/excelreader.php');
include('admin_header.php');


if(isset($_POST["saveimport"])){
		
	echo $filename=$_FILES["file"]["tmp_name"];
	if($_FILES["file"]["size"] > 0) {
		  	
		$file = fopen($filename, "r");
	    while (($emapData = fgetcsv($file, 10000, ",")) !== FALSE) {

	        //It wiil insert a row to our subject table from our csv file`
	        $sql = "INSERT into user (user_name, u_username, u_password, u_access_lvl) 
	        	values('$emapData[0]','$emapData[1]','md5($emapData[2])','$emapData[3]')";
	        //we are using mysql_query function. it returns a resource on true else False on error
	        $result = mysqli_query($conn, $sql);
			if(!$result)
			{
				echo "<script type=\"text/javascript\">
				alert(\"Invalid File:Please Upload CSV File.\");
				window.location = \"user_info.php\"
				</script>";
 			}
		}
		fclose($file);
		//throws a message if data successfully imported to mysql database from excel file
		echo "<script type=\"text/javascript\">
		alert(\"CSV File has been successfully Imported.\");
		window.location = \"user_info.php\"
		</script>";

		//close of connection
		mysqli_close($conn); 
	}
}

?>

