<?php
class Servicio {
    private $ID_servicio;
    private $tipo_transporte;
    private $empresa;
    private $costo;
  
    public function __construct($ID_servicio, $tipo_transporte, $empresa, $costo) {
      $this->ID_servicio = $ID_servicio;
      $this->tipo_transporte = $tipo_transporte;
      $this->empresa = $empresa;
      $this->costo = $costo;
    }

    // Getters
    public function getID() { return $this->ID_servicio; }
    public function getTipoTransporte() { return $this->tipo_transporte; }
    public function getEmpresa() { return $this->empresa; }
    public function getCosto() { return $this->costo; }

    // Setters
    public function setID($ID_servicio) { $this->ID_servicio = $ID_servicio; }
    public function setTipoTransporte($tipo_transporte) { $this->tipo_transporte = $tipo_transporte; }
    public function setEmpresa($empresa) { $this->empresa = $empresa; }
    public function setCosto($costo) { $this->costo = $costo; }
}
