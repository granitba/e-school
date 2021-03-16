<html lang="en">
<head>
    <?php
    include_once 'teacher_head.php';
    ?>
</head>
<body>
<?php include_once 'teacher_sidebar.php' ?>
<div class="content">
    <h1 class="title">Upload exercises</h1>
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