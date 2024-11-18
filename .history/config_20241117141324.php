<?php
// Configuración de base de datos
define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_NAME', 'DB_PF');


// URL raíz


require_once ROOT . '/helpers/AssetHelper.php';

function asset($path) {
  return URLROOT . '/' . $path;
}

function image($path) {
  return AssetHelper::image($path);
}