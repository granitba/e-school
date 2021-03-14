<?php
session_start();
require_once '../includes/connection.php';

if (!empty($_POST)) {
    if (isset($_POST['email']) && isset($_POST['password'])) {
        $email = $_POST['email'];
        $password = $_POST['password'];
        if (!empty($email) && !empty($password)) {
            try {
                global $database;
                $select_stmt = $database->prepare("SELECT id,password,role FROM users WHERE email= ?");
                $select_stmt->bindParam(1, $email, PDO::PARAM_STR);
                $select_stmt->execute();
                $row = $select_stmt->fetch(PDO::FETCH_ASSOC);

                if ($row == false) {
                    header('location: ../login?Invalid');
                    exit;
                }
                // Varesisht nga roli te redirektohet ne faqe te ndryshme
                if (password_verify($password, $row['password'])) {
                    switch ($row['role']) {
                        case 1:
                            $_SESSION['admin_login'] = $email;
                            $_SESSION['admin_id'] = $row['id'];
                            header('location: ../admin/index');
                            exit;
                        case 2:
                            $_SESSION['teacher_login'] = $email;
                            $_SESSION['teacher_id'] = $row['id'];
                            header('location: ../teacher/index');
                            exit;
                        case 3:
                            $_SESSION['student_login'] = $email;
                            $_SESSION['student_id'] = $row['id'];
                            header('location: ../student/index');
                            exit;
                    }
                } else {
                    header('location: ../login?invalid');
                    exit;
                }

            } catch (PDOException $exception) {
                error_log("Couldn't log in: " . $exception->getMessage());
                header('location: ../login?failed');
                exit;
            }
        } else {
            header('location: ../login?invalid');
            exit;
        }
    } else {
        header('location: ../login?invalid');
        exit;
    }
}
header('location: ../login?invalid');