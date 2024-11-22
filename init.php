<?php 

define('URLROOT', 'http://localhost/agencia');
define('ROOT', dirname(__DIR__) . "/agencia");

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require ROOT . '/config.php';
require ROOT . '/functions.php';
require ROOT . '/core/Database.php';
require ROOT . '/core/Model.php';