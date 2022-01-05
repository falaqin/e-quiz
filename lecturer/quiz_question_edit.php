<?php
include("../inc/database.php");
include("lecturer_header.php");

$questionID = $_GET['question_id'];
$quizID = $_GET['id'];
$num = 0;

$answerABCD = array('A','B','C','D');
$answerCombo = array('First Answer', 'Second Answer', 'Third Answer', 'Fourth Answer', 'Fifth Answer');

$SQLquestion = "SELECT * FROM question WHERE id = $questionID";
$queryQuestion = $conn->query($SQLquestion);
$callQuestion = mysqli_fetch_assoc($queryQuestion);
$img = $callQuestion['question_img'];

$SQLoption = "SELECT * FROM question_option WHERE question_id = $questionID";
$queryOption = $conn->query($SQLoption);
?>

<?php
if ($callQuestion['question_type'] == 1):
?>

<div class="container">
    <br>
    <h2 class="bi bi-pencil-square">
        Edit Question <a href="quiz_manage.php?id=<?php echo $quizID ?>" class="btn btn-sm btn-secondary">Back</a>
    </h2>
    <br>
    <div class="container">
        <form method="post" action="quiz question edit submit.php" enctype="multipart/form-data">
            <input type="hidden" name="questionid" value="<?php echo $questionID ?>">
            <input type="hidden" name="quizid" value="<?php echo $quizID ?>">
            <input type="hidden" name="type" value="1">
            <div class="card text-dark col-md-4 d-flex shadow" style="width: inherit;">
                <div class="card-body">
                    <div class="form-group">
                        <label for="question" class="form-label">Question</label>
                        <textarea name="question" class="form-control" cols="30" rows="5" required><?php echo $callQuestion['question'] ?></textarea>
                    </div>
                    <?php if($img <> '') { ?>
                    <br>
                    <div class="form-group">
                        <div class="card center shadow" style="max-width: 800px;">
                            <img src="../uploads/<?php echo $img ?>" alt="question image" class="card-img-top center" style="max-width: 500px;">
                            <center><p><?php echo $img ?></p></center>
                            <input type="hidden" value="<?php echo $img ?>" name="old_image">
                            <input type="file" class="form-control" name="new_image">
                        </div>
                        
                    </div>
                    <br>
                    <?php } ?>
                    <?php while ($callOption = mysqli_fetch_assoc($queryOption)) { ?>
                        <div class="form-group">
                            <label>Answer: <?php echo $answerABCD[$num] ?></label>
                            <input type="text" name="answer<?php echo $num ?>" class="form-control" value="<?php echo $callOption['option_text'] ?>" required>
                            <input type="radio" name="iscorrect[<?php echo $num ?>]" <?php if($callOption['is_right'] == 1) { echo 'checked="checked"'; } ?> value="1">
                            <label for="iscorrect" class="form-label">Tick if correct answer.</label>
                        </div>
                        <br>
                    <?php $num++; } ?>
                    <input type="submit" name="Submit" value="Save Edit" class="btn btn-primary shadow">
                </div>
            </div>
        </form>
    </div>
</div>

<?php
elseif ($callQuestion['question_type'] == 3):
?>

<div class="container">
    <br>
    <h2 class="bi bi-pencil-square">
        Edit Question <a href="quiz_manage.php?id=<?php echo $quizID ?>" class="btn btn-sm btn-secondary">Back</a>
    </h2>
    <br>
    <div class="container">
        <form method="post" action="quiz question edit submit.php" enctype="multipart/form-data">
            <input type="hidden" name="questionid" value="<?php echo $questionID ?>">
            <input type="hidden" name="quizid" value="<?php echo $quizID ?>">
            <input type="hidden" name="type" value="3">
            <div class="card text-dark col-md-4 d-flex shadow" style="width: inherit;">
                <div class="card-body">
                    <div class="form-group">
                        <label for="question" class="form-label">Question</label>
                        <textarea name="question" class="form-control" cols="30" rows="5" required><?php echo $callQuestion['question'] ?></textarea>
                    </div>
                    <?php if($img <> '') { ?>
                    <br>
                    <div class="form-group">
                        <div class="card center shadow" style="max-width: 800px;">
                            <img src="../uploads/<?php echo $img ?>" alt="question image" class="card-img-top center" style="max-width: 500px;">
                            <center><p><?php echo $img ?></p></center>
                            <input type="hidden" value="<?php echo $img ?>" name="old_image">
                            <input type="file" class="form-control" name="new_image">
                        </div>
                        
                    </div>
                    <br>
                    <?php } ?>
                    <?php while ($callOption = mysqli_fetch_assoc($queryOption)) { ?>
                        <div class="form-group">
                            <label><?php echo $answerCombo[$num] ?></label>
                            <input type="text" name="answer<?php echo $num ?>" class="form-control" value="<?php echo $callOption['option_text'] ?>" required>
                            <input type="checkbox" name="iscorrect[<?php echo $num ?>]" <?php if($callOption['is_right'] == 1) { echo 'checked="checked"'; } ?> value="1">
                            <label for="iscorrect" class="form-label">Tick if correct answer.</label>
                        </div>
                        <br>
                    <?php $num++; } ?>
                    <input type="submit" name="Submit" value="Save Edit" class="btn btn-primary shadow">
                </div>
            </div>
        </form>
    </div>
</div>

<?php
endif;
?>

<style>
    .center {
    display: block;
    margin-left: auto;
    margin-right: auto;
    width: 80%;
    }
</style>

<script>
    $("input[type=radio]").on("click", function() {
        $("input[type=radio]").prop("checked", false);
        $(this).prop("checked", true);
      });
</script>

<?php
include("lecturer_footer.php");
?>