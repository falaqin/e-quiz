<?php 
include("../inc/database.php");

//get other variables for question table
if ($_POST['type'] == 1) {
    $quizid = $_POST['quizid'];
    $questiontxt = $_POST['question'];
    $questiontype = $_POST['type'];
    $answer1 = $_POST['answer1'];
    $answer2 = $_POST['answer2'];
    $answer3 = $_POST['answer3'];
    $answer4 = $_POST['answer4'];

    $isc1 = $_POST['iscorrect'][0];
    if ($isc1 != 1) {
        $isc1 = 0;
    }
    $isc2 = $_POST['iscorrect'][1];
    if ($isc2 != 1) {
        $isc2 = 0;
    }
    $isc3 = $_POST['iscorrect'][2];
    if ($isc3 != 1) {
        $isc3 = 0;
    }
    $isc4 = $_POST['iscorrect'][3];
    if ($isc4 != 1) {
        $isc4 = 0;
    }

    if ($_FILES["image"]["name"] != '') {
        //for question image
        $filename = rand(1000,10000)."-".$_FILES["image"]["name"];
        //$filename = $_FILES["image"]["name"];
        $tempname = $_FILES["image"]["tmp_name"];
        $folder = "../uploads/";
        // Now let's move the uploaded image into the folder: image
        if (move_uploaded_file($tempname, "$folder/$filename"))  {
            echo $msg = "Image uploaded successfully";
            $conn->query("INSERT INTO question(question, question_img, quiz_id, question_type) VALUES ('$questiontxt', '$filename', '$quizid', '$questiontype')");
            
            echo "question with image uploaded";
        } else{
            echo $msg = "Either failed to upload the image or no image has been uploaded.";
        }
    } else {
        $conn->query("INSERT INTO question(question, quiz_id, question_type) VALUES ('$questiontxt','$quizid', '$questiontype')");
        echo "question without image uploaded";
    }

    $questionid = $conn->insert_id;

    $conn->query("INSERT INTO question_option (option_text, question_id, is_right) VALUES ('$answer1', '$questionid', '$isc1')");
    $conn->query("INSERT INTO question_option (option_text, question_id, is_right) VALUES ('$answer2', '$questionid', '$isc2')");
    $conn->query("INSERT INTO question_option (option_text, question_id, is_right) VALUES ('$answer3', '$questionid', '$isc3')");
    $conn->query("INSERT INTO question_option (option_text, question_id, is_right) VALUES ('$answer4', '$questionid', '$isc4')");

    if ($conn->commit()) {
        header("Location: quiz_manage.php?id=$quizid");
    }

} else if ($_POST['type'] == 3) {
    $quizid = $_POST['quizid'];
    $questiontxt = $_POST['question'];
    $questiontype = $_POST['type'];
    $answer1 = $_POST['answer1'];
    $answer2 = $_POST['answer2'];
    $answer3 = $_POST['answer3'];
    $answer4 = $_POST['answer4'];
    $answer5 = $_POST['answer5'];

    $isc1 = $_POST['iscorrect'][0];
    if ($isc1 != 1) {
        $isc1 = 2;
    }
    $isc2 = $_POST['iscorrect'][1];
    if ($isc2 != 1) {
        $isc2 = 2;
    }
    $isc3 = $_POST['iscorrect'][2];
    if ($isc3 != 1) {
        $isc3 = 2;
    }
    $isc4 = $_POST['iscorrect'][3];
    if ($isc4 != 1) {
        $isc4 = 2;
    }
    $isc5 = $_POST['iscorrect'][4];
    if ($isc5 != 1) {
        $isc5 = 2;
    }

    echo $questiontype;
    echo $isc1 . $isc2 . $isc3 . $isc4 . $isc5; 

    if ($_FILES["image"]["name"] != '') {
        //for question image
        $filename = rand(1000,10000)."-".$_FILES["image"]["name"];
        //$filename = $_FILES["image"]["name"];
        $tempname = $_FILES["image"]["tmp_name"];
        $folder = "../uploads/";
        // Now let's move the uploaded image into the folder: image
        if (move_uploaded_file($tempname, "$folder/$filename"))  {
            echo $msg = "Image uploaded successfully";
            $conn->query("INSERT INTO question(question, question_img, quiz_id, question_type) VALUES ('$questiontxt', '$filename', '$quizid', '$questiontype')");
            
            echo "question with image uploaded";
        } else{
            echo $msg = "Either failed to upload the image or no image has been uploaded.";
        }
    } else {
        $conn->query("INSERT INTO question(question, quiz_id, question_type) VALUES ('$questiontxt','$quizid', '$questiontype')");
        echo "question without image uploaded";
    }

    $questionid = $conn->insert_id;

    $conn->query("INSERT INTO question_option (option_text, question_id, is_right) VALUES ('$answer1', '$questionid', '$isc1')");
    $conn->query("INSERT INTO question_option (option_text, question_id, is_right) VALUES ('$answer2', '$questionid', '$isc2')");
    $conn->query("INSERT INTO question_option (option_text, question_id, is_right) VALUES ('$answer3', '$questionid', '$isc3')");
    $conn->query("INSERT INTO question_option (option_text, question_id, is_right) VALUES ('$answer4', '$questionid', '$isc4')");
    $conn->query("INSERT INTO question_option (option_text, question_id, is_right) VALUES ('$answer5', '$questionid', '$isc5')");

    if ($conn->commit()) {
        header("Location: quiz_manage.php?id=$quizid");
    }

}

?>