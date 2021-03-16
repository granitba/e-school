<?php
require_once PHP_ROOT . '/dashboard/includes/connection.php';

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
function getAdmins() {
    $rows = [];
    try {
        global $database;
        $stmt = $database->query("SELECT Id, name, email, role, password FROM users WHERE role = 1");
        $stmt->execute();
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $exception) {
        error_log("Getting admins failed: " . $exception->getMessage());
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
        error_log("Getting admins failed: " . $exception->getMessage());
    }
    return $rows;
}
