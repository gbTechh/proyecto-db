<?php
class Proveedor {
    private $id_proveedor;
    private $nombre;
    private $direccion;
    private $telefono;
    private $email;
  
    public function __construct($id_proveedor, $nombre, $direccion, $telefono, $email) {
      $this->id_proveedor = $id_proveedor;
      $this->nombre = $nombre;
      $this->direccion = $direccion;
      $this->telefono = $telefono;
      $this->email = $email;
    }

    // Getters
    public function getID() { return $this->id_proveedor; }
    public function getNombre() { return $this->nombre; }
    public function getDireccion() { return $this->direccion; }
    public function getTelefono() { return $this->telefono; }
    public function getEmail() { return $this->email; }

    // Setters
    public function setID($id_proveedor) { $this->id_proveedor = $id_proveedor; }
    public function setNombre($nombre) { $this->nombre = $nombre; }
    public function setDireccion($direccion) { $this->direccion = $direccion; }
    public function setTelefono($telefono) { $this->telefono = $telefono; }
    public function setEmail($email) { $this->email = $email; }
}
