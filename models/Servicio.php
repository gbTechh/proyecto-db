<?php
class Servicio {
    private $ID_servicio;
    private $descripcion;
    private $costo;
    private $ciudad;
  
    public function __construct($ID_servicio, $descripcion, $costo, $ciudad) {
      $this->ID_servicio = $ID_servicio;
      $this->descripcion = $descripcion;
      $this->costo = $costo;
      $this->ciudad = $ciudad;
    }

    // Getters
    public function getID() { return $this->ID_servicio; }
    public function getdescripcion() { return $this->descripcion; }
    public function getCosto() { return $this->costo; }
    public function getCiudad() { return $this->ciudad; }

    // Setters
    public function setID($ID_servicio) { $this->ID_servicio = $ID_servicio; }
    public function setdescripcion($descripcion) { $this->descripcion = $descripcion; }
    public function setCosto($costo) { $this->costo = $costo; }
    public function setCiudad($ciudad) { $this->ciudad = $ciudad; }
}
