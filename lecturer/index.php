<?php 
	//Import database connection
    include('../inc/database.php');

    //Import header file
    include('lecturer_header.php');

    //sql statement
$sql_total_quiz = "SELECT COUNT(id) AS totalquiz FROM quiz_list WHERE u_id = 4";
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


<style>

h1 {text-align: center;}   
h2 {text-align: center;} 

</style>

<div class="container text-light">
    <br>
    <div class="row cards">

        <div class="col-md-4 d-flex justify-content-center text-dark">
            <div class="card text-light bg-dark mb-3 card-coolors1" style="width: 18rem;">
                <div class="card-header">Quiz Total</div>
                <div class="card-body">
                    <h5 class="card-title"><?php echo $call_quiz['totalquiz'] . " total quizzes" ?></h5>
                    <p class="card-text">has been created by <?php echo $call['user_name']. "." ?></p>
                </div>
            </div>
        </div>

        <div class="col-md-4 d-flex justify-content-center text-dark">
            <div class="card text-light bg-dark mb-3 card-coolors2" style="width: 18rem;">
                <div class="card-header">Lecturer Total</div>
                <div class="card-body">
                    <h5 class="card-title"><?php echo $call_lecturer['totallecturer'] . " total lecturers" ?></h5>
                    <p class="card-text">are using the system</p>
                </div>
            </div>
        </div>

        <div class="col-md-4 d-flex justify-content-center text-dark">
            <div class="card text-light bg-dark mb-3 card-coolors3" style="width: 18rem;">
                <div class="card-header">Students Total</div>
                <div class="card-body">
                    <h5 class="card-title"><?php echo $call_student['totalstudents'] . " total students" ?></h5>
                    <p class="card-text">are using the system</p>
                </div>
            </div>
        </div>
    </div>
    <br> <br>
    
    
    <h1 > Benefits of E-QUIZ SYSTEM</h1>
    <h2>Here are some advantages of E-QUIZ System. Taking online quizzes is becoming a huge success. But why is this such a huge success? What integrates people to use online quizzes instead of written quizzes? This article will tell you why this such a popular tool to use. And you may even want to do it yourself :)</h2>
    <br>
    
    <h1 > What is Quiz ? </h1>
    <h2>What does a quiz really mean? A quiz is usually a short test, and often doesn’t have a huge impact on your grades as a test has. Some teachers may even not use the quiz grade at all to determine your course grade. Quizzes are often several times given by teachers throughout a course. It’s an easy way to keep track of your students and have an insight into the gaps of knowledge. It gives both the teacher and student a reflection. It shows students on what subject they have to focus. There are different kinds of questions that can be used for quizzes. Some examples are: fill-in-the blanks, multiple choice and true or false. It’s even possible to have image answers.</h2>
        
    
   
</div>


<?php
    //Import header file
    include('lecturer_footer.php');
?>