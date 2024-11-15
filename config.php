<?php
// Configuración de base de datos
define('DB_HOST', 'localhost');
define('DB_USER', 'enkit');
define('DB_PASS', '123');
define('DB_NAME', 'agencia');


// URL raíz


require_once ROOT . '/helpers/AssetHelper.php';

function asset($path) {
  return URLROOT . '/' . $path;
}

function image($path) {
  return AssetHelper::image($path);
}