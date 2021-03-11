<?php
session_start();
if (!isset($_SESSION['admin_login']) || empty($_SESSION['admin_login'])) {
    header('location: ../login');
    exit;
}
echo "Jemi qasur si admin!";
