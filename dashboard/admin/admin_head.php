<?php
ob_start();
session_start();
define( 'WEB_ROOT', 'http://localhost/e-school' );
define('PHP_ROOT', $_SERVER['DOCUMENT_ROOT'] . '/e-school');
if (!isset($_SESSION['admin_login']) || empty($_SESSION['admin_login'])) {
    header('location: ../login');
    exit;
} ?>
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Admin Dashboard</title>
<link rel="stylesheet"  href="<?= WEB_ROOT ?>/assets/css/main.css">
