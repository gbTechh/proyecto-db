<?php
class Proveedor {
    private $ID_proveedor;
    private $nombre;
    private $direccion;
    private $telefono;
    private $email;
  
    public function __construct($ID_proveedor, $nombre, $direccion, $telefono, $email) {
      $this->ID_proveedor = $ID_proveedor;
      $this->nombre = $nombre;
      $this->direccion = $direccion;
      $this->telefono = $telefono;
      $this->email = $email;
    }

    // Getters
    public function getID() { return $this->ID_proveedor; }
    public function getNombre() { return $this->nombre; }
    public function getDireccion() { return $this->direccion; }
    public function getTelefono() { return $this->telefono; }
    public function getEmail() { return $this->email; }

    // Setters
    public function setID($ID_proveedor) { $this->ID_proveedor = $ID_proveedor; }
    public function setNombre($nombre) { $this->nombre = $nombre; }
    public function setDireccion($direccion) { $this->direccion = $direccion; }
    public function setTelefono($telefono) { $this->telefono = $telefono; }
    public function setEmail($email) { $this->email = $email; }
}
