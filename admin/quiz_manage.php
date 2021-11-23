<?php
include ("admin_header.php");

include("../inc/database.php");

$id = $_GET['id'];

$sql = 'SELECT * FROM quiz_list WHERE id = '. $id .'';
$query = $conn->query($sql);
$row = mysqli_fetch_assoc($query);
?>

<div class="container bg-gradient text-light">
    <br>
    <h2>Title: <?php echo $row['title'] ?> <a href="quiz.php" class="btn btn-sm btn-secondary">Back</a></h2>
    <button class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#addquiz">Add Question</button>    
    <button class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#addstudent">Add Students</button>
    <br>
    <br>
    <div class="row text-dark">
        <div class="col-sm-6">
            <div class="card">
                <div class="card-body">
                    <ul class="list-group">
                        <h5 class="card-title">Questions</h5>
                        <?php /* please loop this for question table */ ?>
                        <li class="list-group-item"> placeholder for question table from equiz_db (please echo this) <br> <br>
                            <center>
                                <button class="btn btn-sm btn-outline-primary" data-id="" type="button"><b>Edit</b></button>
                                <button class="btn btn-sm btn-outline-danger" data-id="" type="button"><b>Delete</b></button>
                            </center>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="col-sm-6">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Students</h5>
                    <?php /* please loop this for students */ ?>
                    <li class="list-group-item"> placeholder for student table from equiz_db (please echo this) <br><br>
                        <center>
                            <button class="btn btn-sm btn-outline-danger" data-id="" type="button"><b>Delete</b></button>
                        </center>
                    </li>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="addquiz" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="" method="post">
                <div class="modal-body">
                    ...
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Save changes</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="addstudent" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Select Students</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id='student-frm'>
							<div class ="modal-body">
								<div id="msg"></div>
								<div class="form-group">
									<br>
									<!-- <input type="hidden" name="qid" value="<?php /* echo $_GET['id'] */ ?>" /> -->
									<select rows='3' name="std_id" required="required" multiple class="form-control select2" style="width: 100% !important">
									<?php 
									/* $student = $conn->query('SELECT * FROM students ORDER BY std_name');
									while($row=$student->fetch_assoc()){ */

									?>	
									<option value="1">Student Name (echo)</option>
                                    <option value="2">Student Name (echo)</option>
                                    <option value="3">Student Name (echo)</option>
								<?php /* } */ ?>
								</select>

									</select>
								</div>
								
								
							</div>
                            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button>
						</form>
            </div>
        </div>
    </div>
</div>

<?php
include ("admin_footer.php");
?>