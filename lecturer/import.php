<?php
//Import database connection
include('../inc/database.php');

//Import header file
include('lecturer_header.php');
if(isset($_POST["saveimport"])){
		
	echo $filename=$_FILES["file"]["tmp_name"];
	if($_FILES["file"]["size"] > 0) {
		  	
		$file = fopen($filename, "r");
	    while (($emapData = fgetcsv($file, 10000, ",")) !== FALSE) {

	        //It wiil insert a row to our subject table from our csv file`
	        $sql = "INSERT into student (std_username, std_password, std_name,std_matric, std_session) 
	        	values('$emapData[0]','$emapData[1]','$emapData[2]','$emapData[3]','$emapData[4]')";
	        //we are using mysql_query function. it returns a resource on true else False on error
	        $result = mysqli_query($conn, $sql);
			if(!$result)
			{
				echo "<script type=\"text/javascript\">
				alert(\"Invalid File:Please Upload CSV File.\");
				window.location = \"student_info.php\"
				</script>";
 			}
		}
		fclose($file);
		//throws a message if data successfully imported to mysql database from excel file
		echo "<script type=\"text/javascript\">
		alert(\"CSV File has been successfully Imported.\");
		window.location = \"student_info.php\"
		</script>";

		//close of connection
		mysqli_close($conn); 
	}
}	 
?>