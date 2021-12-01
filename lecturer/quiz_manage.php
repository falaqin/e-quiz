<?php
include ("lecturer_header.php");

include("../inc/database.php");

$id = $_GET['id'];

$sql = 'SELECT * FROM quiz_list WHERE id = '. $id .'';
$query = $conn->query($sql);
$row = mysqli_fetch_assoc($query);

$sqlquestion = "SELECT * FROM question WHERE quiz_id = $id ORDER BY date_updated ASC";
$queryquestion = $conn->query($sqlquestion);

$sqlstudent = "SELECT * FROM student_quiz sq INNER JOIN student s WHERE sq.std_id = s.std_id AND sq.quiz_id = $id ORDER BY sq.date_updated ASC";
$querystudent = $conn->query($sqlstudent);
?>
<script>
    function matchCustom(params, data) {
    // If there are no search terms, return all of the data
    if ($.trim(params.term) === '') {
      return data;
    }

    // Do not display the item if there is no 'text' property
    if (typeof data.text === 'undefined') {
      return null;
    }

    // `params.term` should be the term that is used for searching
    // `data.text` is the text that is displayed for the data object
    if (data.text.indexOf(params.term) > -1) {
      var modifiedData = $.extend({}, data, true);
      modifiedData.text += ' (matched)';

      // You can return modified objects from here
      // This includes matching the `children` how you want in nested data sets
      return modifiedData;
    }

    // Return `null` if the term should not be displayed
    return null;
}

    $(document).ready(function() {
    $('.std').select2({
		dropdownParent: $('#addstd'),
		width:'resolve',
        matcher: matchCustom
	});
});
</script>

<div class="container bg-gradient text-light">
    <br>
    <h2>Title: <?php echo $row['title'] ?> <a href="quiz_list.php" class="btn btn-sm btn-secondary">Back</a></h2>
    <button class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#addquestion">Add Question</button>
	<button class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#addstd">Add Students</button>   
    <br>
    <br>
    <div class="text-dark">
        <div class="row">
            <div class="card col-sm-6">
                <div class="card-body">
                    <ul class="list-group">
                        <h5 class="card-title">Questions</h5>
                        <?php 
						while ($questionrow = mysqli_fetch_assoc($queryquestion)): 
						?>
                        <li class="list-group-item"> <?php echo $questionrow['question'] ?> <br> <br>
                            <center>
                                <button class="btn btn-sm btn-outline-primary" data-id="" type="button" disabled><b>Edit</b></button>
                                <a href="javascript:void(0)" onclick="delete_data('quiz_question_delete.php?questionid=<?php echo $questionrow['id'] ?>&quiz_id=<?php echo $id ?>')" class="btn btn-sm btn-outline-danger"><b>Delete</b></a>
                            </center>
                        </li>
						<?php endwhile; ?>
                    </ul>
                </div>
            </div>
			
			<div class="card col-sm-6">
				<div class="card-body">
					<ul class="list-group">
						<h5 class="card-title">Students</h5>
						<?php
                        while ($studentrow = mysqli_fetch_assoc($querystudent)):
                        ?>
						<li class="list-group-item"> <?php echo $studentrow['std_name']; ?>
							<center>
								<a href="javascript:void(0)" onclick="delete_data('quiz_student_delete.php?std_id=<?php echo $studentrow['std_id'] ?>&quiz_id=<?php echo $id ?>')" class="btn btn-sm btn-outline-danger"><b>Delete</b></a>
							</center>
						</li>
						<?php
                        endwhile;
                        ?>
					</ul>
				</div>
			</div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="addquestion" aria-hidden="true" aria-labelledby="exampleModalLabel" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add Question</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>Type of Question</p>
                <button class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#abcd" data-bs-dismiss="modal">4 Selection question</button>
                <button class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#picquiz" data-bs-dismiss="modal" disabled>Picture question</button>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="abcd" tabindex="-1" aria-labelledby="abcdquiz" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="abcdquiz">4 Selection question</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <form action="upload_question.php" method="post" enctype="multipart/form-data">
                <div class="modal-body">
                    <label>Question</label>
                    <textarea class="form-control" name="question" cols="30" rows="5"></textarea>
                    <br>

                    <label>Picture for Question (optional)</label>
                    <input type="file" name="image" class="form-control">
                    <br><br>

                    <input type="hidden" value="<?php echo $id ?>" name="quizid">

                    <label>Answer: A</label>
                    <input type="text" name="answer1" class="form-control">
                    <input type="radio" name="iscorrect[]" value="1">
                    <label for="iscorrect">Tick if correct answer.</label>
                    <br><br>

                    <label>Answer: B</label>
                    <input type="text" name="answer2" class="form-control">
                    <input type="radio" name="iscorrect[]" value="1">
                    <label for="iscorrect">Tick if correct answer.</label>
                    <br><br>

                    <label>Answer: C</label>
                    <input type="text" name="answer3" class="form-control">
                    <input type="radio" name="iscorrect[]" value="1">
                    <label for="iscorrect">Tick if correct answer.</label>
                    <br><br>
                        
                    <label>Answer: D</label>
                    <input type="text" name="answer4" class="form-control">
                    <input type="radio" name="iscorrect[]" value="1">
                    <label for="iscorrect">Tick if correct answer.</label>

                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <input type="submit" class="btn btn-primary" name="submit" value="Insert">
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="addstd" tabindex="-1" aria-labelledby="addstd" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title">Add Student</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>

			<form action="quiz_add_student.php" method="post">
				<div class="modal-body">
					<label for="students">Select students here:</label> <br>
					<select class="form-control std" multiple="multiple" name="students[]" style="width: 100%">
						<option value="" disabled>Select Here</option>
					<?php 
						$student = $conn->query('SELECT * FROM student ORDER BY std_matric ASC');
						while($result=$student->fetch_assoc()){
						?>	
						<option value="<?php echo $result['std_id'] ?>"> <?php echo ucwords($result['std_name']).' '.$result['std_matric'] ?> </option>
					<?php } ?>
					</select>

					<input type="hidden" name="idQuiz" value="<?php echo $id ?>">
				</div>
				<div class="modal-footer">
					<button class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
					<input type="submit" class="btn btn-primary" name="addstudent" value="Add Student">
				</div>
			</form>
		</div>
	</div>
</div>



<?php
include ("lecturer_footer.php");
?>