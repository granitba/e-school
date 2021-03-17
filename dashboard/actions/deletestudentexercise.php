<?php
session_start();
define('PHP_ROOT', $_SERVER['DOCUMENT_ROOT'] . '/e-school');
require_once PHP_ROOT . '/dashboard/includes/connection.php';


if (!empty($_POST)) {
    if (isset($_POST['exercise_id'])) {
        $exercise_id = $_POST['exercise_id'];
        $id = $_SESSION['student_id'];

        if (!empty($id)) {
            try {
                global $database;
                $select_stmt = $database->prepare("SELECT filepath FROM student_exercise WHERE exercise_id = ? AND student_id = ?");
                $select_stmt->bindParam(1, $exercise_id, PDO::PARAM_INT);
                $select_stmt->bindParam(2, $id, PDO::PARAM_INT);
                $select_stmt->execute();
                $result = $select_stmt->fetch(PDO::FETCH_ASSOC);
                $path = $result['filepath'];

                if (!unlink($path)) {
                    error_log('Couldn\'t delete file');
                }

                $stmt = $database->prepare("DELETE FROM student_exercise WHERE exercise_id = ? AND student_id = ?");
                $stmt->bindParam(1, $exercise_id, PDO::PARAM_INT);
                $stmt->bindParam(2, $id, PDO::PARAM_INT);
                $stmt->execute();
                header('location: ../student/exercise?success');
                exit;
            } catch (PDOException $exception) {
                error_log("Deleting teacher exercise failed: " . $exception->getMessage());
                header("location: ../student/exercise?failed");
                exit;
            }
        } else {
            header('location: ../student/exercise?invalid');
            exit;
        }
    } else {
        header('location: ../student/exercise?invalid');
        exit;
    }
}
header('location: ../student/exercise?invalid');