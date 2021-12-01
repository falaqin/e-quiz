<?php
include("admin_header.php");
include("../inc/database.php");

$test = '<div class="form-group">
<label for="name">Name</label>
<input type="text" name="name" id="" class="form-control" required>
</div>';

$sql = "SELECT * FROM question WHERE id = '25'";
$res = mysqli_query($conn,  $sql);
$images = mysqli_fetch_assoc($res);
if (isset($_POST['save'])) {
    $namearray = array();
    array_push($namearray ,$_POST['name']);
    foreach ($namearray as $name) {
        echo $name;
    }
}
?>

<div class="container text-light">
    <a href="#addmore" data-bs-toggle="modal" class="btn btn-sm btn-success">Add More</a>   
    
    <form action="" method="post">
        <br>
        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" name="name[]" id="" class="form-control">
        </div>
        <input type="submit" name="save">
        <?php  ?>
        <?php
        if (isset($_POST['test'])) {
            for ($i=0; $i < $_POST['amountuser'] ; $i++) { 
                echo $test;
            }
        }
        ?>
    </form>
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
                    <input type="number" name="amountuser" class="form-control">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <input type="submit" name="test" class="btn btn-success">
                </div>
            </form>
        </div>
    </div>
</div>

<div class="container">
    <select class="states form-control" name="states[]" multiple="multiple">
        <option value="">Select Here Bro</option>
        <option value="">It's here Bro</option>
        <option value="">Damn this MF try so hard</option>
        <option value="">To get select2 working :skull:</option>
    </select>
</div>

<script>
    $(document).ready(function() {
    $('.states').select2();
});
</script>

<?php include("admin_footer.php") ?>