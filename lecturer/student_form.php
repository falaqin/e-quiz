<?php
//Import header file
include('lecturer_header.php');

//Import database connection
include('../inc/database.php');

//for looping
$loopinput = '<div class="card text-dark col-md-4 d-flex" style="width: 30rem;">
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
</div>
</div>
<br>';
?>

<div class="container bg-gradient text-light">
    <br>
    <h2>
        Student Form <a href="#addmore" data-bs-toggle="modal" class="btn btn-sm btn-info">Add More</a>
    </h2>

    <div class="container text-light row">
        <form method="post" action="student_add.php" style="width: 500px;">
            <div class="card text-dark col-md-4 d-flex" style="width: 30rem;">
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
                </div>
            </div>
            <br>
            <?php if(isset($_POST['test'])) {
                for ($i=0; $i < $_POST['amountuser'] - 1 ; $i++) { 
                    echo $loopinput;
                }
            } ?>
            <div class="card text-dark">
                <div class="card-body">
                    <a href="student_info.php" class="btn btn-secondary">Back</a>
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

<style>
    .form-group
    {
        margin-bottom: 10px;
    }
</style>

<?php
//Import footer file
include('lecturer_footer.php');
?>