<?php
//import header
include("admin_header.php");

//import db con
include('../inc/database.php');

//sql statement
$sql_total_quiz = "SELECT COUNT(id) AS totalquiz FROM quiz_list";
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
<title>Admin Dashboard</title>

<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js"></script>

<style>
    .card-coolors1 {
    background: linear-gradient(to right, #D0D1FF, #C8E7FF);
}

    .card-coolors2 {
        background: linear-gradient(to right, #C8E7FF, #C0FDFF);
    }

    .card-coolors3 {
        background: linear-gradient(to right, #D0D1FF, #DEAAFF);
    }
</style>

<link href="../student/carousel.css" rel="stylesheet">

<div class="container text-light">
    <br>
    <h3>Dashboard</h3>
    <div id="myCarousel" class="carousel slide shadow" data-bs-ride="carousel">
    <div class="carousel-indicators">
      <button type="button" data-bs-target="#myCarousel" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
      <button type="button" data-bs-target="#myCarousel" data-bs-slide-to="1" aria-label="Slide 2"></button>
      <button type="button" data-bs-target="#myCarousel" data-bs-slide-to="2" aria-label="Slide 3"></button>
    </div>
    <div class="carousel-inner">
      <div class="carousel-item active">
        <img src="../assets/student_studying1.jpg" alt="">

        <div class="container">
          <div class="carousel-caption text-start">
            <h1>Administrators can have it easy.</h1>
            <p>
                CSV files can be imported into the database! <br>
                <a href="user_info.php?page=1" class="btn btn-outline-light">User</a>
                <a href="student_info.php?page=1" class="btn btn-outline-light">Student</a>
            </p>
          </div>
        </div>
      </div>
      <div class="carousel-item">
      <img src="../assets/student_studying2.png" alt="">

        <div class="container">
          <div class="carousel-caption">
            <h1>Not your ordinary quiz app.</h1>
            <p>Have access for everything. Including students' full names.</p>
          </div>
        </div>
      </div>
      <div class="carousel-item">
        <img src="../assets/student_studying3.png" alt="">
        <div class="container">
          <div class="carousel-caption text-end">
            <h1>One more for good measure.</h1>
            <p>No more headaches. Hello simplicity!</p>
          </div>
        </div>
      </div>
    </div>
    <button class="carousel-control-prev" type="button" data-bs-target="#myCarousel" data-bs-slide="prev">
      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
      <span class="visually-hidden">Previous</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#myCarousel" data-bs-slide="next">
      <span class="carousel-control-next-icon" aria-hidden="true"></span>
      <span class="visually-hidden">Next</span>
    </button>
  </div>
  <hr>
    <div class="row">

        <div class="col-12 col-sm-6 col-xxl-3 d-flex">
            <div class="card text-dark bg-light mb-3 shadow" style="width: 18rem;">
                <div class="card-header">Welcome back!</div>
                <div class="card-body">
                    <h5 class="card-title">Start a new day</h5>
                    <p class="card-text">and have a great day!</p>
                </div>
            </div>
        </div>

        <div class="col-12 col-sm-6 col-xxl-3 d-flex">
            <div class="card text-dark bg-light mb-3 shadow" style="width: 18rem;">
                <div class="card-header">Quiz Total</div>
                <div class="card-body">
                    <h5 class="card-title"><?php echo $call_quiz['totalquiz'] . " total quizzes" ?></h5>
                    <p class="card-text">has been created by lecturers</p>
                    <a href="reports.php" class="btn btn-outline-secondary">See Quiz</a>
                    </div>
            </div>
        </div>

        <div class="col-12 col-sm-6 col-xxl-3 d-flex">
            <div class="card text-dark bg-light mb-3 shadow" style="width: 18rem;">
                <div class="card-header">Lecturer Total</div>
                <div class="card-body">
                    <h5 class="card-title"><?php echo $call_lecturer['totallecturer'] . " total lecturers" ?></h5>
                    <p class="card-text">are using the system</p>
                </div>
            </div>
        </div>

        <div class="col-12 col-sm-6 col-xxl-3 d-flex">
            <div class="card text-dark bg-light mb-3 shadow" style="width: 18rem;">
                <div class="card-header">Students Total</div>
                <div class="card-body">
                    <h5 class="card-title"><?php echo $call_student['totalstudents'] . " total students" ?></h5>
                    <p class="card-text">are using the system</p>
                </div>
            </div>
        </div>
    </div>
    <br> <hr>
    <div class="card text-dark bg-light mb-3 shadow" style="max-width:600px; max-height:700px;">
        <canvas id="myChart" style="max-width:700px;"></canvas>
    </div>
        
    
    <script>
        var xValues = ["Lecturer", "Students"];
        var yValues = [<?php echo $call_lecturer['totallecturer'] ?>, <?php echo $call_student['totalstudents'] ?>];
        var barColors = [
        "#b91d47",
        "#00aba9"
        ];

        new Chart("myChart", {
            type: "doughnut",
            data: {
                labels: xValues,
                datasets: [{
                backgroundColor: barColors,
                data: yValues
                }]
            },
            options: {
                title: {
                display: true,
                text: "Students and Lecturers Total"
                }
            }
        });
    </script>
</div>


<?php
//import footer
include("admin_footer.php");
?>