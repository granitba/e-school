<!DOCTYPE html>
<html lang="en">
    <head>
        <?php include_once('../includes/head.php'); ?>
    </head>
    <?php
    //Nese useri eshte i loguar, te redirektohet ne indexin e faqes perkatse
    if (isset($_SESSION['admin_login']) && $_SESSION['admin_login'] == true) {
        header('location: ./admin/index');
        exit;
    }
    if (isset($_SESSION['teacher_login']) && $_SESSION['teacher_login'] == true) {
        header('location: ./teacher/index');
        exit;
    }
    if (isset($_SESSION['student_login']) && $_SESSION['student_login'] == true) {
        header('location: ./student/index');
        exit;
    }
    ?>
    <body id="login-body">
        <div id="login">
            <p class="sign" align="center">Sign in</p>
            <form class="login-form" name="login-form" onsubmit="return formValidation()" method="post"
                  action="actions/signin.php">
                <input class="text-input" type="text" align="center" placeholder="Email" name="email">
                <input class="text-input" type="password" align="center" placeholder="Password" name="password">
                <p style="color:red" id="error" align="center"></p>
                <input class="submit" type="submit" value="Sign in" align="center">
                <p class="forgot" align="center"><a href="#">Forgot Password?</p>
            </form>
        </div>
    </body>
    <script src="../assets/js/login.js"></script>
</html>
