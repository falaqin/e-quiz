<?php
//Import database connection
include('../inc/database.php');
include('admin_header.php');

if(isset($_POST["saveimport"])){
		
	echo $filename=$_FILES["file"]["tmp_name"];
	if($_FILES["file"]["size"] > 0) {
		  	
		$file = fopen($filename, "r");
		fgetcsv($file, 10000, ",");
	    while (($data = fgetcsv($file, 10000, ",")) !== FALSE) {

	        //It will insert a row to our subject table from our csv file`
			$md5password = md5($data[5]);
	        $sql = "INSERT into student (std_name, std_matric, class_id, std_session, std_username, std_password) 
	        	values('$data[0]','$data[1]','$data[2]','$data[3]','$data[4]','$md5password')";
	        //we are using mysql_query function. it returns a resource on true else False on error
	        $result = mysqli_query($conn, $sql);
			if(!$result)
			{
				echo "<script type=\"text/javascript\">
				alert(\"Invalid File: Please Upload CSV File.\");
				window.location = \"student_info.php?page=1\"
				</script>";
 			}
		}
		fclose($file);
		//throws a message if data successfully imported to mysql database from excel file
		echo "<script type=\"text/javascript\">
		alert(\"CSV File has been successfully Imported.\");
		window.location = \"student_info.php?page=1\"
		</script>";

		//close of connection
		mysqli_close($conn); 
	}
}

?>

