<?php
require_once PHP_ROOT . '/dashboard/includes/connection.php';

function getTeacherExercises() {
    $rows = [];
    try {
        global $database;
        $stmt = $database->query("SELECT id, teacher_id, name, filepath, description FROM teacher_exercise");
        $stmt->execute();
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $exception) {
        error_log("Getting teacher exercises failed: " . $exception->getMessage());
    }
    return $rows;
}
function getStudentExercises() {
    $rows = [];
    try {
        global $database;
        $stmt = $database->query("SELECT student_id, exercise_id, comment, filepath FROM student_exercise");
        $stmt->execute();
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $exception) {
        error_log("Getting student exercises failed: " . $exception->getMessage());
    }
    return $rows;
}
function getTeacherExercisesById(int $id) {
    $rows = [];
    try {
        global $database;
        $stmt = $database->prepare("SELECT id, teacher_id, name, filepath, description FROM teacher_exercise WHERE teacher_id = ?");
        $stmt->bindParam(1,$id,PDO::PARAM_INT);
        $stmt->execute();
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $exception) {
        error_log("Getting teacher exercises by id failed: " . $exception->getMessage());
    }
    return $rows;
}
function getStudentExerciseByTeacherExerciseId(int $exercise_id, int $student_id) {
    $rows = [];
    try {
        global $database;
        $stmt = $database->prepare("SELECT student_id, exercise_id, comment, filepath FROM student_exercise WHERE exercise_id = ? AND student_id = ?");
        $stmt->bindParam(1,$exercise_id, PDO::PARAM_INT);
        $stmt->bindParam(2,$student_id, PDO::PARAM_INT);
        $stmt->execute();
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $exception) {
        error_log("Getting student exercise by teacher exercise id failed: " . $exception->getMessage());
    }
    return $rows;
}
function getStudentExerciseByTeacher(int $exercise_id) {
    $rows = [];
    try {
        global $database;
        $stmt = $database->prepare("SELECT se.student_id, se.exercise_id, se.comment, se.filepath, u.name FROM student_exercise se INNER JOIN users u ON se.student_id = u.Id WHERE se.exercise_id= ?");
        $stmt->bindParam(1,$exercise_id, PDO::PARAM_INT);
        $stmt->execute();
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $exception) {
        error_log("Getting student exercise by teacher exercise id failed: " . $exception->getMessage());
    }
    return $rows;
}
