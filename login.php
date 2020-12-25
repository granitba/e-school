<!DOCTYPE html>
<html lang="en">
<head>
    <?php include_once('includes/head.php'); ?>
</head>
<body id="login-body">
<div id="login">
    <p class="sign" align="center">Sign in</p>
    <form class="login-form" name="login-form" onsubmit="return formValidation()" method="post">
        <input class="text-input" type="text" align="center" placeholder="Email" name="email">
        <input class="text-input" type="password" align="center" placeholder="Password" name="password">
        <p style="color:red" id="error" align="center"></p>
        <input class="submit" type="submit" value="Sign in" align="center">
        <p class="forgot" align="center"><a href="#">Forgot Password?</p>
    </form>
</div>
</body>
<script src="assets/js/main.js"></script>
</html>
