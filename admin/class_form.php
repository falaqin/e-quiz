<?php
//import header
include('admin_header.php');

//import data cons
include('../inc/database.php');
?>
<title>Add Class Form</title>

<div class="container text-light">
    <br>
    <h2 class="bi bi-folder">
        Class Form <a href="class_info.php?page=1" class="btn btn-sm btn-secondary">Back</a>
    </h2>
    
    <div class="container text-light row">
        <form action="class_add.php" method="post">
            <div class="card text-dark col-md-4 d-flex shadow" style="width:inherit">
                <div class="card-body">
                    <div class="form-group">
                        <label for="class">Class Name</label>
                        <input type="text" name="class" class="form-control" required>
                    </div>
                </div>
                <div class="card-footer">
                    <input type="submit" name="save" class="btn btn-primary">
                </div>
            </div>
        </form>
    </div>

</div>

<div class="fixed-bottom">
<?php
//footer
include('admin_footer.php');
?>
</div>