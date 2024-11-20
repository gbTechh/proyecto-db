<?php
class Hotel {
    private $id_hotel;
    private $nombre;
    private $direccion;
    private $categoria;
    private $telefono;
    private $precio_por_noche;
    private $ciudad;
  
    public function __construct($id_hotel, $nombre, $direccion, $categoria, $telefono, $precio_por_noche, $ciudad) {
      $this->id_hotel = $id_hotel;
      $this->nombre = $nombre;
      $this->direccion = $direccion;
      $this->categoria = $categoria;
      $this->telefono = $telefono;
      $this->precio_por_noche = $precio_por_noche;
      $this->ciudad = $ciudad;
    }

    // Getters
    public function getID() { return $this->id_hotel; }
    public function getNombre() { return $this->nombre; }
    public function getDireccion() { return $this->direccion; }
    public function getCategoria() { return $this->categoria; }
    public function getTelefono() { return $this->telefono; }
    public function getPrecioPorNoche() { return $this->precio_por_noche; }
    public function getCiudad() { return $this->ciudad; } 

    // Setters
    public function setID($id_hotel) { $this->id_hotel = $id_hotel; }
    public function setNombre($nombre) { $this->nombre = $nombre; }
    public function setDireccion($direccion) { $this->direccion = $direccion; }
    public function setCategoria($categoria) { $this->categoria = $categoria; }
    public function setTelefono($telefono) { $this->telefono = $telefono; }
    public function setPrecioPorNoche($precio_por_noche) { $this->precio_por_noche = $precio_por_noche; }
    public function setCiudad($ciudad) { $this->ciudad = $ciudad; }
  
}
