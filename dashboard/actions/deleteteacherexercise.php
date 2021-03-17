<?php
session_start();
define('PHP_ROOT', $_SERVER['DOCUMENT_ROOT'] . '/e-school');
require_once PHP_ROOT . '/dashboard/includes/connection.php';

if (!empty($_POST)) {
    if (isset($_POST['id'])) {
        $id = $_POST['id'];

        if (!empty($id)) {
            try {
                global $database;
                $select_stmt = $database->prepare("SELECT filepath FROM teacher_exercise WHERE id = ?");
                $select_stmt->bindParam(1, $id, PDO::PARAM_INT);
                $select_stmt->execute();
                $result = $select_stmt->fetch(PDO::FETCH_ASSOC);
                $path = $result['filepath'];

                if (!unlink($path)) {
                    error_log('Couldn\'t delete file');
                }

                $stmt = $database->prepare("DELETE FROM teacher_exercise WHERE id = ?");
                $stmt->bindParam(1, $id, PDO::PARAM_INT);
                $stmt->execute();
                header('location: ../teacher/exercise?success');
                exit;
            } catch (PDOException $exception) {
                error_log("Deleting teacher exercise failed: " . $exception->getMessage());
                header("location: ../teacher/exercise?failed");
                exit;
            }
        } else{
            header('location: ../teacher/exercise?invalid');
            exit;
        }
    } else {
        header('location: ../teacher/exercise?invalid');
        exit;
    }
}
header('location: ../teacher/exercise?invalid');