<?php
session_start();
// echo md5(base64_encode("1122"));
include_once "connect.php";

if (isset($_POST["loginBtn"]) && isset($_POST["userEmail"]) && isset($_POST["userPassword"])) {

    $email = addslashes($_POST["userEmail"]);
    $password = addslashes($_POST["userPassword"]);
    $sql = "select * from user where  email='" . $email . "' and password='" . md5(base64_encode($password)) . "'";

    $res = select_info_multiple_key($sql);
    if (count($res) > 0) {
        $accountType = $res[0]["accountType"];
        echo $accountType;
        if ($accountType == "student") {
            $_SESSION["studentId"] = $res[0]["id"];
        } elseif ($accountType == "supervisor") {
            $_SESSION["supervisorId"] = $res[0]["id"];
        }
    } else {
        echo "no user";
    }
}
