<?php
class Vuelo {
    private $ID_vuelo;
    private $num_vuelo;
    private $ciudad_origen;
    private $ciudad_destino;
    private $fecha_salida;
    private $fecha_llegada;
    private $precio;
  
    public function __construct($ID_vuelo, $num_vuelo, $ciudad_origen, $ciudad_destino, $fecha_salida, $fecha_llegada, $precio) {
      $this->ID_vuelo = $ID_vuelo;
      $this->num_vuelo = $num_vuelo;
      $this->ciudad_origen = $ciudad_origen;
      $this->ciudad_destino = $ciudad_destino;
      $this->fecha_salida = $fecha_salida;
      $this->fecha_llegada = $fecha_llegada;
      $this->precio = $precio;
    }

    // Getters
    public function getID() { return $this->ID_vuelo; }
    public function getNumVuelo() { return $this->num_vuelo; }
    public function getCiudadOrigen() { return $this->ciudad_origen; }
    public function getCiudadDestino() { return $this->ciudad_destino; }
    public function getFechaSalida() { return $this->fecha_salida; }
    public function getFechaLlegada() { return $this->fecha_llegada; }
    public function getPrecio() { return $this->precio; }

    // Setters
    public function setID($ID_vuelo) { $this->ID_vuelo = $ID_vuelo; }
    public function setNumVuelo($num_vuelo) { $this->num_vuelo = $num_vuelo; }
    public function setCiudadOrigen($ciudad_origen) { $this->ciudad_origen = $ciudad_origen; }
    public function setCiudadDestino($ciudad_destino) { $this->ciudad_destino = $ciudad_destino; }
    public function setFechaSalida($fecha_salida) { $this->fecha_salida = $fecha_salida; }
    public function setFechaLlegada($fecha_llegada) { $this->fecha_llegada = $fecha_llegada; }
    public function setPrecio($precio) { $this->precio = $precio; }
}
