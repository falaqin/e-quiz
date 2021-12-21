<?php
include("../inc/database.php");
include("lecturer_header.php");

$questionID = $_GET['question_id'];
$quizID = $_GET['id'];
$num = 0;

$answerABCD = array('A','B','C','D');

$SQLquestion = "SELECT * FROM question WHERE id = $questionID";
$queryQuestion = $conn->query($SQLquestion);
$callQuestion = mysqli_fetch_assoc($queryQuestion);

$SQLoption = "SELECT * FROM question_option WHERE question_id = $questionID";
$queryOption = $conn->query($SQLoption);
$img = $callQuestion['question_img'];
?>

<div class="container text-light">
    <br>
    <h2 class="bi bi-pencil-square">
        Edit Question <a href="quiz_manage.php?id=<?php echo $quizID ?>" class="btn btn-sm btn-secondary">Back</a>
    </h2>
    <br>
    <div class="container">
        <form method="post">
            <div class="card text-dark col-md-4 d-flex" style="width: inherit;">
                <div class="card-body">
                    <div class="form-group">
                        <label for="question" class="form-label">Question</label>
                        <textarea name="question" class="form-control" cols="30" rows="5" required><?php echo $callQuestion['question'] ?></textarea>
                    </div>
                    <?php if($img <> '') { ?>
                    <br>
                    <div class="form-group">
                        <div class="card center" style="max-width: 800px;">
                            <img src="../uploads/<?php echo $img ?>" alt="question image" class="card-img-top center" style="max-width: 500px;">
                            <center><p><?php echo $img ?></p></center>
                            <input type="hidden" value="<?php echo $img ?>">
                            <input type="file" class="form-control" name="new_image">
                        </div>
                        
                    </div>
                    <br>
                    <?php } ?>
                    <?php while ($callOption = mysqli_fetch_assoc($queryOption)) { ?>
                        <div class="form-group">
                            <label>Answer: <?php echo $answerABCD[$num] ?></label>
                            <input type="text" name="answer<?php echo $num ?>" class="form-control" value="<?php echo $callOption['option_text'] ?>" required>
                            <input type="radio" name="iscorrect[<?php echo $num ?>" <?php if($callOption['is_right'] == 1) { echo 'checked="checked"'; } ?> value="1">
                            <label for="iscorrect" class="form-label">Tick if correct answer.</label>
                        </div>
                        <br>
                    <?php $num++; } ?>
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

<script>
    $("input[type=radio]").on("click", function() {
        $("input[type=radio]").prop("checked", false);
        $(this).prop("checked", true);
      });
</script>

<?php
include("lecturer_footer.php");
?>