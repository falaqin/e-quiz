<?php
//Import header file
include('lecturer_header.php');

//Import database connection
include('../inc/database.php');

//get id
$id=$_GET['id'];

//get existing data
//sql statement to check existing data
$sql_check="SELECT * FROM student s INNER JOIN class c WHERE std_id='$id' AND c.class_id = s.class_id";

//query sql statement
$query_check=$conn->query($sql_check);

//get result
$rslt=mysqli_fetch_assoc($query_check);

$class = $conn->query("SELECT * FROM class ORDER BY class_id");
$allClassSection = array();
$allClassID = array();
$i = 0;
while ($result=$class->fetch_assoc()) {
    $allClassID[$i] = $result['class_id'];
    $allClassSection[$i] = $result['class_section'];
    $i++;
}

?>
<title>Student Edit Form</title>
<div class="container">
    <br>
    <h2>
        Student Form <a href="student_info.php" class="btn btn-sm btn-secondary">Back</a>
    </h2>

    <form method="post" action="std_edit_submit.php">
        <div class="form-group">
            <input type="hidden" name="stdid" value="<?php echo $id ?>">
        </div>


        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" name="name" id="" class="form-control" value="<?php echo $rslt['std_name'] ?>" required>
        </div>

        <div class="form-group">
            <label for="matric">Matric Number</label>
            <input type="text" name="matric" class="form-control" value="<?php echo $rslt['std_matric'] ?>">
        </div>

        <div class="form-group">
            <label for="username">Username</label>
            <input type="text" name="username" id="" class="form-control" value="<?php echo $rslt['std_username'] ?>" required>
        </div>

        <div class="form-group">
            <label for="Session">Session</label>
            <input type="text" name="session" class="form-control" value="<?php echo $rslt['std_session'] ?>">
        </div>

        <div class="form-group">
            <label for="class">Class</label>
            <select class="form-control class-select" name="class" required>
                <option value="<?php echo $rslt['class_id'] ?>" selected><?php echo $rslt['class_section'] ?></option>
                <?php for ($n=0; $n < count($allClassID) ; $n++) { 
                    if ($rslt['class_id'] <> $allClassID[$n]) { ?>
                        <option value="<?php echo $allClassID[$n] ?>">
                        <?php echo $allClassSection[$n] ?>
                        </option>
                    <?php } ?>
                <?php } ?>
            </select>
        </div>

        <div>
            <input type="submit" name="save" id="" class="btn btn-primary">
        </div>
    </form>
</div>

<script>
    $(".class-select").select2({
    //width: 'responsive' // need to override the changed default
});
</script>

<style>
    .form-group {
        padding-bottom: 15px;
    }
</style>

<div class="fixed-bottom">
<?php
//Import footer file
include('lecturer_footer.php');
?>
</div>