<?php
include("../inc/database.php");
include("std_header.php");

$sqlHistory = "SELECT ql.title, sc.date_updated,   sc.std_points, sc.total_points FROM quiz_list ql INNER JOIN student_score sc WHERE ql.id = sc.quiz_id AND sc.std_id = $SQLstd_id ORDER BY sc.id DESC";
$queryHistory = $conn->query($sqlHistory);
?>

<title>Student History Quiz</title>

<div class="container">
    <br>
    <h1>Your Quiz History</h1>
    <br>
    <div class="alert alert-danger shadow" style="max-width: 500px;">If your total mark is 0, it means you have broken the rules.</div>
    <section class="intro">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-12">
                    <div class="card bg-dark shadow-2-strong shadow-lg">
                        <div class="card-body">
                            <div class="table-responsive" style="max-height: 500px;">
                            <table class="table table-dark table-borderless mb-0">
                                <thead>
                                    <tr>
                                        <th scope="col">QUIZ TITLE</th>
                                        <th scope="col">POINTS RECEIVED</th>
                                        <th scope="col">TOTAL POINTS</th>
                                        <th scope="col">DATE ANSWERED</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php while ($callHistory = mysqli_fetch_assoc($queryHistory)): ?>
                                    <tr>
                                        <th scope="row"><?php echo $callHistory['title'] ?></th>
                                        <td><?php echo $callHistory['std_points'] ?></td>
                                        <td><?php echo $callHistory['total_points'] ?></td>
                                        <td><?php echo $callHistory['date_updated'] ?></td>
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
    </section>
    <br>
</div>

<style>
    html,
    body,
    .intro {
        height: 100%;
    }

    table td,
    table th {
        text-overflow: ellipsis;
        white-space: nowrap;
        overflow: hidden;
    }

    thead th,
    tbody th {
        color: #fff;
    }

    tbody td {
        font-weight: 500;
        color: rgba(255,255,255,.65);
    }

    .card {
        border-radius: .5rem;
    }
</style>

<div class="fixed-bottom">
<?php
include("std_footer.php");
?>
</div>