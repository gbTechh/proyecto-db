<?php
class PaqueteTuristico {
    private $ID_paquete;
    private $nombre;
    private $descripcion;
    private $precio;
  
    public function __construct($ID_paquete, $nombre, $descripcion, $precio) {
      $this->ID_paquete = $ID_paquete;
      $this->nombre = $nombre;
      $this->descripcion = $descripcion;
      $this->precio = $precio;
    }

    // Getters
    public function getID() { return $this->ID_paquete; }
    public function getNombre() { return $this->nombre; }
    public function getDescripcion() { return $this->descripcion; }
    public function getPrecio() { return $this->precio; }

    // Setters
    public function setID($ID_paquete) { $this->ID_paquete = $ID_paquete; }
    public function setNombre($nombre) { $this->nombre = $nombre; }
    public function setDescripcion($descripcion) { $this->descripcion = $descripcion; }
    public function setPrecio($precio) { $this->precio = $precio; }
}
