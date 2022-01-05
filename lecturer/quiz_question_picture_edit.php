<?php
include("../inc/database.php");
include("lecturer_header.php");

$questionID = $_GET['question_id'];
$num = 0;
$quizID = $_GET['id'];

$SQLquestion = "SELECT * FROM question WHERE id = $questionID";
$queryQuestion = $conn->query($SQLquestion);
$callQuestion = mysqli_fetch_assoc($queryQuestion);

$SQLoption = "SELECT * FROM question_option WHERE question_id = $questionID";
$queryOption = $conn->query($SQLoption);
?>

<div class="container">
    <br>
    <h2 class="bi bi-pencil-square">
        Edit Question <a href="quiz_manage.php?id=<?php echo $quizID ?>" class="btn btn-sm btn-secondary">Back</a>
    </h2>

    <div class="container">
        <form action="quiz question image edit submit.php" method="post" enctype="multipart/form-data">
            <input type="hidden" name="questionid" value="<?php echo $questionID ?>">
            <input type="hidden" name="quizid" value="<?php echo $quizID ?>">

            <div class="card text-dark col-md-4 d-flex shadow" style="width: inherit;">
                <div class="card-body">
                    <div class="form-group">
                        <label for="question" class="form-label">Question</label>
                        <textarea name="question" class="form-control" cols="30" rows="5" required><?php echo $callQuestion['question'] ?></textarea>
                    </div>
                    <br>
                    <?php while ($callOption = mysqli_fetch_assoc($queryOption)) { ?>
                        <div class="form-group">
                            <div class="card center shadow" style="max-width: 500px;">
                                <img src="../uploads/<?php echo $callOption['option_img'] ?>" alt="question image" class="card-img-top center" style="max-width: 500px;">
                                <center><p><?php echo $callOption['option_img'] ?></p></center>
                                <input type="hidden" value="<?php echo $callOption['option_img'] ?>" name="old_image<?php echo $num ?>">
                                <input type="hidden" name="option_id<?php echo $num ?>" value="<?php echo $callOption['id'] ?>">
                            </div>
                            <br>
                            <input type="file" name="new_image<?php echo $num ?>" class="form-control" value="<?php echo $callOption['option_img'] ?>">
                            <input type="checkbox" name="iscorrect<?php echo $num ?>" <?php if($callOption['is_right'] == 1) { echo 'checked="checked"'; } ?> value="1">
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

<style>
    .center {
    display: block;
    margin-left: auto;
    margin-right: auto;
    width: 80%;
    }
</style>

<?php
include("lecturer_footer.php");
?>