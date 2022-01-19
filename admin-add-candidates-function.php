<?php
session_start();
include_once "connect.php";
$mysql_date_now = date("Y-m-d H:i:s");

$sql = "select * from user where id=" . $_SESSION["supervisorId"];
$res = select_info_multiple_key($sql);

if (isset($_POST["idNumber"]) && isset($_POST["runningFor"]) && isset($_POST["category"]) && isset($_FILES["files"])) {
    $sql = "select * from studentlist where studentId=" . addslashes($_POST["idNumber"]);
    $res = select_info_multiple_key($sql);
    $currentStudent = $res;
    if (count($res) > 0) {
        $sql = "select * from positions where `position` LIKE '" . addslashes(strtolower($_POST["runningFor"])) . "' and `type` LIKE '" . addslashes(strtolower($_POST["category"])) . "'";
        $res = select_info_multiple_key($sql);
        if (count($res) > 0) {
            $firstname = $currentStudent[0]["firstName"];
            $lastName = $currentStudent[0]["lastName"];
            $position = addslashes(strtolower($_POST["runningFor"]));
            $category = addslashes(strtolower($_POST["category"]));
            $categoryId = $res[0]["id"];
            $uploadOk = 1;

            $filePath = "uploads/" . addslashes($_FILES["files"]["name"]);
            $target_dir = "uploads/";
            $curDate = date("H-i-s-");
            $imageFileType = strtolower(pathinfo($_FILES["files"]["name"], PATHINFO_EXTENSION));
            $target_file = $target_dir . $curDate . "-" . $category . "-" . $currentStudent[0]["id"] . "." . $imageFileType;


            $response = "";
            $check = getimagesize($_FILES["files"]["tmp_name"]);
            $ssql = "select * from candidates where studentId='" . $currentStudent[0]["id"] . "' and status LIKE 'active'";
            $count = select_info_multiple_key($ssql);

            if (count($count) < 1) {
                if ($check !== false) {
                    $uploadOk = 1;
                    // Check if file already exists
                    if (file_exists($target_file)) {
                        $response = "Sorry, file already exists.";
                        $uploadOk = 0;
                    }
                    // Check if $uploadOk is set to 0 by an error
                    if ($uploadOk == 0) {
                        $response = "Sorry, your file was not uploaded.";
                        // if everything is ok, try to upload file
                    } else {
                        if (move_uploaded_file($_FILES["files"]["tmp_name"], $target_file)) {
                            $response = "The file " . htmlspecialchars(basename($_FILES["files"]["name"])) . " has been uploaded.";

                            // $response = "success";
                            $response = $filePath;
                            $uploadOk = 1;
                        } else {
                            $uploadOk = 0;
                            $response = "Sorry, there was an error uploading your file.";
                        }
                    }
                } else {
                    $response = "File is not an image.";
                    $uploadOk = 0;
                }

                if ($uploadOk == 1) {
                    $sql = "insert into candidates (`studentId`,`firstName`,`lastName`,`runningFor`,`category`,`categoryId`,`picturePath`,`status`,`partylist`) values('" . $currentStudent[0]["id"] . "','" . $firstname . "','" . $lastName . "','" . $position . "','" . $category . "','" . $categoryId . "','" . $target_file . "','active','" . addslashes($_POST["partylist"]) . "')";
                    $res = insert_update_delete($sql);
                    echo $res;
                } else {
                    echo "error uploading images";
                }
            } else {
                echo "student is registered";
            }
        } else {
            echo "invalid position";
        }
    } else {
        echo "user not found";
    }
} else {
    echo "wala";
}
