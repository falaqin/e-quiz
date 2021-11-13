<?php
include("sv_header.php");
include("../inc/database.php");

//get quiz id
$id = $_GET['id'];

//sql statement for table quiz_list
$sql = "SELECT * FROM quiz_list where quiz_id='$id'";
//query
$query = $conn->query($sql);
//result
$res=mysqli_fetch_assoc($query);
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

<?php
include("sv_footer.php")
?>