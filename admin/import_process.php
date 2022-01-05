<?php
//Import database connection
include("../inc/database.php");


if(isset($_POST["saveimport"])){
		
	$filename = $_FILES["file"]["tmp_name"];
	if($_FILES["file"]["size"] > 0) {
		  	
		$file = fopen($filename, "r");
		fgetcsv($file, 10000, ",");
	    while (($data = fgetcsv($file, 10000, ",")) !== FALSE) {

	        //It wiil insert a row to our subject table from our csv file`
			$md5password = md5($data[3]);
	        $sql = "INSERT INTO user(user_name, u_access_lvl, u_username, u_password) VALUES ('$data[0]','$data[1]','$data[2]','$md5password')";
			
			$data[0] . $data[1] . $data[2] . $data[3];
	        
			//we are using mysql_query function. it returns a resource on true else False on error
			$result = mysqli_query($conn, $sql);
			if(!$result)
			{
				echo mysqli_error($conn);
				echo "<script type=\"text/javascript\">
				alert(\"Invalid File: Please Upload CSV File.\");
				window.location = \"student_info.php\"
				</script>";
 			}
		}
		fclose($file);
		//throws a message if data successfully imported to mysql database from excel file
		/* echo "<script type=\"text/javascript\">
		alert(\"CSV File has been successfully Imported.\");
		window.location = \"user_info.php\"
		</script>"; */

		//close of connection
		mysqli_close($conn); 
	}
}

?>

