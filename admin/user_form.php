<?php
//import header
include('admin_header.php');

//import data cons
include('../inc/database.php');

//for looping
$loopinput = '<div class="card text-dark col-md-4 d-flex shadow" style="width: inherit;">
<div class="card-body">
    <div class="form-group">
        <label for="name">Name</label>
        <input type="text" name="name[]" id="" class="form-control" required>
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
        <label for="access_level">Access Level</label>
        <select name="access_level[]" id="access_level" class="form-control" required>
            <option value="">Please Choose</option>
            <option value="1">Admin</option>
            <option value="2">Teacher</option>
        </select>
    </div>
</div>
</div>
<br>';
?>
<title>Add User Form</title>
<div class="container text-light"> 
    <br>
    <h2 class="bi bi-file-person">
        User Form <a href="#addmore" data-bs-toggle="modal" class="btn btn-sm btn-info">Add More</a>
    </h2>
    <div class="container text-light row">
        <form method="post" action="add_user.php">
            <div class="card text-dark col-md-4 d-flex shadow" style="width: inherit;">
                <div class="card-body">
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" name="name[]" id="" class="form-control" required>
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
                        <label for="access_level">Access Level</label>
                        <select name="access_level[]" id="access_level" class="form-control" required>
                            <option value="">Please Choose</option>
                            <option value="1">Admin</option>
                            <option value="2">Teacher</option>
                        </select>
                    </div>
                </div>
            </div>
            <br>
            <?php if(isset($_POST['test'])) {
                for ($i=0; $i < $_POST['amountuser'] - 1 ; $i++) { 
                    echo $loopinput;
                }
            } ?>
            <div class="card text-dark shadow">
                <div class="card-body">
                    <a href="user_info.php?page=1" class="btn btn-secondary">Back</a>
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
                <h5 class="modal-title">Add more users</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="" method="post">
                <div class="modal-body">
                    <label for="amountuser">Enter amount of users</label>
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
//footer
include('admin_footer.php');
?>