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

<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js"></script>




        

<div class="container text-light">
    <br>
    <div class="row cards">

        <div class="col-md-4 d-flex justify-content-center text-dark">
            <div class="card text-dark bg-light mb-3 card-coolors1" style="width: 18rem;">
                <div class="card-header">Quiz Total</div>
                <div class="card-body">
                    <h5 class="card-title"><?php echo $call_quiz['totalquiz'] . " total quizzes" ?></h5>
                    <p class="card-text">has been created by lecturers</p>
                </div>
            </div>
        </div>

        <div class="col-md-4 d-flex justify-content-center text-dark">
            <div class="card text-dark bg-light mb-3 card-coolors2" style="width: 18rem;">
                <div class="card-header">Lecturer Total</div>
                <div class="card-body">
                    <h5 class="card-title"><?php echo $call_lecturer['totallecturer'] . " total lecturers" ?></h5>
                    <p class="card-text">are using the system</p>
                </div>
            </div>
        </div>

        <div class="col-md-4 d-flex justify-content-center text-dark">
            <div class="card text-dark bg-light mb-3 card-coolors3" style="width: 18rem;">
                <div class="card-header">Students Total</div>
                <div class="card-body">
                    <h5 class="card-title"><?php echo $call_student['totalstudents'] . " total students" ?></h5>
                    <p class="card-text">are using the system</p>
                </div>
            </div>
        </div>
    </div>
    <br> <br>
    <div class="card text-dark bg-light mb-3" style="max-width:600px; max-height:700px;">
        <canvas id="myChart" style="width:100%;max-width:700px;"></canvas>
    </div>
        
    
    <script>
        var xValues = ["Lecturer", "Students"];
        var yValues = [<?php echo $call_lecturer['totallecturer'] ?>, <?php echo $call_student['totalstudents'] ?>];
        var barColors = [
        "#b91d47",
        "#00aba9"
        ];

        new Chart("myChart", {
            type: "pie",
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