<?php
//Import header file
include('lecturer_header.php');
include("../inc/database.php");

//get quiz id
$p=$_POST;


//sql statement for table quiz_list
$sql = "SELECT * FROM quiz_list where title='title'";
//query
$query = $conn->query($sql);
//result
$res=mysqli_fetch_assoc($query);
?>

<div class="container bg-gradient text-light">
    <br>
    <h2>Quiz Form <a href="quiz_list.php" class="btn btn-sm btn-secondary">Back</a></h2>

    <form action="" method="post">
        <div class="form-group">
            <label for="title">Quiz Title</label>
            <input type="text" name="title" class="form-control">

            <label for="points">Points per question</label>
            <input type="number" name="points" min="1" max="10" class="form-control">

            <label for="lecturer">Lecturer</label>
            <select name="lecturer" id="lecturer" class="form-control">
                 <option value="" selected="" disabled="">Select Here</option>
                <?php 
                $qry = $conn->query("SELECT * FROM user WHERE u_access_lvl = 2 ORDER BY user_name ASC");
                while($row_user = $qry->fetch_assoc()) {
                ?>
                <option value="<?php echo $row_user['u_id'] ?>"><?php echo $row_user['user_name'] ?></option>
                <?php }?>
            </select>
        </div>

        <div> 
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Exit</button>
                    <input type="submit" class="btn btn-primary" name="submit" value="Save Quiz"></input>
                                </form>
                    <?php
                        if (isset($_POST['submit'])) {
                            /* receive data from form */
                            $p=$_POST;
                            $title=$p['title'];
                            $point=$p['points'];
                            $id=$p['lecturer'];
                            
                            /* sql statement */
                            $sql_quiz = "INSERT INTO quiz_list (title, points, u_id)
                            VALUES('$title','$point','$id')";
                        
                            if ($conn->query($sql_quiz)) {
                                header("Location:quiz_list.php");
                            } else {
                                die('SQL report error '.$conn->error);
                            }
                        }
                    ?>
        </div>
    </form>
</div>

<style>
    .form-group {
        padding-bottom: 15px;
    }
</style>

<?php
include("lecturer_footer.php")
?>