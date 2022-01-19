<?php
session_start();
include_once "connect.php";
include 'vendor/autoload.php';

use SMSGatewayMe\Client\ApiClient;
use SMSGatewayMe\Client\Configuration;
use SMSGatewayMe\Client\Api\MessageApi;
use SMSGatewayMe\Client\Model\SendMessageRequest;


// Configure client
$config = Configuration::getDefaultConfiguration();
$config->setApiKey('Authorization', 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJhZG1pbiIsImlhdCI6MTY0MDc1MTUxMSwiZXhwIjo0MTAyNDQ0ODAwLCJ1aWQiOjkyMTg5LCJyb2xlcyI6WyJST0xFX1VTRVIiXX0.diZXlX-r3Sve9jHGftScfpXK06NPNqVFbonW5rJ--iA');
$apiClient = new ApiClient($config);
$messageClient = new MessageApi($apiClient);

$mysql_date_now = date("Y-m-d H:i:s");
if (isset($_POST["studentId"]) && isset($_POST["contactNo"]) && isset($_POST["email"]) && isset($_POST["password"])) {
    $sql = "select * from studentlist where studentId='" . addslashes($_POST["studentId"]) . "'";
    $res = select_info_multiple_key($sql);

    if (count($res) > 0) {
        $currentStudent = $res[0];
        if ($currentStudent["status"] == "notRegistered") {
            $sql = "select * from user where email LIKE '" . addslashes($_POST["email"]) . "'";
            $res = select_info_multiple_key($sql);
            if (count($res) > 0) {
                echo "taken";
            } else {
                $code = rand(10000, 99999);
                $sql = "insert into user (`firstName`,`lastName`,`accountType`,`email`,`contactNo`,`password`,`createdBy`,`dateCreated`,`code`) values('" . addslashes($currentStudent["firstName"]) . "','" . addslashes($currentStudent["lastName"]) . "','student','" . addslashes($_POST["email"]) . "','" . addslashes($_POST["contactNo"]) . "','" . md5(base64_encode(addslashes($_POST["password"]))) . "','register','" . $mysql_date_now . "','" . $code . "')";
                $res = insert_update_delete($sql);
                echo $res;
                $sendMessageRequest1 = new SendMessageRequest([
                    'phoneNumber' => addslashes($_POST["contactNo"]),
                    'message' => "Code: $code \nSBO Auth code",
                    'deviceId' => 126759
                ]);
                $sendMessages = $messageClient->sendMessages([
                    $sendMessageRequest1
                ]);
                //update student list
                $sql = "update studentlist set status='registered' where id=" . $currentStudent["id"];
                insert_update_delete($sql);
            }
        } else {
            echo "registered";
        }
    } else {
        echo "no user";
    }
} else {
    echo "labas";
}
