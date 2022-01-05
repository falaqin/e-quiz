<?php
include("./inc/database.php");
include("lecturer_header.php");

$id = $_GET['id'];
?>

<div class="container">
    <br>
    <div class="card shadow">
        <div class="card-header">
            <h1 class="bi bi-pencil-square"> Add question</h1>
        </div>
        <form action="quiz image upload.php" method="post" enctype="multipart/form-data">
            <input type="hidden" name="id" value="<?php echo $id ?>">
            <input type="hidden" name="type" value="2">
            <div class="card-body">
                <div class="col-12">
                    <label class="form-label">Question</label>
                    <textarea class="form-control" name="question" cols="30" rows="5"></textarea>
                </div>
                <br>
                <div class="col-12">
                    <label class="form-label">First Image</label>
                    <input type="file" name="image1" class="form-control">
                    <input type="checkbox" name="iscorrect1" value="1">
                    <label>Tick if correct answer.</label>
                </div>
                <br>
                <div class="col-12">
                    <label class="form-label">Second Image</label>
                    <input type="file" name="image2" class="form-control">
                    <input type="checkbox" name="iscorrect2" value="1">
                    <label>Tick if correct answer.</label>
                </div>
                <br>
                <div class="col-12">
                    <label class="form-label">Third Image</label>
                    <input type="file" name="image3" class="form-control">
                    <input type="checkbox" name="iscorrect3" value="1">
                    <label>Tick if correct answer.</label>
                </div>
                <br>
                <div class="col-12">
                    <label class="form-label">Fourth Image</label>
                    <input type="file" name="image4" class="form-control">
                    <input type="checkbox" name="iscorrect4" value="1">
                    <label">Tick if correct answer.</label>
                </div>
                <br>
                <div class="col-12">
                    <label class="form-label">Fifth Image</label>
                    <input type="file" name="image5" class="form-control">
                    <input type="checkbox" name="iscorrect5" value="1">
                    <label">Tick if correct answer.</label>
                </div>
            </div>
            <div class="card-footer">
                <input type="submit" value="Add Question" class="btn btn-sm btn-primary shadow">
        </form>
            <a href="quiz_manage.php?id=<?php echo $id ?>" class="btn btn-sm btn-secondary shadow">Back</a>
        </div>
    </div>
</div>

<?php
include("lecturer_footer.php");
?>