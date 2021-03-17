<html lang="en">
<head>
    <?php
    include_once 'teacher_head.php';
    include_once '../actions/getexercises.php';
    $teacher_exercises = getTeacherExercisesById($_SESSION['teacher_id']);
    $student_exercises = [];
    foreach ($teacher_exercises as $teacher_exercise) {
        $student_exercises += getStudentExerciseByTeacher($teacher_exercise['id']);
    }

    ?>
</head>
<body>
<?php include_once 'teacher_sidebar.php' ?>
<div class="content">
    <h1 class="title">Student exercises</h1>
    <table>
        <thead>
        <tr>
            <th scope="col">Student</th>
            <th scope="col">Comment</th>
            <th scope="col">File</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($student_exercises as $student_exercise): ?>
            <tr>
                <td data-label="Student"><?= $student_exercise['name'] ?></td>
                <td data-label="Comment"><?= $student_exercise['comment'] ?></td>
                <td data-label="File"><a href="<?= $student_exercise['filepath'] ?>">Solution file</a></td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
</div>
<script>
    $link = document.getElementById('student_exercise');
    $link.classList.add('active');
</script>
</body>
</html>