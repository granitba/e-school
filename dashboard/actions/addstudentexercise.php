<?php
session_start();
require_once '../includes/connection.php';
$uploads = "../uploads/";

if (!empty($_POST)) {
    if (isset($_POST['name'])) {
        $description = '';
        if (!empty($_POST['description'])) {
            $description = $_POST['description'];
        }
        $name = $_POST['name'];
        $teacher_id = $_SESSION['teacher_id'];
        $file_type = $_FILES['file']['type'];

        //Allow JPG, GIF, PNG, DOCX, XLSX, TXT, PDF
        $allowed = ["image/jpeg", "image/gif", "image/png", "text/plain", "application/pdf"];
        array_push($allowed, "application/vnd.openxmlformats-officedocument.wordprocessingml.document");
        array_push($allowed, "application/vnd.openxmlformats-officedocument.presentationml.presentation");
        array_push($allowed, "application/vnd.openxmlformats-officedocument.spreadsheetml.sheet");


        if (!empty($teacher_id) && !empty($name) && in_array($file_type, $allowed)) {
            try {
                $temp = explode(".", $_FILES["file"]["name"]);
                $newfilename = round(microtime(true)) . '.' . end($temp);

                if (!move_uploaded_file($_FILES['file']['tmp_name'], $uploads . $newfilename)) {
                    header('location: ../teacher/exercise?failed');
                    exit;
                }
                $filepath = $uploads . $newfilename;

                global $database;
                $stmt = $database->prepare("INSERT INTO teacher_exercise (teacher_id, name, filepath, description) VALUES (?,?,?,?)");
                $stmt->bindParam(1, $teacher_id, PDO::PARAM_INT);
                $stmt->bindParam(2, $name, PDO::PARAM_STR);
                $stmt->bindParam(3, $filepath, PDO::PARAM_STR);
                $stmt->bindParam(4, $description, PDO::PARAM_STR);
                $success = $stmt->execute();

                if (!$success) {
                    header('location: ../teacher/exercise?failed');
                    exit;
                }
                header('location: ../teacher/exercise?success');
                exit;

            } catch (PDOException $exception) {
                error_log("Couldn't add exercise: " . $exception->getMessage());
                header('location: ../teacher/exercise?failed');
                exit;
            }
        } else {
            header('location: ../teacher/exercise?invalid');
            exit;
        }
    } else {
        header('location: ../teacher/exercise?invalid');
        exit;
    }
}
header('location: ../teacher/exercise?invalid');
