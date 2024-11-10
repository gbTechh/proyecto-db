<?php
class Promocion {
    private $ID_promocion;
    private $descripcion;
    private $descuento;
    private $periodo_validez;
    private $ID_empleado;
  
    public function __construct($ID_promocion, $descripcion, $descuento, $periodo_validez, $ID_empleado) {
      $this->ID_promocion = $ID_promocion;
      $this->descripcion = $descripcion;
      $this->descuento = $descuento;
      $this->periodo_validez = $periodo_validez;
      $this->ID_empleado = $ID_empleado;
    }

    // Getters
    public function getID() { return $this->ID_promocion; }
    public function getDescripcion() { return $this->descripcion; }
    public function getDescuento() { return $this->descuento; }
    public function getPeriodoValidez() { return $this->periodo_validez; }
    public function getEmpleado() { return $this->ID_empleado; }

    // Setters
    public function setID($ID_promocion) { $this->ID_promocion = $ID_promocion; }
    public function setDescripcion($descripcion) { $this->descripcion = $descripcion; }
    public function setDescuento($descuento) { $this->descuento = $descuento; }
    public function setPeriodoValidez($periodo_validez) { $this->periodo_validez = $periodo_validez; }
    public function setEmpleado($ID_empleado) { $this->ID_empleado = $ID_empleado; }
}
