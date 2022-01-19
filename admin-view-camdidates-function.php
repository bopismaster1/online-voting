<?php
session_start();
include_once "connect.php";

if (isset($_SESSION["supervisorId"])) {
} else {
    //logout user
    header("location:login.php");
}
if (isset($_POST['newPosition']) && isset($_POST["category"])) {
    $sql = "select * from candidates where studentId='" . addslashes($_POST["selectedId"]) . "'";
    $res = select_info_multiple_key($sql);
    if (isset($res)) {
        // echo "may nahanap";
        if (!isset($_FILES["newImages"])) {
            $sql = "UPDATE candidates set `runningFor`= '" . addslashes(strtolower($_POST["newPosition"])) . "', `category`='" . addslashes(strtolower($_POST["category"])) . "' where studentId='" . addslashes($_POST["selectedId"]) . "'";
            $res = insert_update_delete($sql);

            echo $res;
        } else {
            $target_dir = "uploads/";
            $curDate = date("H-i-s-");
            $imageFileType = strtolower(pathinfo($_FILES["newImages"]["name"], PATHINFO_EXTENSION));
            $target_file = $target_dir . "updated-$curDate" . md5(uniqId()) . "." . $imageFileType;
            $uploadOk = 1;
            $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

            // Check if image file is a actual image or fake image
            if (isset($_POST["submit"])) {
                $check = getimagesize($_FILES["newImages"]["tmp_name"]);
                if ($check !== false) {
                    echo "File is an image - " . $check["mime"] . ".";
                    $uploadOk = 1;
                } else {
                    echo "File is not an image.";
                    $uploadOk = 0;
                }
            }

            // Check if file already exists
            if (file_exists($target_file)) {
                echo "Sorry, file already exists.";
                $uploadOk = 0;
            }

            // Check file size
            if ($_FILES["newImages"]["size"] > 500000) {
                echo "Sorry, your file is too large.";
                $uploadOk = 0;
            }

            // Allow certain file formats
            if (
                $imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
                && $imageFileType != "gif"
            ) {
                echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
                $uploadOk = 0;
            }

            // Check if $uploadOk is set to 0 by an error
            if (
                $uploadOk == 0
            ) {
                echo "Sorry, your file was not uploaded.";
                // if everything is ok, try to upload file
            } else {
                if (move_uploaded_file($_FILES["newImages"]["tmp_name"], $target_file)) {
                    // echo "The file " . htmlspecialchars(basename($_FILES["newImages"]["name"])) . " has been uploaded.";
                    $sql = "UPDATE candidates set `runningFor`= '" . addslashes(strtolower($_POST["newPosition"])) . "', `category`='" . addslashes(strtolower($_POST["category"])) . "', `picturePath`='" . addslashes($target_file) . "' where studentId='" . addslashes($_POST["selectedId"]) . "'";
                    $res = insert_update_delete($sql);

                    echo $res;
                } else {
                    echo "Sorry, there was an error uploading your file.";
                }
            }
        }
    } else {
        echo "no-data";
    }
} elseif (isset($_POST["deletionId"])) {
    $sql = "DELETE FROM candidates WHERE id=" . addslashes($_POST["deletionId"]) . "";
    $res = insert_update_delete($sql);
    echo $res;
}
