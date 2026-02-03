<?php
$host = "localhost";
$user = "root";      // MySQL username
$pass = "";          // MySQL password
$db   = "php_auth_project";  // Database name

$db_connect = new mysqli($host, $user, $pass, $db);

if ($db_connect->connect_error) {
    die("Database Connection Failed: " . $db_connect->connect_error);
}