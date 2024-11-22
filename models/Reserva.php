<?php
class Reserva {
    private $ID_reserva;
    private $fecha;
    private $estado;
    private $id_viaje;
    private $id_sucursal;
    private $dni_empleado;
    private $dni_cliente;
    private $nombre_cliente;
  
    public function __construct($ID_reserva, $fecha, $estado, $id_viaje, $id_sucursal, $dni_empleado, $dni_cliente = '', $nombre_cliente = '') {
      $this->ID_reserva = $ID_reserva;
      $this->fecha = $fecha;
      $this->estado = $estado;
      $this->id_viaje = $id_viaje;
      $this->id_sucursal = $id_sucursal;
      $this->dni_empleado = $dni_empleado;
      $this->dni_cliente = $dni_cliente;
      $this->nombre_cliente = $nombre_cliente;
    }
  
    // Getters
    public function getID() { return $this->ID_reserva; }
    public function getFecha() { return $this->fecha; }
    public function getEstado() { return $this->estado; }
    public function getViaje() { return $this->id_viaje; }
    public function getSucursal() { return $this->id_sucursal; }
    public function getEmpleado() { return $this->dni_empleado; }
    public function getDniCliente() { return $this->dni_cliente; }
    public function getCliente() { return $this->nombre_cliente; }
  
    // Setters
    public function setID($ID_reserva) { $this->ID_reserva = $ID_reserva; }
    public function setFecha($fecha) { $this->fecha = $fecha; }
    public function setEstado($estado) { $this->estado = $estado; }
    public function setViaje($id_viaje) { $this->id_viaje = $id_viaje; }
    public function setSucursal($id_sucursal) { $this->id_sucursal = $id_sucursal; }
    public function setEmpleado($dni_empleado) { $this->dni_empleado = $dni_empleado; }
    public function setDniCliente($dni_cliente) { $this->dni_cliente = $dni_cliente; }
    public function setCliente($cliente) { $this->nombre_cliente = $cliente; }
  }
  