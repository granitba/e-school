<html lang="en">
<head>
    <?php
    include_once 'teacher_head.php';
    ?>
</head>
<body>
<div class="schedule">
    <h3>Exercises</h3>
    <form class="schedule-form" method="post" enctype="multipart/form-data" action="../actions/addexercise.php">
        <input class="text-input" type="text" placeholder="Name" name="name">
        <textarea class="text-input" type="text" placeholder="Description (optional)" name="description"></textarea>
        <input class="text-input" type="file" name="file">
        <p style="color:red" id="error" align="center"></p>
        <input class="submit" type="submit" value="Add exercise" align="center">
    </form>
</div>
</body>
</html>