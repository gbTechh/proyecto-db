<?php
class Hotel {
    private $ID_hotel;
    private $nombre;
    private $direccion;
    private $categoria;
    private $telefono;
    private $precio_por_noche;
    private $ID_ciudad;
  
    public function __construct($ID_hotel, $nombre, $direccion, $categoria, $telefono, $precio_por_noche, $ID_ciudad) {
      $this->ID_hotel = $ID_hotel;
      $this->nombre = $nombre;
      $this->direccion = $direccion;
      $this->categoria = $categoria;
      $this->telefono = $telefono;
      $this->precio_por_noche = $precio_por_noche;
      $this->ID_ciudad = $ID_ciudad;
    }

    // Getters
    public function getID() { return $this->ID_hotel; }
    public function getNombre() { return $this->nombre; }
    public function getDireccion() { return $this->direccion; }
    public function getCategoria() { return $this->categoria; }
    public function getTelefono() { return $this->telefono; }
    public function getPrecioPorNoche() { return $this->precio_por_noche; }
    public function getCiudad() { return $this->ID_ciudad; }

    // Setters
    public function setID($ID_hotel) { $this->ID_hotel = $ID_hotel; }
    public function setNombre($nombre) { $this->nombre = $nombre; }
    public function setDireccion($direccion) { $this->direccion = $direccion; }
    public function setCategoria($categoria) { $this->categoria = $categoria; }
    public function setTelefono($telefono) { $this->telefono = $telefono; }
    public function setPrecioPorNoche($precio_por_noche) { $this->precio_por_noche = $precio_por_noche; }
    public function setCiudad($ID_ciudad) { $this->ID_ciudad = $ID_ciudad; }
}
