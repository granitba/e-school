<!DOCTYPE html>
<html lang="en">
    <head>
        <?php
        include_once '../includes/head.php';
        include_once './actions/getusers.php';
        $admins = getAdmins();
        $no_admins = empty($admins);
        // Nese nuk ka asnje admin, te lejohet qasja ne register.php pa login
        // Nese ka admina, te lejohet vetem nese useri eshte admin apo teacher
        if (!$no_admins && !isset($_SESSION['admin_login']) && !isset($_SESSION['teacher_login'])) {
            header('location: ./login');
            exit;
        }
        ?>
    </head>
    <body id="login-body">
        <div id="login" style="height: 500px">
        <p class="sign" align="center">Register</p>
        <form style="padding-top: 0" class="login-form" name="login-form" onsubmit="return formValidation()" method="post"
          action="actions/adduser.php">
            <input class="text-input" type="text" align="center" placeholder="Name" name="name">
            <input class="text-input" type="text" align="center" placeholder="Email" name="email">
            <input class="text-input" type="password" align="center" placeholder="Password" name="password">
            <input class="text-input" type="password" align="center" placeholder="Confirm password" name="password_confirm">
            <select class="text-input" style="text-align-last: center;" name="role" id="role">
                <?php if ($no_admins|| isset($_SESSION['admin_login'])) : ?>
                    <option value="1">Admin</option>
                <?php endif; ?>
                <?php if ($no_admins || isset($_SESSION['admin_login'])) : ?>
                    <option value="2">Teacher</option>
                <?php endif; ?>
                <option value="3">Student</option>
            </select>
            <p style="color:red" id="error" align="center"></p>
            <input class="submit" type="submit" value="Register" align="center">
        </form>
    </div>
    </body>
<script src="../assets/js/login.js"></script>
</html>
