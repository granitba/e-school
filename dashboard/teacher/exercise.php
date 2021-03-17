<html lang="en">
<head>
    <?php
    include_once 'teacher_head.php';
    include_once '../actions/getexercises.php';
    $teacher_exercises = getTeacherExercisesById($_SESSION['teacher_id']);
    ?>
</head>
<body>
<?php include_once 'teacher_sidebar.php' ?>
<div class="content">
    <h1 class="title">Upload exercises</h1>
    <table>
        <thead>
        <tr>
            <th scope="col">Exercise</th>
            <th scope="col">Description</th>
            <th scope="col">File</th>
            <th scope="col">Delete</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($teacher_exercises as $teacher_exercise): ?>
            <tr>
                <td data-label="Name"><?= $teacher_exercise['name'] ?></td>
                <td data-label="Role"><?= $teacher_exercise['description'] ?></td>
                <td data-label="Email"><a href="<?= $teacher_exercise['filepath'] ?>">Added file</a></td>
                <td data-label="Delete">
                    <form style="margin-top: 1em;" method="POST" onsubmit="return confirm('Are you sure you want to delete this exercise?');" action="../actions/deleteteacherexercise.php">
                        <input type="hidden" name="id" value="<?php echo $teacher_exercise['id']; ?>">
                        <button style="margin-left: 0;" class="submit" type="submit">Delete Exercise</button>
                    </form>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
    <div class="schedule">
        <form class="schedule-form" method="post" enctype="multipart/form-data"
              action="../actions/addteacherexercise.php">
            <input class="text-input" type="text" placeholder="Name" name="name">
            <textarea class="text-input" type="text" placeholder="Description (optional)" name="description"></textarea>
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