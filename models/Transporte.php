<?php
class Transporte {
    private $ID_transporte;
    private $telefono;
    private $empresa;
  
    public function __construct($ID_transporte, $telefono, $empresa) {
      $this->ID_transporte = $ID_transporte;
      $this->telefono = $telefono;
      $this->empresa = $empresa;
    }

    // Getters
    public function getID() { return $this->ID_transporte; }
    public function getTelefono() { return $this->telefono; }
    public function getEmpresa() { return $this->empresa; }

    // Setters
    public function setID($ID_transporte) { $this->ID_transporte = $ID_transporte; }
    public function setTelefono($telefono) { $this->telefono = $telefono; }
    public function setEmpresa($empresa) { $this->empresa = $empresa; }
}
