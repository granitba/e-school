<?php
session_start();
require_once '../includes/connection.php';

if (!empty($_POST)) {
    if (isset($_POST['teacher_id']) && isset($_POST['weekday']) && isset($_POST['period'])) {
        $teacher_id = $_POST['teacher_id'];
        $weekday = $_POST['weekday'];
        $period = $_POST['period'];
        if (!empty($teacher_id) && !empty($weekday) && !empty($period)) {
            try {
                global $database;
                $stmt = $database->prepare("INSERT INTO schedule (period, weekday, teacher_id) VALUES (?,?,?) ON DUPLICATE KEY UPDATE teacher_id = VALUES(teacher_id)");
                $stmt->bindParam(1, $period, PDO::PARAM_STR);
                $stmt->bindParam(2, $weekday, PDO::PARAM_STR);
                $stmt->bindParam(3, $teacher_id, PDO::PARAM_INT);
                $success = $stmt->execute();

                if (!$success) {
                    header('location: ../admin/schedule?failed');
                    exit;
                }
                header('location: ../admin/schedule?success');
                exit;

            } catch (PDOException $exception) {
                error_log("Couldn't change schedule: " . $exception->getMessage());
                header('location: ../admin/schedule?failed');
                exit;
            }
        } else {
            header('location: ../admin/schedule?invalid');
            exit;
        }
    } else {
        header('location: ../admin/schedule?invalid');
        exit;
    }
}
header('location: ../admin/schedule?invalid');