<?php
class PaqueteTuristico {
    private $ID_paquete;
    private $nombre;
    private $descripcion;
    private $precio;
    private $ciudad;
    private $imagen;
  
    public function __construct($ID_paquete, $nombre, $descripcion, $precio, $ciudad, $imagen) {
      $this->ID_paquete = $ID_paquete;
      $this->nombre = $nombre;
      $this->descripcion = $descripcion;
      $this->precio = $precio;
      $this->ciudad = $ciudad;
      $this->imagen = $imagen;
    }

    // Getters
    public function getID() { return $this->ID_paquete; }
    public function getNombre() { return $this->nombre; }
    public function getDescripcion() { return $this->descripcion; }
    public function getPrecio() { return $this->precio; }
    public function getCiudad() { return $this->ciudad; }
    public function getImagen() { return $this->imagen; }

    // Setters
    public function setID($ID_paquete) { $this->ID_paquete = $ID_paquete; }
    public function setNombre($nombre) { $this->nombre = $nombre; }
    public function setDescripcion($descripcion) { $this->descripcion = $descripcion; }
    public function setPrecio($precio) { $this->precio = $precio; }
    public function setCiudad($ciudad) { $this->ciudad = $ciudad; }
    public function setImagen($imagen) { $this->imagen = $imagen; }
}
