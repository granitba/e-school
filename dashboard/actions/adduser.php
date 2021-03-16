<?php
define('PHP_ROOT', $_SERVER['DOCUMENT_ROOT'] . '/e-school');
require_once PHP_ROOT . '/dashboard/includes/connection.php';

if (!empty($_POST)) {
    if (isset($_POST['name']) && isset($_POST['email']) && isset($_POST['password']) && isset($_POST['password_confirm']) && isset($_POST['role'])) {
        $name = $_POST['name'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $password_confirm = $_POST['password_confirm'];
        $role_id = $_POST['role'];

        if (!empty($name) && !empty($email) && !empty($password) && !empty($password_confirm)) {
            $password = password_hash($password,PASSWORD_BCRYPT);
            try {
                global $database;
                $stmt = $database->prepare("INSERT INTO users (name, email, password, role) VALUES (?,?,?,?)");
                $stmt->bindParam(1, $name, PDO::PARAM_STR);
                $stmt->bindParam(2, $email, PDO::PARAM_STR);
                $stmt->bindParam(3,$password,PDO::PARAM_STR);
                $stmt->bindParam(4, $role_id, PDO::PARAM_INT);
                $stmt->execute();
                header('location: ../login?success');
                exit;
            } catch (PDOException $exception) {
                error_log("Registration failed: " . $exception->getMessage());
                header("location: ../register?failed");
                exit;
            }
        } else{
            header('location: ../register?invalid');
            exit;
        }
    } else {
        header('location: ../register?invalid');
        exit;
    }
}
header('location: ../register?failed');