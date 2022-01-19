<?php

include 'vendor/autoload.php';

use SMSGatewayMe\Client\ApiClient;
use SMSGatewayMe\Client\Configuration;
use SMSGatewayMe\Client\Api\MessageApi;
use SMSGatewayMe\Client\Model\SendMessageRequest;


// Configure client
$config = Configuration::getDefaultConfiguration();
$config->setApiKey('Authorization', 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJhZG1pbiIsImlhdCI6MTYzNzgxMzE4MywiZXhwIjo0MTAyNDQ0ODAwLCJ1aWQiOjkxNjM5LCJyb2xlcyI6WyJST0xFX1VTRVIiXX0.pfKeO7BPlz1b_6cIGZWbukULxWonm6zlyDgWRQjEhBs');
$apiClient = new ApiClient($config);
$messageClient = new MessageApi($apiClient);

// Sending a SMS Message
$sendMessageRequest1 = new SendMessageRequest([
    'phoneNumber' => '09121202346',
    'message' => 'test1',
    'deviceId' => 126407
]);
$sendMessageRequest2 = new SendMessageRequest([
    'phoneNumber' => '09121202346',
    'message' => 'test2',
    'deviceId' => 126407
]);
$sendMessages = $messageClient->sendMessages([
    $sendMessageRequest1,
    $sendMessageRequest2
]);
print_r($sendMessages);
