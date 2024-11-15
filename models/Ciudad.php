<?php
class Ciudad {
    private $ID_ciudad;
    private $nombre;
    private $pais;
    private $cant_guias;
    private $cant_hoteles;
  
    public function __construct($ID_ciudad, $nombre, $pais, $cant_guias, $cant_hoteles) {
      $this->ID_ciudad = $ID_ciudad;
      $this->nombre = $nombre;
      $this->pais = $pais;
      $this->cant_guias = $cant_guias;
      $this->cant_hoteles = $cant_hoteles;
    }

    // Getters
    public function getID() { return $this->ID_ciudad; }
    public function getNombre() { return $this->nombre; }
    public function getPais() { return $this->pais; }
    public function getGuias() { return $this->cant_guias; }
    public function getHoteles() { return $this->cant_hoteles; }

    // Setters
    public function setID($ID_ciudad) { $this->ID_ciudad = $ID_ciudad; }
    public function setNombre($nombre) { $this->nombre = $nombre; }
    public function setPais($pais) { $this->pais = $pais; }
}

