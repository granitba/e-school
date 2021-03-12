<?php
require_once './includes/connection.php';

function getTeachers() {
    $rows = [];
    try {
        global $database;
        $stmt = $database->query("SELECT Id, name, email, role, password FROM users WHERE role = 2");
        $stmt->execute();
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $exception) {
        error_log("Getting teachers failed: " . $exception->getMessage());
    }
    return $rows;
}
function getUsers() {
    $rows = [];
    try {
        global $database;
        $stmt = $database->query("SELECT Id, name, email, role, password FROM users");
        $stmt->execute();
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $exception) {
        error_log("Getting users failed: " . $exception->getMessage());
    }
    return $rows;
}
