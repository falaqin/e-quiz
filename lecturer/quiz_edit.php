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

if(isset($_POST['save'])) {
    $p=$_POST;
    $title=$p['title'];
    $points=$p['points'];
    $status=$p['active'];
    $pass=$p['pass'];
    $id=$_GET['id'];

    $sql = "UPDATE quiz_list 
    SET title='$title', points='$points', is_active='$status', quiz_pw='$pass'
    WHERE id = '$id'";
    if($conn->query($sql)) {
        header("Location:quiz_list.php");
    }
}


?>

<div class="container">
    <br>
    <h2>Quiz Form <a href="quiz_list.php" class="btn btn-sm btn-secondary">Back</a></h2>

    <form action="" method="post">
        <div class="form-group">
            <label for="title">Title</label>
            <input type="text" name="title" id="" class="form-control" value="<?php echo $res['title'] ?>">

            <label for="points">Points per question</label>
            <input type="number" name="points" class="form-control" value="<?php echo $res['points'] ?>">

            <label for="active">Quiz Status</label>
            <select name="active" id="active" class="form-control" required>
                <option value="0">Inactive</option>
                <option value="1"<?php if($res['is_active']==1) {echo 'selected=selected"';} ?>>Active</option>
            </select>

            <label for="pass">Unique Key (for students to enter)</label>
            <input type="text" name="pass" class="form-control" value="<?php echo $res['quiz_pw'] ?>">
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
</style>

<?php
include('lecturer_footer.php');
?>