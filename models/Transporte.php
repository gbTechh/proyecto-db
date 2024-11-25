<?php
class Transporte {
    private $id_transporte;
    private $tipo;
    private $costo;
    private $empresa;
  
    public function __construct($id_transporte, $tipo, $costo, $empresa) {
        $this->id_transporte = $id_transporte;
        $this->tipo = $tipo;
        $this->costo = $costo;
        $this->empresa = $empresa;
    }

    // Getters
    public function getID() { return $this->id_transporte; }
    public function getTipo() { return $this->tipo; }
    public function getCosto() { return $this->costo; }
    public function getEmpresa() { return $this->empresa; }

    // Setters
    public function setID($ID_transporte) { $this->id_transporte = $ID_transporte; }
    public function setTipo($tipo) { $this->tipo = $tipo; }
    public function setCosto($costo) { $this->costo = $costo; }
    public function setEmpresa($empresa) { $this->empresa = $empresa; }
}
?>