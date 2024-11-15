<?php
class AssetHelper {
    /**
     * Obtiene la URL completa para un archivo de imagen
     */
     public static function image($path) {
        return URLROOT . '/public/assets/img/' . $path;
    }
    public static function imageAdmin($path) {
        return URLROOT . '/admin/assets/img/' . $path;
    }

    /**
     * Obtiene la URL completa para un archivo CSS
     */
    public static function css($path) {
        return URLROOT . '/css/' . $path;
    }

    /**
     * Obtiene la URL completa para un archivo JavaScript
     */
    public static function js($path) {
        return URLROOT . '/js/' . $path;
    }

    /**
     * Verifica si un archivo de imagen existe
     */
    public static function imageExists($path) {
        return file_exists(ROOT . '/public/img/' . $path);
    }
}