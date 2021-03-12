<?php
// File config.php eshte ne .gitignore, duhet te shtohet
require_once("config.php");
$host = DB_HOST;
$user = DB_USER;
$pass = DB_PASS;
$name = DB_NAME;

try {
    $database = new PDO("mysql:host={$host};dbname={$name}",$user,$pass);
    $database->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
    $database->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $exception) {
    error_log("Connection to database failed: " . $exception->getMessage());
}
