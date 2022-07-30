<?php
//Import header file
include('admin_header.php');

//Import database connection
include('../inc/database.php');

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
<title>Add Student Form</title>
<div class="container text-light">
    <br>
    <h2 class="bi bi-file-person">
        Student Form <a href="#addmore" data-bs-toggle="modal" class="btn btn-sm btn-info">Add More</a>
    </h2>

    <div class="container text-light">
        <form method="post" action="add_std.php">
            <div class="card text-dark col-md-4 d-flex shadow" style="width: inherit;">
                <div class="card-body">
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" name="name[]" id="" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label for="matrix">IC Number</label>
                        <input type="text" name="matrix[]" id="" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label for="username">Username</label>
                        <input type="text" name="username[]" id="" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" name="password[]" id="" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label for="session">Session</label>
                        <input type="text" name="session[]" id="" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label for="class">Class</label>
                        <select class="form-control class-select" name="class[]" required>
                            <option value="" disabled selected>Select Here</option>
                            <?php for ($n=0; $n < count($allClassID) ; $n++) { ?>
                                <option value="<?php echo $allClassID[$n] ?>"><?php echo $allClassSection[$n] ?></option>
                            <?php } ?>
                        </select>
                    </div>
                </div>
            </div>
            <br>
            
            <?php if(isset($_POST['test'])) {
                for ($i=0; $i < $_POST['amountuser'] - 1 ; $i++) { ?>
                    <div class="card text-dark col-md-4 d-flex shadow" style="width: inherit;">
                        <div class="card-body">
                            <div class="form-group">
                                <label for="name">Name</label>
                                <input type="text" name="name[]" id="" class="form-control" required>
                            </div>

                            <div class="form-group">
                                <label for="matrix">Matrics Number</label>
                                <input type="text" name="matrix[]" id="" class="form-control" required>
                            </div>

                            <div class="form-group">
                                <label for="username">Username</label>
                                <input type="text" name="username[]" id="" class="form-control" required>
                            </div>

                            <div class="form-group">
                                <label for="password">Password</label>
                                <input type="password" name="password[]" id="" class="form-control" required>
                            </div>

                            <div class="form-group">
                                <label for="session">Session</label>
                                <input type="text" name="session[]" id="" class="form-control" required>
                            </div>

                            <div class="form-group">
                                <label for="class">Class</label>
                                <select class="form-control class-select" name="class[]" required>
                                    <option value="" disabled selected>Select Here</option>
                                    <?php for ($n=0; $n < count($allClassID) ; $n++) { ?>
                                        <option value="<?php echo $allClassID[$n] ?>"><?php echo $allClassSection[$n] ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                    </div>
                    <br>
                <?php } ?>
            <?php } ?>
            <div class="card text-dark shadow">
                <div class="card-body">
                    <a href="student_info.php?page=1" class="btn btn-secondary">Back</a>
                    <input type="submit" name="save" id="" class="btn btn-primary">
                </div>
            </div>
        </form>
    </div>
</div>

<div class="modal fade" id="addmore" aria-labelledby="exampleModalLabel" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add more students</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="" method="post">
                <div class="modal-body">
                    <label for="amountuser">Enter amount of students</label>
                    <input type="number" name="amountuser" class="form-control" value="1" min="1" max="100">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <input type="submit" name="test" class="btn btn-success">
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    $(".class-select").select2({
    //width: 'responsive' // need to override the changed default
});
</script>

<style>
    .form-group
    {
        margin-bottom: 10px;
    }
</style>

<?php
//Import footer file
include('admin_footer.php');
?>