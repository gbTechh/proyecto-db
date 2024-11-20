<?php
class GuiaTuristico {
    private $id_guia;
    private $nombre;
    private $telefono;
    private $idioma;
    private $id_ciudad;
  
    public function __construct($id_guia, $nombre, $telefono, $idioma, $id_ciudad) {
      $this->id_guia = $id_guia;
      $this->nombre = $nombre;
      $this->telefono = $telefono;
      $this->idioma = $idioma;
      $this->id_ciudad = $id_ciudad;
    }

    // Getters
    public function getID() { return $this->id_guia; }
    public function getNombre() { return $this->nombre; }
    public function getTelefono() { return $this->telefono; }
    public function getIdiomas() { return $this->idioma; }
    public function getCiudad() { return $this->id_ciudad; }

    // Setters
    public function setID($id_guia) { $this->id_guia = $id_guia; }
    public function setNombre($nombre) { $this->nombre = $nombre; }
    public function setTelefono($telefono) { $this->telefono = $telefono; }
    public function setIdiomas($idioma) { $this->idioma = $idioma; }
    public function setCiudad($id_ciudad) { $this->id_ciudad = $id_ciudad; }
}
