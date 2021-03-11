<?php
require_once('../includes/connection.php');

// Nese useri eshte i loguar, te redirektohet ne indexin e faqes perkatse
if (isset($_SESSION['admin_login']) && !empty($_SESSION['admin_login'])) {
    header('location: ../admin/index');
    exit;
}
if (isset($_SESSION['teacher_login']) && !empty($_SESSION['teacher_login'])) {
    header('location: ../teacher/index');
    exit;
}
if (isset($_SESSION['student_login']) && !empty($_SESSION['student_login'])) {
    header('location: ../student/index');
    exit;
}

if (!empty($_POST)) {
    if (isset($_POST['email']) && isset($_POST['password']) && isset($_POST['password_confirm']) && isset($_POST['role'])) {
        $email = $_POST['email'];
        $password = $_POST['password'];
        $password_confirm = $_POST['password_confirm'];
        $role_id = $_POST['role'];

        if (!empty($email) && !empty($password) && !empty($password_confirm)) {
            $password = password_hash($password,PASSWORD_BCRYPT);
            try {
                /** @var PDO $database */
                $stmt = $database->prepare("INSERT INTO users (email, password, role) VALUES (?,?,?) ");
                $stmt->bindParam(1, $email, PDO::PARAM_STR);
                $stmt->bindParam(2,$password,PDO::PARAM_STR);
                $stmt->bindParam(3, $role_id, PDO::PARAM_INT);
                $stmt->execute();
                header('location: ../login.php');
            } catch (PDOException $exception) {
                error_log("Registration failed: " . $exception->getMessage());
                header("location: ../register.php");
            }
        }
    }
}