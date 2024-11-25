<?php 

define('URLROOT', 'http://localhost/proyecto-db');
define('ROOT', dirname(__DIR__) . "/proyecto-db");

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require ROOT . '/config.php';
require ROOT . '/functions.php';
require ROOT . '/core/Database.php';
require ROOT . '/core/Model.php';