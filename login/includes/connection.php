<?php
// File config.php eshte ne .gitignore, duhet te shtohet
require_once("config.php");
$host = DB_HOST;
$user = DB_USER;
$pass = DB_PASS;
$name = DB_NAME;

try {
    $database = new PDO("mysql:host={$host};dbname={$name}",$user,$pass,array(PDO::ATTR_EMULATE_PREPARES=>false));
} catch (PDOException $exception) {
    $exception->getMessage();
}
