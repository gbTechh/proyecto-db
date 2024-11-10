<?php
class Reserva {
    private $ID_reserva;
    private $fecha;
    private $num_personas;
    private $estado;
    private $ID_cliente;
    private $ID_empleado;
    private $ID_viaje;
  
    public function __construct($ID_reserva, $fecha, $num_personas, $estado, $ID_cliente, $ID_empleado, $ID_viaje) {
      $this->ID_reserva = $ID_reserva;
      $this->fecha = $fecha;
      $this->num_personas = $num_personas;
      $this->estado = $estado;
      $this->ID_cliente = $ID_cliente;
      $this->ID_empleado = $ID_empleado;
      $this->ID_viaje = $ID_viaje;
    }
  
    // Getters
    public function getID() { return $this->ID_reserva; }
    public function getFecha() { return $this->fecha; }
    public function getNum_Personas() { return $this->num_personas; }
    public function getEstado() { return $this->estado; }
    public function getCliente() { return $this->ID_cliente; }
    public function getEmpleado() { return $this->ID_empleado; }
    public function getViaje() { return $this->ID_viaje; }
  
    // Setters
    public function setID($ID_reserva) { $this->ID_reserva = $ID_reserva; }
    public function setFecha($fecha) { $this->fecha = $fecha; }
    public function setNum_Personas($num_personas) { $this->num_personas = $num_personas; }
    public function setEstado($estado) { $this->estado = $estado; }
    public function setCliente($ID_cliente) { $this->ID_cliente = $ID_cliente; }
    public function setEmpleado($ID_empleado) { $this->ID_empleado = $ID_empleado; }
    public function setViaje($ID_viaje) { $this->ID_viaje = $ID_viaje; }
  }
  