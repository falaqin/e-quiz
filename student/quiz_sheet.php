<?php
include('inc/database.php');
include('std_header_quizsheet.php');
$quizID = $_GET['quizid'];

$QuestionSQL = "SELECT q.id, q.question, q.question_img FROM question q WHERE q.quiz_id = $quizID";
$queryQuestion = $conn->query($QuestionSQL);
?>

<div class="container">
    <br>
    <?php while ($callQuestion = mysqli_fetch_assoc($queryQuestion)): ?>
    <form action="quiz_result.php" method="post">
        <div class="card" style="width: 30rem;">
            <div class="card-header">
            <?php
                $questionID = $callQuestion['id'];
                echo $callQuestion['question'];
            ?>
            </div>
            <div class="card-body">
                <?php
                $OptionSQL = "SELECT qo.id, qo.question_id, qo.option_text, qo.option_img, qo.is_right FROM question_option qo WHERE qo.question_id = $questionID";
                $queryOption = $conn->query($OptionSQL);

                while ($callOption = mysqli_fetch_assoc($queryOption)):
                ?>
                <input type="radio" name="answer<?php echo $questionID?>[]" class="form-check-input" value="<?php echo $callOption['is_right'] ?>">
                <label class="form-check-label"><?php echo $callOption['option_text'] . $callOption['is_right'] ?></label>
                <br>
                <?php
                endwhile;
                ?>
                <input type="hidden" value="<?php echo $quizID ?>" name="quizid">
            </div>
        </div>
        <br>
        <?php endwhile; ?>
        <input type="submit" class="btn btn-primary">
    </form>
    <br>
</div>

<style>
    .card {
    box-shadow: 5px 7px 9px #10002B;
    border: 0;   
}
</style>

<?php 
include('std_footer.php')
?>