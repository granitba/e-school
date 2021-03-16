<?php
ob_start();
session_start();
define( 'WEB_ROOT', 'http://localhost/e-school' );
if (!isset($_SESSION['student_login']) || empty($_SESSION['student_login'])) {
    header('location: ../login');
    exit;
} ?>
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Student Dashboard</title>
<link rel="stylesheet"  href="<?= WEB_ROOT ?>/assets/css/main.css">
