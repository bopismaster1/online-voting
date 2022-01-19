<?php
$mysql_host = "localhost";
$mysql_database = "sbo_voting";
$mysql_user = "root";
$mysql_password = "";
# MySQL with PDO_MYSQL
$db = new PDO("mysql:host=$mysql_host;dbname=$mysql_database", $mysql_user, $mysql_password);

$query = file_get_contents("sbo_voting_backup.sql");

$stmt = $db->prepare($query);

if ($stmt->execute()) {
    echo "Success";
} else {
    echo "Fail";
}
