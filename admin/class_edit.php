<?php
//import header
include('admin_header.php');

//import data cons
include('../inc/database.php');

$id = $_GET['id'];

$sqlClass = "SELECT * FROM class WHERE class_id = $id";
$queryClass = $conn->query($sqlClass);
$result = mysqli_fetch_assoc($queryClass);
?>
<title>Edit Class Form</title>
<div class="container bg-gradient text-light">
    <br>
    <h2>
        Edit Class <a href="class_info.php?page=1" class="btn btn-sm btn-secondary">Back</a>
    </h2>

    <form action="class_edit_submit.php" method="post">
        <div class="form-group">
            <label for="class">Class Name</label>
            <input type="text" name="class" class="form-control" value="<?php echo $result['class_section'] ?>" required>
            <input type="hidden" name="classid" value="<?php echo $id ?>">
        </div>
        <br>
        <div class="form-group">
            <input type="submit" name="save" class="btn btn-primary">
        </div>
    </form>
</div>

<?php
//footer
include('admin_footer.php');
?>