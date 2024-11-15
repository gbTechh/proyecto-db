<?php
class Pago {
  private $ID_pago;
  private $monto;
  private $fecha;
  private $estado;
  private $metodo_pago;
  private $ID_reserva;

  public function __construct($ID_pago, $monto, $fecha, $estado, $metodo_pago, $ID_reserva) {
    $this->ID_pago = $ID_pago;
    $this->monto = $monto;
    $this->fecha = $fecha;
    $this->estado = $estado;
    $this->metodo_pago = $metodo_pago;
    $this->ID_reserva = $ID_reserva;
  }

  // Getters
  public function getID() { return $this->ID_pago; }
  public function getMonto() { return $this->monto; }
  public function getFecha() { return $this->fecha; }
  public function getEstado() { return $this->estado; }
  public function getMetodo_Pago() { return $this->metodo_pago; }
  public function getReserva() { return $this->ID_reserva; }

  // Setters
  public function setID($ID_pago) { $this->ID_pago = $ID_pago; }
  public function setMonto($monto) { $this->monto = $monto; }
  public function setFecha($fecha) { $this->fecha = $fecha; }
  public function setEstado($estado) { $this->estado = $estado; }
  public function setMetodo_Pago($metodo_pago) { $this->metodo_pago = $metodo_pago; }
  public function setReserva($ID_reserva) { $this->ID_reserva = $ID_reserva; }
}
