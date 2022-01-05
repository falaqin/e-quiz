<?php
include("../inc/database.php");

if ($_POST['type'] == 1) {
    $questionid = $_POST['questionid'];

    $SQLoption = "SELECT * FROM question_option WHERE question_id = $questionid";
    $queryOption = $conn->query($SQLoption);

    $questiontext = $_POST['question'];

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

    echo $isc1;
    echo $isc2;
    echo $isc3;
    echo $isc4;
    echo $answer0 = $_POST['answer0'];
    echo $answer1 = $_POST['answer1'];
    echo $answer2 = $_POST['answer2'];
    echo $answer3 = $_POST['answer3'];

    while ($callOption = mysqli_fetch_assoc($queryOption)) {
        $id[] = $callOption['id'];
    }

    $dir = "../uploads/";
    $old_image = $_POST['old_image'];


    if ($_FILES["new_image"]["name"] != '') {
        unlink($dir . $old_image);
        //for question image
        $filename = rand(1000,10000)."-".$_FILES["new_image"]["name"];
        $tempname = $_FILES["new_image"]["tmp_name"];
        $folder = "../uploads/";

        // Now let's move the uploaded image into the folder: image
        if (move_uploaded_file($tempname, "$folder/$filename"))  {
            $conn->query("UPDATE question SET question = '$questiontext', question_img = '$filename' WHERE id = '$questionid'");
            

        } else {
            echo $msg = "Either failed to upload the image or no image has been uploaded.";
        }
    } else {
        $conn->query("UPDATE question SET question = '$questiontext' WHERE id = '$questionid'");
        echo "question without image updated";
    }

    $conn->query("UPDATE question_option SET option_text = '". $_POST['answer0'] ."', is_right = '$isc1' WHERE id = '$id[0]'");
    $conn->query("UPDATE question_option SET option_text = '".$_POST['answer1']."', is_right = '$isc2' WHERE id = '$id[1]'");
    $conn->query("UPDATE question_option SET option_text = '".$_POST['answer2']."', is_right = '$isc3' WHERE id = '$id[2]'");
    $conn->query("UPDATE question_option SET option_text = '".$_POST['answer3']."', is_right = '$isc4' WHERE id = '$id[3]'");

    if($conn->commit())
    {
        echo "it works";
        header("Location:quiz_manage.php?id=".$_POST['quizid']."");
    }

} elseif ($_POST['type'] == 3) {
    $questionid = $_POST['questionid'];

    $SQLoption = "SELECT * FROM question_option WHERE question_id = $questionid";
    $queryOption = $conn->query($SQLoption);

    $questiontext = $_POST['question'];

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
    $isc5 = $_POST['iscorrect'][4];
    if ($isc5 != 1) {
        $isc5 = 0;
    }

    echo $isc1;
    echo $isc2;
    echo $isc3;
    echo $isc4;
    echo $isc5;
    echo $answer0 = $_POST['answer0'];
    echo $answer1 = $_POST['answer1'];
    echo $answer2 = $_POST['answer2'];
    echo $answer3 = $_POST['answer3'];
    echo $answer4 = $_POST['answer4'];

    while ($callOption = mysqli_fetch_assoc($queryOption)) {
        $id[] = $callOption['id'];
    }

    $dir = "../uploads/";
    $old_image = $_POST['old_image'];

    print_r($id);

    if ($_FILES["new_image"]["name"] != '') {
        unlink($dir . $old_image);
        //for question image
        $filename = rand(1000,10000)."-".$_FILES["new_image"]["name"];
        $tempname = $_FILES["new_image"]["tmp_name"];
        $folder = "../uploads/";

        // Now let's move the uploaded image into the folder: image
        if (move_uploaded_file($tempname, "$folder/$filename"))  {
            $conn->query("UPDATE question SET question = '$questiontext', question_img = '$filename' WHERE id = '$questionid'");
            

        } else {
            echo $msg = "Image question Failed!";
        }
    } else {
        $conn->query("UPDATE question SET question = '$questiontext' WHERE id = '$questionid'");
        echo "question without image updated";
    }

    $conn->query("UPDATE question_option SET option_text = '". $_POST['answer0'] ."', is_right = '$isc1' WHERE id = '$id[0]'");
    $conn->query("UPDATE question_option SET option_text = '".$_POST['answer1']."', is_right = '$isc2' WHERE id = '$id[1]'");
    $conn->query("UPDATE question_option SET option_text = '".$_POST['answer2']."', is_right = '$isc3' WHERE id = '$id[2]'");
    $conn->query("UPDATE question_option SET option_text = '".$_POST['answer3']."', is_right = '$isc4' WHERE id = '$id[3]'");
    $conn->query("UPDATE question_option SET option_text = '".$_POST['answer4']."', is_right = '$isc5' WHERE id = '$id[4]'");

    if($conn->commit())
    {
        echo "it works";
        header("Location:quiz_manage.php?id=".$_POST['quizid']."");
    }

}
?>