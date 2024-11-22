<?php
class Servicio {
    private $id_servicio;
    private $proveedor;
    private $descripcion;
    private $costo;
    private $ciudad;

    public function __construct($id_servicio, $proveedor, $descripcion, $costo, $ciudad) {
        $this->id_servicio = $id_servicio;
        $this->proveedor = $proveedor;
        $this->descripcion = $descripcion;
        $this->costo = $costo;
        $this->ciudad = $ciudad;
    }

    // Getters
    public function getID() { return $this->id_servicio; }
    public function getProveedor() { return $this->proveedor; }
    public function getDescripcion() { return $this->descripcion; }
    public function getCosto() { return $this->costo; }
    public function getCiudad() { return $this->ciudad; }

    // Setters
    public function setID($id_servicio) { $this->id_servicio = $id_servicio; }
    public function setProveedor($proveedor) { $this->proveedor = $proveedor; }
    public function setDescripcion($descripcion) { $this->descripcion = $descripcion; }
    public function setCosto($costo) { $this->costo = $costo; }
    public function setCiudad($ciudad) { $this->ciudad = $ciudad; }
}