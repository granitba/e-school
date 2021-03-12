<?php
ob_start();
session_start();
define( 'WEB_ROOT', 'http://localhost/e-school' );
?>
<title>E-School</title>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="icon" href="logo.svg" type="image/x-icon">
<link rel="stylesheet"  href="<?= WEB_ROOT ?>/assets/css/main.css">