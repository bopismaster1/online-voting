<?php
include_once "connect.php";
$mysql_date_now = date("Y-m-d H:i:s");

if (isset($_POST["name"]) && isset($_FILES["logo"])) {
    $filePath = "uploads/" . addslashes($_FILES["logo"]["name"]);
    $target_dir = "uploads/";
    $curDate = date("H-i-s-");
    //here
    $target_file = $target_dir . $curDate . basename($_FILES["logo"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
    $response = "";
    $check = getimagesize($_FILES["logo"]["tmp_name"]);
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
            if (move_uploaded_file($_FILES["logo"]["tmp_name"], $target_file)) {
                $response = "The file " . htmlspecialchars(basename($_FILES["logo"]["name"])) . " has been uploaded.";

                $sql = "INSERT INTO partylist (partyListName,logoPath,active,dateCreated,createdBy) VALUES('" . addslashes($_POST["name"]) . "','" . $target_file . "','1','" . $mysql_date_now . "','admin')";
                $res = insert_update_delete($sql);
                // $response = "success";
                $response = $res;
            } else {
                $uploadOk = 0;
                $response = "Sorry, there was an error uploading your file.";
            }
        }
    } else {
        $response = "File is not an image.";
        $uploadOk = 0;
    }
    echo $response;
} elseif (isset($_POST["selectedName"]) && isset($_POST["selectedStatus"])) {
    $stats = 0;
    if (strtolower($_POST["selectedStatus"]) == "active") {
        $stats = 1;
    }
    $uploadOk = 1;
    if (isset($_FILES["updatedLogo"])) {
        $filePath = "uploads/" . addslashes($_FILES["updatedLogo"]["name"]);
        $target_dir = "uploads/";
        $curDate = date("H-i-s-");
        $target_file = $target_dir . $curDate . basename($_FILES["updatedLogo"]["name"]);

        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
        $response = "";
        $check = getimagesize($_FILES["updatedLogo"]["tmp_name"]);
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
                if (move_uploaded_file($_FILES["updatedLogo"]["tmp_name"], $target_file)) {
                    $response = "The file " . htmlspecialchars(basename($_FILES["updatedLogo"]["name"])) . " has been uploaded.";

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
    }
    if ($uploadOk == 1 && isset($_FILES["updatedLogo"])) {
        $sql = "update partylist set `partyListName`='" . addslashes($_POST["selectedName"]) . "',`active`='" . addslashes($stats) . "',`logoPath`='" . $target_file . "' where id=" . addslashes($_POST["selectedId"]);
    } else {
        $sql = "update partylist set `partyListName`='" . addslashes($_POST["selectedName"])  . "',`active`='" . addslashes($stats) . "' where id=" . addslashes($_POST["selectedId"]);
    }
    $res = insert_update_delete($sql);
    echo $res;
} elseif (isset($_POST['deletingId'])) {
    $sql = "DELETE FROM partylist WHERE id='" . addslashes($_POST['deletingId']) . "'";
    $response = insert_update_delete($sql);
    echo $response;
} else {
    echo "sample";
}
