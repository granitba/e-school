<?php
require_once '../includes/connection.php';

function getSchedule() {
    $rows = [];
    try {
        global $database;
        $stmt = $database->query("SELECT s.period, s.weekday, s.teacher_id, u.name FROM schedule s INNER JOIN users u ON s.teacher_id = u.Id");
        $stmt->execute();
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $exception) {
        error_log("Getting schedule failed: " . $exception->getMessage());
    }
    return $rows;
}