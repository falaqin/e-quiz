<?php
include('sv_header.php');
include("../inc/database.php");

$id=$_GET['id'];

//sql statement for quiz_list table
$sql="SELECT * FROM quiz_list WHERE quiz_id='$id'";

$query=$conn->query($sql);

$res=mysqli_fetch_assoc($query);

if(isset($_POST['save'])) {
    $p = $_POST;
    $title = $p['title'];
    $point = $p['point'];

    $sql = "UPDATE quiz_list SET quiz_title='$title', quiz_points='$point' WHERE quiz_id = '$id'";
    if($conn->query($sql)) {
        header("Location:quiz_list.php");
    }
}


?>

<div class="container bg-gradient text-light">
    <br>
    <h2>Quiz Form <a href="quiz_list.php" class="btn btn-sm btn-secondary">Back</a></h2>

    <form action="" method="post">
        <div class="form-group">
            <label for="title">Title</label>
            <input type="text" name="title" id="" class="form-control" value="<?php echo $res['quiz_title'] ?>">

            <label for="point">Points</label>
            <input type="text" name="point" class="form-control" value="<?php echo $res['quiz_points'] ?>">
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