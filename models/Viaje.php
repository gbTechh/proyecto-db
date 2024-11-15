<?php
class Viaje {
    private $ID_viaje;
    private $nombre;
    private $descripcion;
    private $duracion;
    private $precio;
  
    public function __construct($ID_viaje, $nombre, $descripcion, $duracion, $precio) {
      $this->ID_viaje = $ID_viaje;
      $this->nombre = $nombre;
      $this->descripcion = $descripcion;
      $this->duracion = $duracion;
      $this->precio = $precio;
    }

    // Getters
    public function getID() { return $this->ID_viaje; }
    public function getNombre() { return $this->nombre; }
    public function getDescripcion() { return $this->descripcion; }
    public function getDuracion() { return $this->duracion; }
    public function getPrecio() { return $this->precio; }

    // Setters
    public function setID($ID_viaje) { $this->ID_viaje = $ID_viaje; }
    public function setNombre($nombre) { $this->nombre = $nombre; }
    public function setDescripcion($descripcion) { $this->descripcion = $descripcion; }
    public function setDuracion($duracion) { $this->duracion = $duracion; }
    public function setPrecio($precio) { $this->precio = $precio; }
}
