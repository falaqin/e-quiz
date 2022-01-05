<?php
include ("lecturer_header.php");

include("../inc/database.php");

$id = $_GET['id'];

$sql = 'SELECT * FROM quiz_list WHERE id = '. $id .'';
$query = $conn->query($sql);
$row = mysqli_fetch_assoc($query);

$sqlquestion = "SELECT * FROM question WHERE quiz_id = $id ORDER BY id ASC";
$queryquestion = $conn->query($sqlquestion);

$sqlclass = "SELECT * FROM student_quiz sq INNER JOIN class c WHERE sq.class_id = c.class_id AND sq.quiz_id = $id ORDER BY sq.date_updated ASC";
$queryclass = $conn->query($sqlclass);
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

<div class="container">
    <br>
    <h2 class="bi bi-pencil-square"> Title: <?php echo $row['title'] ?> <a href="quiz_list.php" class="btn btn-sm btn-secondary">Back</a></h2>
    <button class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#addquestion">Add Question</button>
	<button class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#addstd">Add Class</button>   
    <br>
    <br>
    <div class="text-dark">
        <div class="row shadow">
            <div class="card col-sm-6">
                <div class="card-body">
                    <ul class="list-group">
                        <h5 class="card-title">Questions</h5>
                        <?php 
						while ($questionrow = mysqli_fetch_assoc($queryquestion)): 
						?>
                        <li class="list-group-item"> <?php echo $questionrow['question'] ?> <br> <br>
                            <center>
                                <?php 
                                $questionid = $questionrow['id'];

                                if ($questionrow['question_type'] == 1):
                                    echo '<a href="quiz_question_edit.php?question_id='.$questionid.'&id='.$id.'" class="btn btn-sm btn-outline-primary"><b>Edit (Selection)</b></a>';
                                    echo ' ';
                                    ?> <a href="javascript:void(0)" onclick="delete_data('quiz_question_delete.php?questionid=<?php echo $questionid ?>&quiz_id=<?php echo $id ?>&type=<?php echo $questionrow['question_type'] ?>')" class="btn btn-sm btn-outline-danger bi bi-trash" title="Delete"></a> <?php
                                elseif ($questionrow['question_type'] == 2):
                                    echo '<a href="quiz_question_picture_edit.php?question_id='.$questionid.'&id='.$id.'" class="btn btn-sm btn-outline-primary"><b>Edit (Image)</b></a>';
                                    echo ' ';
                                    ?> <a href="javascript:void(0)" onclick="delete_data('quiz_question_img_delete.php?questionid=<?php echo $questionid ?>&quiz_id=<?php echo $id ?>')" class="btn btn-sm btn-outline-danger bi bi-trash" title="Delete"></a> <?php
                                elseif ($questionrow['question_type'] == 3):
                                    echo '<a href="quiz_question_edit.php?question_id='.$questionid.'&id='.$id.'" class="btn btn-sm btn-outline-primary"><b>Edit (Combo)</b></a>';
                                    echo ' ';
                                    ?> <a href="javascript:void(0)" onclick="delete_data('quiz_question_delete.php?questionid=<?php echo $questionid ?>&quiz_id=<?php echo $id ?>&type=<?php echo $questionrow['question_type'] ?>')" class="btn btn-sm btn-outline-danger bi bi-trash" title="Delete"></a> <?php
                                endif; ?>
                            </center>
                        </li>
						<?php endwhile; ?>
                    </ul>
                </div>
            </div>
			
			<div class="card col-sm-6">
				<div class="card-body">
					<ul class="list-group">
						<h5 class="card-title">Class</h5>
						<?php
                        while ($classrow = mysqli_fetch_assoc($queryclass)):
                        ?>
						<li class="list-group-item"> <?php echo $classrow['class_section']; ?>
							<center>
								<a href="javascript:void(0)" onclick="delete_data('quiz_class_delete.php?class_id=<?php echo $classrow['class_id'] ?>&quiz_id=<?php echo $id ?>')" class="btn btn-sm btn-outline-danger"><b>Delete</b></a>
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
                <button class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#combo" data-bs-dismiss="modal">Combo Question</button>
                <a href="quiz img.php?id=<?php echo $id ?>" class="btn btn-sm btn-primary">Picture Question</a>
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

            <form action="quiz_selection_upload.php" method="post" enctype="multipart/form-data">
                <div class="modal-body">
                    <label>Question</label>
                    <textarea class="form-control" name="question" cols="30" rows="5" required></textarea>
                    <br>

                    <label>Picture for Question (optional)</label>
                    <input type="file" name="image" class="form-control">
                    <br><br>

                    <input type="hidden" value="<?php echo $id ?>" name="quizid">

                    <label>Answer: A</label>
                    <input type="text" name="answer1" class="form-control" required>
                    <input type="radio" name="iscorrect[0]" value="1">
                    <label for="iscorrect">Tick if correct answer.</label>
                    <br><br>

                    <label>Answer: B</label>
                    <input type="text" name="answer2" class="form-control" required>
                    <input type="radio" name="iscorrect[1]" value="1">
                    <label for="iscorrect">Tick if correct answer.</label>
                    <br><br>

                    <label>Answer: C</label>
                    <input type="text" name="answer3" class="form-control" required>
                    <input type="radio" name="iscorrect[2]" value="1">
                    <label for="iscorrect">Tick if correct answer.</label>
                    <br><br>
                        
                    <label>Answer: D</label>
                    <input type="text" name="answer4" class="form-control" required>
                    <input type="radio" name="iscorrect[3]" value="1">
                    <label for="iscorrect">Tick if correct answer.</label>
                    
                    <input type="hidden" value="1" name="type">
                </div>
                <div class="modal-footer">
                    <input type="submit" class="btn btn-primary" name="submit" value="Insert">
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="combo" tabindex="-1" aria-labelledby="comboquiz" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="comboquiz">Combo question</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <form action="quiz_selection_upload.php" method="post" enctype="multipart/form-data">
                <div class="modal-body">
                    <label>Question</label>
                    <textarea class="form-control" name="question" cols="30" rows="5" required></textarea>
                    <br>

                    <label>Picture for Question (optional)</label>
                    <input type="file" name="image" class="form-control">
                    <br><br>

                    <input type="hidden" value="<?php echo $id ?>" name="quizid">

                    <label>First answer</label>
                    <input type="text" name="answer1" class="form-control" required>
                    <input type="checkbox" name="iscorrect[0]" value="1">
                    <label for="iscorrect">Tick if correct answer.</label>
                    <br><br>

                    <label>Second answer</label>
                    <input type="text" name="answer2" class="form-control" required>
                    <input type="checkbox" name="iscorrect[1]" value="1">
                    <label for="iscorrect">Tick if correct answer.</label>
                    <br><br>

                    <label>Third answer</label>
                    <input type="text" name="answer3" class="form-control" required>
                    <input type="checkbox" name="iscorrect[2]" value="1">
                    <label for="iscorrect">Tick if correct answer.</label>
                    <br><br>
                        
                    <label>Fourth answer</label>
                    <input type="text" name="answer4" class="form-control" required>
                    <input type="checkbox" name="iscorrect[3]" value="1">
                    <label for="iscorrect">Tick if correct answer.</label>
                    <br><br>

                    <label>Fifth answer</label>
                    <input type="text" name="answer5" class="form-control" required>
                    <input type="checkbox" name="iscorrect[4]" value="1">
                    <label for="iscorrect">Tick if correct answer.</label>
                    
                    <input type="hidden" value="3" name="type">
                </div>
                <div class="modal-footer">
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
				<h5 class="modal-title">Add Class</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>

			<form action="quiz_add_student.php" method="post">
				<div class="modal-body">
					<label for="students">Select classes here:</label> <br>
					<select class="form-control std" multiple="multiple" name="class[]" style="width: 100%" required>
						<option value="" disabled>Select Here</option>
					<?php 
						$class = $conn->query('SELECT * FROM class ORDER BY class_id ASC');
						while($result=$class->fetch_assoc()){
						?>	
						<option value="<?php echo $result['class_id'] ?>"> <?php echo ucwords($result['class_section'])?> </option>
					<?php } ?>
					</select>

					<input type="hidden" name="idQuiz" value="<?php echo $id ?>">
				</div>
				<div class="modal-footer">
					<input type="submit" class="btn btn-primary" name="addstudent" value="Add Class">
				</div>
			</form>
		</div>
	</div>
</div>

<script>
    $("input[type=radio]").on("click", function() {
        $("input[type=radio]").prop("checked", false);
        $(this).prop("checked", true);
      });
</script>

<?php
include ("lecturer_footer.php");
?>