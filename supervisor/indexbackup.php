<!DOCTYPE html>
<?php 
	//Import database connection
    include('../inc/database.php');

    //Import header file
    include('sv_header.php');
 
?>	
<html lang="en">
	<head>
		<meta charset="utf-8">
		<title>Import Excel To MySQL Database Using PHP </title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta name="description" content="Import Excel File To MySQL Database Using php">
 
		<link rel="stylesheet" href="css/bootstrap.min.css">
		<link rel="stylesheet" href="css/bootstrap-responsive.min.css">
		<link rel="stylesheet" href="css/bootstrap-custom.css">
 
 
	</head>
	<body>    
 
	<!-- Navbar
    ================================================== -->
 
	<div class="container bg-transparent text-light">
    
  
	</div>
 
	<div id="wrap">
	<div class="container bg-gradient text-light">
		<div class="row">
			<div class="container bg-transparent text-light"></div>
            <h2 style="color : white;">Student Info <a href="student_form.php" class="btn btn-primary btn-sm">Add</a></h2>
            <a class="brand" href="#">Import Excel To Database </a>
			<div class="span6" id="form-login">
				<form class="form-horizontal well" action="import.php" method="post" name="upload_excel" enctype="multipart/form-data">
					<fieldset>
						<legend></legend>
						<div class="control-group">
							<div class="control-label">
								<label>CSV/Excel File:</label>
							</div>
							<div class="controls">
								<input type="file" name="file" id="file" class="input-large">
							</div>
						</div>
 
						<div class="control-group">
							<div class="controls">
							<button type="submit" id="submit" name="Import" class="btn btn-primary button-loading" data-loading-text="Loading...">Upload</button>
							</div>
                            <br>
						</div>
					</fieldset>
				</form>
			</div>
			<div class="span3 hidden-phone"></div>
		</div>
 
		<table class="table table-dark table-striped">
			<thead>
				  	<tr>
				  		<th>No</th>
                        <th>Name</th>
                        <th>Matric No.</th>
                        <th>Session</th>
                        <th>Configuration</th>

				  	</tr>	
			</thead>
			<?php
                $no=1;
				$SQLSELECT = "SELECT * FROM student ";
				$result_set =  mysqli_query($conn, $SQLSELECT);
				while($row = mysqli_fetch_array($result_set))
				{
				?>
 
                     <tr>
                        <td><?php echo $no; ?></td>
                        <td><?php echo $row['std_name']; ?></td>
                        <td><?php echo $row['std_matric']; ?></td>
                        <td><?php echo $row['std_session']; ?></td>
                        <td>
                            <a href="student_edit.php?id=<?php echo $row['std_id']; ?>">Edit</a>
                            <a href="javascript:void(0)" onclick="delete_data('student_delete.php?id=<?php echo $row['std_id'] ?>')">Delete</a>
                        </td>
                    </tr>
				<?php
				}
			?>
		</table>
	</div>
 
	</div>
 
	</body>
</html>