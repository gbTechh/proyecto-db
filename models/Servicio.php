<?php
class Servicio {
    private $id_servicio;
    private $id_proveedor;
    private $descripcion;
    private $costo;
    private $id_ciudad;

    public function __construct($id_servicio, $id_proveedor, $descripcion, $costo, $id_ciudad) {
        $this->id_servicio = $id_servicio;
        $this->id_proveedor = $id_proveedor;
        $this->descripcion = $descripcion;
        $this->costo = $costo;
        $this->id_ciudad = $id_ciudad;
    }

    // Getters
    public function getID() { return $this->id_servicio; }
    public function getProveedor() { return $this->id_proveedor; }
    public function getDescripcion() { return $this->descripcion; }
    public function getCosto() { return $this->costo; }
    public function getCiudad() { return $this->id_ciudad; }

    // Setters
    public function setID($id_servicio) { $this->id_servicio = $id_servicio; }
    public function setProveedor($id_proveedor) { $this->id_proveedor = $id_proveedor; }
    public function setDescripcion($descripcion) { $this->descripcion = $descripcion; }
    public function setCosto($costo) { $this->costo = $costo; }
    public function setCiudad($id_ciudad) { $this->id_ciudad = $id_ciudad; }
}