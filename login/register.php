<!DOCTYPE html>
<html lang="en">
    <head>
        <?php
        include_once('../includes/head.php');

        ?>

    </head>
    <body id="login-body">
        <div id="login">
        <p class="sign" align="center">Register</p>
        <form class="login-form" name="login-form" onsubmit="return formValidation()" method="post"
          action="actions/adduser.php">
            <input class="text-input" type="text" align="center" placeholder="Email" name="email">
            <input class="text-input" type="password" align="center" placeholder="Password" name="password">
            <input class="text-input" type="password" align="center" placeholder="Confirm password" name="password_confirm">
            <select class="text-input" style="text-align-last: center;" name="role" id="role">
                <?php if (isset($_SESSION['admin_login']) && !empty($_SESSION['admin_login'])) : ?>
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
