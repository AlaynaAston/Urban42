<?php

$db_host = 'localhost';
$db_name = 'cs2team42_db';
$username = 'cs2team42';
$password = '5EUURc7WnOkMUR0kAsEz2L5gp';

try {
    $db = new PDO("mysql:dbname=$db_name;host=$db_host", $username, $password);
} catch(PDOException $ex) {
    echo("Failed to connect to the database.<br>");
    echo($ex->getMessage());
    exit;
}
?>