<html lang="en">
<head>
    <?php
    include_once 'student_head.php';
    include_once '../actions/getexercises.php';
    $student_exercises = getStudentExercises();
    $teacher_exercises = getTeacherExercises();
    ?>
</head>
<body>
<?php include_once 'student_sidebar.php' ?>
<div class="content">
    <h1 class="title">Upload exercises</h1>
    <table>
        <thead>
        <tr>
            <th scope="col">Exercise</th>
            <th scope="col">Description</th>
            <th scope="col">File</th>
            <th scope="col">Delete submitted solution</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($teacher_exercises as $teacher_exercise): ?>
            <tr>
                <td data-label="Name"><?= $teacher_exercise['name'] ?></td>
                <td data-label="Description"><?= $teacher_exercise['description'] ?></td>
                <td data-label="File"><a href="<?= $teacher_exercise['filepath'] ?>">Added file</a></td>
                <td data-label="Delete submitted solution">
                    <?php if (!empty(getStudentExerciseByTeacherExerciseId($teacher_exercise['id'], $_SESSION['student_id']))): ?>
                    <form style="margin-top: 1em;" method="POST"
                          onsubmit="return confirm('Are you sure you want to delete this submitted solution?');"
                          action="../actions/deletestudentexercise.php">
                        <input type="hidden" name="exercise_id" value="<?php echo $teacher_exercise['id']; ?>">
                        <button style="margin-left: 0;" class="submit" type="submit">Delete</button>
                    </form>
                    <?php else:?>
                    No solution submitted
                    <?php endif; ?>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
    <div class="schedule">
        <form class="schedule-form" method="post" enctype="multipart/form-data"
              action="../actions/addstudentexercise.php">
            <select class="text-input" style="text-align-last: center;" name="exercise_id">
                <option value="" disabled selected>Select the exercise</option>
                <?php foreach ($teacher_exercises as $teacher_exercise): ?>
                    <option value="<?= $teacher_exercise['id'] ?>"><?= $teacher_exercise['name'] ?></option>
                <?php endforeach; ?>
            </select>
            <textarea class="text-input" type="text" placeholder="Comment(optional)" name="comment"></textarea>
            <input class="text-input" type="file" name="file">
            <p style="color:red" id="error" align="center"></p>
            <input class="submit" type="submit" value="Add exercise" align="center">
        </form>
    </div>
</div>
<script>
    $link = document.getElementById('exercise');
    $link.classList.add('active');
</script>
</body>
</html>