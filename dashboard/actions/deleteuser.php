<?php
define('PHP_ROOT', $_SERVER['DOCUMENT_ROOT'] . '/e-school');
require_once PHP_ROOT . '/dashboard/includes/connection.php';

if (!empty($_POST)) {
    if (isset($_POST['id'])) {
        $id = $_POST['id'];

        if (!empty($id)) {
            try {
                global $database;
                $stmt = $database->prepare("DELETE FROM users WHERE id = ?");
                $stmt->bindParam(1, $id, PDO::PARAM_INT);
                $stmt->execute();
                header('location: ../admin/index?success');
                exit;
            } catch (PDOException $exception) {
                error_log("Deleting user failed: " . $exception->getMessage());
                header("location: ../admin/index?failed");
                exit;
            }
        } else{
            header('location: ../admin/index?invalid');
            exit;
        }
    } else {
        header('location: ../admin/index?invalid');
        exit;
    }
}
header('location: ../admin/index?invalid');