<?php
include("../inc/database.php");

echo $quizID = $_POST['quizid'];
echo $questionID = $_POST['questionid'];
echo $questiontext = $_POST['question'];

$SQLoption = "SELECT * FROM question_option WHERE question_id = $questionID";
$queryOption = $conn->query($SQLoption);

while ($callOption = mysqli_fetch_assoc($queryOption)) {
    $id[] = $callOption['id'];
}

if ($_POST['iscorrect0'] == '') {
    $answer0 = 0;
} else {
    $answer0 = 1;
}

if ($_POST['iscorrect1'] == '') {
    $answer1 = 0;
} else {
    $answer1 = 1;
}

if ($_POST['iscorrect2'] == '') {
    $answer2 = 0;
} else {
    $answer2 = 1;
}

if ($_POST['iscorrect3'] == '') {
    $answer3 = 0;
} else {
    $answer3 = 1;
}

if ($_POST['iscorrect4'] == '') {
    $answer4 = 0;
} else {
    $answer4 = 1;
}

echo $answer0;
echo $answer1;
echo $answer2;
echo $answer3;
echo $answer4;

print_r($id);

if ($conn->query("UPDATE question SET question = '$questiontext' WHERE id = '$questionID'")) {
    echo "question text werks";
}


if ($_FILES["new_image0"]["name"] <> '') {
    $dir = "../uploads/";
    $old_image = $_POST['old_image0'];
    unlink($dir . $old_image);

    $filename = rand(1000,10000)."-".$_FILES["new_image0"]["name"];
    $tempname = $_FILES["new_image0"]["tmp_name"];
    $folder = "../uploads/";

    if (move_uploaded_file($tempname, "$folder/$filename"))  {
        $conn->query("UPDATE question_option SET option_img = '$filename', is_right = '$answer0' WHERE id = '$id[0]'");
        echo "first image werks";

    } else {
        echo $msg = "Either failed to upload the image or no image has been uploaded.";
    }
}

if ($_FILES["new_image1"]["name"] <> '') {
    $dir = "../uploads/";
    $old_image = $_POST['old_image1'];
    unlink($dir . $old_image);

    $filename = rand(1000,10000)."-".$_FILES["new_image1"]["name"];
    $tempname = $_FILES["new_image1"]["tmp_name"];
    $folder = "../uploads/";

    if (move_uploaded_file($tempname, "$folder/$filename"))  {
        $conn->query("UPDATE question_option SET option_img = '$filename', is_right = '$answer1' WHERE id = '$id[1]'");
        echo "first image werks";

    } else {
        echo $msg = "Either failed to upload the image or no image has been uploaded.";
    }
}

if ($_FILES["new_image2"]["name"] <> '') {
    $dir = "../uploads/";
    $old_image = $_POST['old_image2'];
    unlink($dir . $old_image);

    $filename = rand(1000,10000)."-".$_FILES["new_image2"]["name"];
    $tempname = $_FILES["new_image2"]["tmp_name"];
    $folder = "../uploads/";

    if (move_uploaded_file($tempname, "$folder/$filename"))  {
        $conn->query("UPDATE question_option SET option_img = '$filename', is_right = '$answer2' WHERE id = '$id[2]'");
        echo "first image werks";

    } else {
        echo $msg = "Either failed to upload the image or no image has been uploaded.";
    }
}

if ($_FILES["new_image3"]["name"] <> '') {
    $dir = "../uploads/";
    $old_image = $_POST['old_image3'];
    unlink($dir . $old_image);

    $filename = rand(1000,10000)."-".$_FILES["new_image3"]["name"];
    $tempname = $_FILES["new_image3"]["tmp_name"];
    $folder = "../uploads/";

    if (move_uploaded_file($tempname, "$folder/$filename"))  {
        $conn->query("UPDATE question_option SET option_img = '$filename', is_right = '$answer3' WHERE id = '$id[3]'");
        echo "first image werks";

    } else {
        echo $msg = "Either failed to upload the image or no image has been uploaded.";
    }
}

if ($_FILES["new_image4"]["name"] <> '') {
    $dir = "../uploads/";
    $old_image = $_POST['old_image4'];
    unlink($dir . $old_image);

    $filename = rand(1000,10000)."-".$_FILES["new_image4"]["name"];
    $tempname = $_FILES["new_image4"]["tmp_name"];
    $folder = "../uploads/";

    if (move_uploaded_file($tempname, "$folder/$filename"))  {
        $conn->query("UPDATE question_option SET option_img = '$filename', is_right = '$answer4' WHERE id = '$id[4]'");
        echo "first image werks";

    } else {
        echo $msg = "Either failed to upload the image or no image has been uploaded.";
    }
}

if ($conn->commit()) {
    header("location:quiz_manage.php?id=$quizID");
}
?>