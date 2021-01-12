<?php
require_once('../includes/connection.php');

// Nese useri eshte i loguar, te redirektohet ne indexin e faqes perkatse
if (isset($_SESSION['admin_login']) && !empty($_SESSION['admin_login'])) {
    header('location: ../admin/index');
    die();
}
if (isset($_SESSION['teacher_login']) && !empty($_SESSION['teacher_login'])) {
    header('location: ../teacher/index');
    die();
}
if (isset($_SESSION['student_login']) && !empty($_SESSION['student_login'])) {
    header('location: ../student/index');
    die();
}

if (!empty($_POST)) {
    if (isset($_POST['email']) && isset($_POST['password'])) {
        $email = $_POST['email'];
        $password = $_POST['password'];

        if (!empty($email) && !empty($password)) {
            try {
                /** @var PDO $database */
                $select_stmt = $database->prepare("SELECT password FROM users WHERE email= ?");
                $select_stmt->bindParam(1, $email, PDO::PARAM_STR);
                $select_stmt->execute();
                $row = $select_stmt->fetch(PDO::FETCH_ASSOC);

                if ($row == false) {
                    header('location: ../login?Invalid');
                }
                if (password_verify($password, $row['password'])) {
                    switch ($row['role']) {
                        case 1:
                            $_SESSION['admin_login'] = $email;
                            header('location: ../admin/index');
                            break;
                        case 2:
                            $_SESSION['teacher_login'] = $email;
                            header('location: ../teacher/index');
                            break;
                        case 3:
                            $_SESSION['student_login'] = $email;
                            header('location: ../student/index');
                            break;
                    }
                } else {
                    header('location: ../login?Invalid');
                }

            } catch (PDOException $exception) {
                $exception->getMessage();
            }
        }
    }
}