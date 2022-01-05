<?php 
	//Import database connection
    include('../inc/database.php');

    //Import header file
    include('lecturer_header.php');

    //sql statement
$sql_total_quiz = "SELECT COUNT(id) AS totalquiz FROM quiz_list WHERE u_id = $user_id";
$sql_total_lecturer = "SELECT COUNT(u_id) AS totallecturer FROM user WHERE u_access_lvl = 2";
$sql_total_students = "SELECT COUNT(std_id) AS totalstudents FROM student";

//run query
$query_quiz=$conn->query($sql_total_quiz);
$query_lecturer=$conn->query($sql_total_lecturer);
$query_student=$conn->query($sql_total_students);

//add variable for query to call
$call_quiz=mysqli_fetch_assoc($query_quiz);
$call_lecturer=mysqli_fetch_assoc($query_lecturer);
$call_student=mysqli_fetch_assoc($query_student);
?>	

<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js"></script>

<div class="container text-light">
    <br>
    <div class="row cards">

        <div class="col-12 col-sm-6 col-xxl-3 d-flex">
            <div class="card text-light bg-dark mb-3 shadow" style="width: 18rem;">
                <div class="card-header">Welcome back,</div>
                <div class="card-body">
                    <h5 class="card-title"><?php echo $call['user_name']. "." ?></h5>
                    <p class="card-text">and have a great day!</p>
                </div>
            </div>
        </div>

        <div class="col-12 col-sm-6 col-xxl-3 d-flex">
            <div class="card text-light bg-dark mb-3 shadow" style="width: 18rem;">
                <div class="card-header">Quiz Total</div>
                <div class="card-body">
                    <h5 class="card-title"><?php echo $call_quiz['totalquiz'] . " total quizzes" ?></h5>
                    <p class="card-text">has been created by <?php echo $call['user_name']. "." ?></p>
                </div>
            </div>
        </div>

        <div class="col-12 col-sm-6 col-xxl-3 d-flex">
            <div class="card text-light bg-dark mb-3 shadow" style="width: 18rem;">
                <div class="card-header">Students Total</div>
                <div class="card-body">
                    <h5 class="card-title"><?php echo $call_student['totalstudents'] . " total students" ?></h5>
                    <p class="card-text">are using the system</p>
                </div>
            </div>
        </div>

        <div class="col-12 col-sm-6 col-xxl-3 d-flex">
            <div class="card text-light bg-dark mb-3 shadow" style="width: 18rem;">
                <div class="card-header">Start creating a quiz</div>
                <div class="card-body">
                    <h5 class="card-title">By clicking this button!</h5>
                    <p class="card-text"><a href="quiz_list.php" class="btn btn-sm btn-primary">Quiz List</a></p>
                </div>
            </div>
        </div>
    </div>
    <hr>
    
    <br> <br>

    <div class="container py-4">
        <div class="p-5 mb-4 bg-light text-dark rounded-3">
        <div class="container-fluid py-5">
            <h1 class="display-5 fw-bold">Quiz Reports and Results</h1>
            <p class="col-md-8 fs-4">By using this E-Quiz system, you can check the results of quiz in detail.</p>
            <a href="reports.php" class="btn btn-primary btn-lg">Reports</a>
        </div>
        </div>

        <div class="row align-items-md-stretch">
        <div class="col-md-6">
            <div class="h-100 p-5 text-white bg-dark rounded-3">
            <h2>Students Section</h2>
            <p>You can check the students section, adding new students, or update the student's classes!</p>
            <a href="student_info.php" class="btn btn-outline-light">Student Info</a>
            </div>
        </div>
        <div class="col-md-6">
            <div class="h-100 p-5 bg-light border rounded-3 text-dark">
            <h2>Or, you can..</h2>
            <p>Add new classes! If there is some sort of an overflow in students amount, you can always create new classes.</p>
            <a href="class_info.php" class="btn btn-outline-secondary">Class Info</a>
            </div>
        </div>
        </div>
    </div>
</div>


<?php
    //Import header file
    include('lecturer_footer.php');
?>