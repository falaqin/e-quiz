<?php
//Import header file
include('lecturer_header.php');
include("../inc/database.php");

//get quiz id
$p=$_POST;
$title=$p['title'];
$points=$p['points'];
$id=$_GET['id'];

//sql statement for quiz_list table
$sql="SELECT * FROM quiz_list WHERE id='$id'";

$query=$conn->query($sql);

$res=mysqli_fetch_assoc($query);

?>
<title>Edit Quiz Form</title>

<div class="container">
    <br>
    <h2>Quiz Edit Form <a href="quiz_list.php" class="btn btn-sm btn-secondary">Back</a></h2>

    <form action="quiz_edit_submit.php" method="post">
        <div class="form-group">
            <input type="hidden" value="<?php echo $id ?>" name="idquiz">
            
            <label for="title">Title</label>
            <input type="text" name="title" id="" class="form-control" value="<?php echo $res['title'] ?>">

            <label for="points">Points per question</label>
            <input type="number" name="points" class="form-control" value="<?php echo $res['points'] ?>">

            <label for="timer">Timer</label>
            <input type="number" name="timer" class="form-control" min="5" max="30" value="<?php echo $res['timer'] ?>">

            <label for="active">Quiz Status</label>
            <select name="active" id="active" class="form-control" required>
                <option value="0">Inactive</option>
                <option value="1"<?php if($res['is_active']==1) {echo 'selected=selected"';} ?>>Active</option>
            </select>

            <div class="form-check mt-2 mb-3">
                <input class="form-check-input" type="checkbox" name="redo" value="1" <?php if($res['enable_retake_quiz'] == 1) { echo 'checked="checked"'; } ?>>
                <label class="form-check-label" for="redo">Enable Retake Quiz</label>
            </div>

            <label for="pass">Unique Key (for students to enter)</label>
            <input type="password" name="pass" class="form-control" value="<?php echo $res['quiz_pw'] ?>">
        </div>

        <div>
            <input type="submit" value="Save" name="save" class="btn btn-primary">
        </div>
    </form>
</div>

<style>
    .form-group {
        padding-bottom: 15px;
    }

    .container {
        max-width: 600px;
    }
</style>

<?php
include('lecturer_footer.php');
?>