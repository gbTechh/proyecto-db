<?php
class GuiaTuristico {
    private $ID_guia;
    private $nombre;
    private $telefono;
    private $idioma;
    private $ID_ciudad;
  
    public function __construct($ID_guia, $nombre, $telefono, $idioma, $ID_ciudad) {
      $this->ID_guia = $ID_guia;
      $this->nombre = $nombre;
      $this->telefono = $telefono;
      $this->idioma = $idioma;
      $this->ID_ciudad = $ID_ciudad;
    }

    // Getters
    public function getID() { return $this->ID_guia; }
    public function getNombre() { return $this->nombre; }
    public function getTelefono() { return $this->telefono; }
    public function getIdioma() { return $this->idioma; }
    public function getCiudad() { return $this->ID_ciudad; }

    // Setters
    public function setID($ID_guia) { $this->ID_guia = $ID_guia; }
    public function setNombre($nombre) { $this->nombre = $nombre; }
    public function setTelefono($telefono) { $this->telefono = $telefono; }
    public function setIdioma($idioma) { $this->idioma = $idioma; }
    public function setCiudad($ID_ciudad) { $this->ID_ciudad = $ID_ciudad; }
}
