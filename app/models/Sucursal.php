<?php 

class Sucursal {
  private $ID_sucursal;
  private $direccion;
  private $nombre;
  private $telefono;

  public function __construct($ID_sucursal, $direccion, $telefono, $nombre) {
    $this->ID_sucursal = $ID_sucursal;
    $this->direccion = $direccion;
    $this->nombre = $nombre;
    $this->telefono = $telefono;
  }

   // Getters
  public function getID() { return $this->ID_sucursal; }
  public function getNombre() { return $this->nombre; }
  public function getDireccion() { return $this->direccion; }
  public function getTelefono() { return $this->telefono; }

  // Setters
  public function setID($id) { $this->ID_sucursal = $id; }
  public function setNombre($nombre) { $this->nombre = $nombre; }
  public function setTelefono($telefono) { $this->telefono = $telefono; }
  public function setDireccion($direccion) { $this->direccion = $direccion; }
}