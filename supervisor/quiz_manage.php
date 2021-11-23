<?php 

//import header
include('sv_header.php');

//import db con
include('../inc/database.php'); 

//sql statement
$query = $conn->query("SELECT * FROM quiz_list where id = ".$_GET['id'])->fetch_array();



?>

<body>

    
	<div class="container-fluid admin">
    <h1 style="color:white">Quiz Title <a href="quiz_list.php" class="btn btn-sm btn-secondary">Back</a></h1>
		
		<div class="col-md-12 alert alert-primary"><?php echo $query['title'] ?></div>
		<div class="card col-md-6 mr-4" style="float:left">
			<div class="card-header">
				Questions
			</div>
			<div 
			class="card-body">
			</div>
		</div>
	
		<div class="card col-md-5" style="float:left">
			<div class="card-header">
				Students
			</div>
			<div class="card-body">
            <ul class="list-group">
				
				</ul>
		</div>
		</div>
		<br>
		<br>
		<br>
		<br>

		<h2>
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addquestion">
            Add Question
        </button>

		<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addstudent">
            Add Student
        </button>

        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Show Report</button>
    	</h2>

        <div class="modal fade" id="addquestion" tabindex="-1" role="dialog" >
				<div class="modal-dialog modal-centered" role="document">
					<div class="modal-content">
						<div class="modal-header">
							
							<h4 class="modal-title" id="myModallabel">Add New Question</h4>
							<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						</div>
						<form id='question-frm'>
							<div class ="modal-body">
								<div id="msg"></div>
								<div class="form-group">
									<label>Question</label>
									<input type="hidden" name="qid" value="<?php echo $_GET['id'] ?>" />
									<input type="hidden" name="id" />
									<textarea rows='3' name="question" required="required" class="form-control" ></textarea>
								</div>
									<label>Options:</label>

								<div class="form-group">
									<textarea rows="2" name ="question_opt[0]" required="" class="form-control" ></textarea>
									<span>
									<label><input type="radio" name="is_right[0]" class="is_right" value="1"> <small>Question Answer</small></label>
									</span>
									<br>
									<textarea rows="2" name ="question_opt[1]" required="" class="form-control" ></textarea>
									<label><input type="radio" name="is_right[1]" class="is_right" value="1"> <small>Question Answer</small></label>
									<br>
									<textarea rows="2" name ="question_opt[2]" required="" class="form-control" ></textarea>
									<label><input type="radio" name="is_right[2]" class="is_right" value="1"> <small>Question Answer</small></label>
									<br>
									<textarea rows="2" name ="question_opt[3]" required="" class="form-control" ></textarea>
									<label><input type="radio" name="is_right[3]" class="is_right" value="1"> <small>Question Answer</small></label>
								</div>
								
							</div>
							<div class="modal-footer">
								<button  class="btn btn-primary" name="save"><span class="glyphicon glyphicon-save"></span> Save</button>
                                <?php

                                ?>
                                
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
									<input type="hidden" name="qid" value="<?php  echo $_GET['id'] ?>" />
									<select rows='3' name="std_id" required="required" multiple class="form-control select2" style="width: 100% !important">
									<?php 
									 $student = $conn->query('SELECT * FROM student ORDER BY std_name');
									while($row=$student->fetch_assoc()){ 

									?>	
									<option value="1"><?php echo $row['std_name']; ?></option>
                                    
                                    
								<?php } ?>
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
include("sv_footer.php")
?>