<?php
include("../inc/database.php");
include("admin_header.php");

$id = $_GET['id'];
$class = $_GET['class'];

$sql = "SELECT title FROM quiz_list WHERE id = $id";
$query = $conn->query($sql);
$callTitle = mysqli_fetch_assoc($query);
$quizTitle = $callTitle['title'];

$sqlMarks = "SELECT sc.std_points, sc.total_points, s.std_matric, s.std_name FROM student_quiz sq JOIN student_score sc, student s WHERE sq.quiz_id = sc.quiz_id AND s.std_id = sc.std_id AND sq.class_id = s.class_id AND sq.class_id = $class AND sq.quiz_id = $id";
$queryMarks = $conn->query($sqlMarks);

$sqlMarksTable = "SELECT sc.std_points, sc.total_points, s.std_matric, s.std_name FROM student_quiz sq JOIN student_score sc, student s WHERE sq.quiz_id = sc.quiz_id AND s.std_id = sc.std_id AND sq.class_id = s.class_id AND sq.class_id = $class AND sq.quiz_id = $id";
$queryMarksTable = $conn->query($sqlMarksTable);
?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.5.0/Chart.min.js"></script>
<br>
<div class="container">
    <div class="card shadow">
        <div class="card-body">
            <h5 class="card-title bi bi-pencil-square"> Results for <?php echo $quizTitle ?> <a href="reports.php" class="btn btn-sm btn-secondary shadow">Back</a></h5>
            <h6 class="card-subtitle mb-2 text-muted">Table and graph provided.</h6>
            <p class="card-text">The bar graph belows show the amount of marks students visually.</p>
            
            <div class="mask d-flex align-items-center h-100">
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="card shadow">
                            <div class="card-body p-0">
                                <canvas id="myChart" style="width:100%; max-width:1236px;"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <br>
            <p class="card-text">Table for students marks in detail with name.</p>
            <section class="intro">
                <div>
                    <div class="mask d-flex align-items-center h-100">
                        <div class="container">
                            <div class="row justify-content-center">
                                <div class="col-12">
                                    <div class="card shadow">
                                        <div class="card-body p-0">
                                            <div class="table-responsive table-scroll" data-mdb-perfect-scrollbar="true" style="position: relative; height: 400px">
                                                <table class="table table-striped mb-0">
                                                    <thead style="background-color: #002d72;">
                                                        <tr>
                                                            <th scope="col">Student Name</th>
                                                            <th scope="col">Student Matric</th>
                                                            <th scope="col">Student Mark</th>
                                                            <th scope="col">Total Mark</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php
                                                        while ($callMarksTable = mysqli_fetch_assoc($queryMarksTable)):
                                                        ?>
                                                        <tr>
                                                            <td><?php echo $callMarksTable['std_name'] ?></td>
                                                            <td><?php echo $callMarksTable['std_matric'] ?></td>
                                                            <td><?php echo $callMarksTable['std_points'] ?></td>
                                                            <td><?php echo $callMarksTable['total_points'] ?></td>
                                                        </tr>
                                                        <?php endwhile; ?>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <br>
            <a href="quiz_table_pdf.php?class=<?php echo $class ?>&id=<?php echo $id ?>" class="btn btn-sm btn-primary shadow">Download PDF</a>
        </div>
    </div>
</div>

<?php
$stdArray = array();
$pointArray = array();
while ($callMarks = mysqli_fetch_assoc($queryMarks)):
    $matric = $callMarks['std_matric'];
    $marks = $callMarks['std_points'];

    $stdArray[] = "'$matric'";
    $pointArray[] = "'$marks'";
endwhile;
?>
<script>
    var xValues = [<?php echo implode(", ", $stdArray) ?>];
    var yValues = [<?php echo implode(", ", $pointArray) ?>];

    new Chart("myChart", {
    type: "bar",
    data: {
        labels: xValues,
        datasets: [{
        backgroundColor: "blue",
        data: yValues
        }]
    },
    options: {
        legend: {display: false},
        title: {
        display: true,
        text: "<?php echo $quizTitle ?>"
        }
    }
    });
</script>

<?php include("admin_footer.php") ?>