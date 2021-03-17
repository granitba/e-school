<?php
session_start();
require_once '../includes/connection.php';
$uploads = "../uploads/";

if (!empty($_POST)) {
    if (isset($_POST['name']) && isset($_POST['exercise_id'])) {
        $comment = '';
        if (!empty($_POST['comment'])) {
            $comment = $_POST['comment'];
        }
        $student_id = $_SESSION['student_id'];
        $file_type = $_FILES['file']['type'];
        $exercise_id = $_POST['exercise_id'];

        //Allow JPG, GIF, PNG, DOCX, XLSX, TXT, PDF
        $allowed = ["image/jpeg", "image/gif", "image/png", "text/plain", "application/pdf"];
        array_push($allowed, "application/vnd.openxmlformats-officedocument.wordprocessingml.document");
        array_push($allowed, "application/vnd.openxmlformats-officedocument.presentationml.presentation");
        array_push($allowed, "application/vnd.openxmlformats-officedocument.spreadsheetml.sheet");


        if (!empty($student_id) && in_array($file_type, $allowed)) {
            try {
                $temp = explode(".", $_FILES["file"]["name"]);
                $newfilename = round(microtime(true)) . '.' . end($temp);

                if (!move_uploaded_file($_FILES['file']['tmp_name'], $uploads . $newfilename)) {
                    header('location: ../student/exercise?failed');
                    exit;
                }
                $filepath = $uploads . $newfilename;

                global $database;
                $stmt = $database->prepare("INSERT INTO student_exercise (student_id, exercise_id, comment, filepath) VALUES (?,?,?,?) ON DUPLICATE KEY UPDATE comment = VALUES(comment), filepath = VALUES(filepath)");
                $stmt->bindParam(1, $student_id, PDO::PARAM_INT);
                $stmt->bindParam(2, $exercise_id, PDO::PARAM_STR);
                $stmt->bindParam(3, $comment, PDO::PARAM_STR);
                $stmt->bindParam(4, $filepath, PDO::PARAM_STR);
                $success = $stmt->execute();

                if (!$success) {
                    header('location: ../student/exercise?failed');
                    exit;
                }
                header('location: ../student/exercise?success');
                exit;

            } catch (PDOException $exception) {
                error_log("Couldn't add exercise: " . $exception->getMessage());
                header('location: ../student/exercise?failed');
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
