<?php
require '../init.php';

session_unset();
session_destroy();
setcookie(session_name(), '', time() - 3600, '/');
header('Location: ' . URLROOT . '/admin/login.php');
exit;