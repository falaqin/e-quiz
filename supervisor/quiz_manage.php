<?php
//header
include('sv_header.php');

//db con
include('../inc/database.php');

//get quiz id
$id = $_GET['id'];

//sql statement for table quiz_list
$sql = "SELECT * FROM quiz_list where quiz_id='$id'";
//query
$query = $conn->query($sql);
//result
$res=mysqli_fetch_assoc($query);
?>

<div class="container text-light">
    <br>
    <h2>Title: <?php echo $res['quiz_title'] ?></h2>

    <!-- Button trigger modal -->
    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
    Add Question
    </button>

    <!-- Modal -->
    <div class="modal fade text-dark" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add Question</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="" method="post">
                    <div class="form-group">
                        <label for="question">Question</label>
                        <input type="text" name="question" class="form-control">
                    </div>

                    <div class="form-group">
                        <label for="answer1">Answer</label>
                        <input type="text" name="answer1" class="form-control">
                        <input type="radio" name="correct1" id="">
                        <label for="correct1">Correct answer</label>
                    </div>

                    <div class="form-group">
                        <label for="answer2">Answer</label>
                        <input type="text" name="answer2" class="form-control">
                        <input type="radio" name="correct2" id="">
                        <label for="correct2">Correct answer</label>
                    </div>

                    <div class="form-group">
                        <label for="answer3">Answer</label>
                        <input type="text" name="answer3" class="form-control">
                        <input type="radio" name="correct3" id="">
                        <label for="correct3">Correct answer</label>
                    </div>

                    <div class="form-group">
                        <label for="answer4">Answer</label>
                        <input type="text" name="answer4" class="form-control">
                        <input type="radio" name="correct4" id="">
                        <label for="correct4">Correct answer</label>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button>
            </div>
            </div>
        </div>

        <div>
            
        </div>
    </div>

    <style>
        .form-group {
            padding-bottom: 15px;
        }
    </style>
</div>