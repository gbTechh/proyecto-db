<?php
class Ciudad {
    private $ID_ciudad;
    private $nombre;
    private $pais;
  
    public function __construct($ID_ciudad, $nombre, $pais) {
      $this->ID_ciudad = $ID_ciudad;
      $this->nombre = $nombre;
      $this->pais = $pais;
    }

    // Getters
    public function getID() { return $this->ID_ciudad; }
    public function getNombre() { return $this->nombre; }
    public function getPais() { return $this->pais; }

    // Setters
    public function setID($ID_ciudad) { $this->ID_ciudad = $ID_ciudad; }
    public function setNombre($nombre) { $this->nombre = $nombre; }
    public function setPais($pais) { $this->pais = $pais; }
}
