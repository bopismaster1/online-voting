<?php
session_start();
// echo md5(base64_encode("1122"));
date_default_timezone_set('ASIA/Manila');
include_once "connect.php";
$sql = "select * from votingdate";
$res = select_info_multiple_key($sql);
$startVoting = $res[0]["startDate"];
$endDate = $res[0]["endDate"];
$date = date("Y-m-d H:i:s");



if (isset($_POST["code"]) && isset($_POST["voteList"])) {
    if ($startVoting < $date && $endDate > $date) {
        $arrayOfVOte = json_decode($_POST["voteList"]);
        $voteCode = $_POST["code"];
        //first check muna natin kung legit ung code
        $sql = "select * from user where id=" . $_SESSION["studentId"];
        $res = select_info_multiple_key($sql);
        if ($res[0]["Code"] == $voteCode) {
            if ($res[0]["status"] != "used") {
                $sql = "";
                $error = 0;

                for ($i = 0; $i < count($arrayOfVOte); $i++) {
                    $sql = " Insert into votes (`voterId`,`candidateId`,`votedAt`) values('" . $_SESSION["studentId"] . "','" . $arrayOfVOte[$i] . "','" . $date . "'); \n";
                    $res = insert_update_delete($sql);
                    if ($res != "success") {
                        $error += 1;
                    }
                }
                $sql = "update user set status='used' where id='" . $_SESSION["studentId"] . "'";
                $res = insert_update_delete($sql);
                echo $res;
            } else {
                echo "used";
            }
        } else {
            echo "invalid-code";
        }
    } elseif ($startVoting > $date) {
        echo "too-early";
    } elseif ($endDate < $date) {
        echo "too-late";
    } else {
        echo "oops";
    }
} else {
    header("location:index.php");
}
