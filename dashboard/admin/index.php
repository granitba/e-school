<html lang="en">
<head>
    <?php
    include_once 'admin_head.php';
    include_once '../actions/getusers.php';
    $users = getUsers();
    $roles = array('','Admin', 'Teacher', 'Student');
    ?>
</head>
<body>
<?php include_once 'admin_sidebar.php' ?>
<div class="content">
    <h1 class="title">Users</h1>
    <table>
        <thead>
        <tr>
            <th scope="col">Name</th>
            <th scope="col">Role</th>
            <th scope="col">Email</th>
            <th scope="col">Delete</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($users as $user): ?>
        <tr>
            <td data-label="Name"><?= $user['name'] ?></td>
            <td data-label="Role"><?= $roles[$user['role']] ?></td>
            <td data-label="Email"><?= $user['email']  ?></td>
            <td data-label="Delete">
                <form style="margin-top: 1em;" method="POST" onsubmit="return confirm('Are you sure you want to delete this user?');" action="../actions/deleteuser.php">
                    <input type="hidden" name="id" value="<?php echo $user['Id']; ?>">
                    <button style="margin-left: 0;" class="submit" type="submit">Delete User</button>
                </form>
            </td>
        </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
</div>
<script>
    $link = document.getElementById('users');
    $link.classList.add('active');
</script>
</body>
</html>
