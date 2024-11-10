<?php
// Configuración de base de datos
define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', 'root');
define('DB_NAME', 'agenciaviajes');

// URL raíz
define('URLROOT', 'http://localhost/agencia');

require_once ROOT . '/core/helpers/AssetHelper.php';

function asset($path) {
  return URLROOT . '/' . $path;
}

function image($path) {
  return AssetHelper::image($path);
}