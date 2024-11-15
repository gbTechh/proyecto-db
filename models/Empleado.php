<?php
class Empleado {
    private $dni;
    private $nombre;
    private $apellidos;
    private $telefono;
    private $id_sucursal;
    private $puesto;
    private $e_username;
    private $e_password;

    public function __construct($dni, $nombre, $apellidos, $telefono, $id_sucursal, $puesto, $e_username, $e_password) {
        $this->dni = $dni;
        $this->nombre = $nombre;
        $this->apellidos = $apellidos;
        $this->telefono = $telefono;
        $this->id_sucursal = $id_sucursal;
        $this->puesto = $puesto;
        $this->e_username = $e_username;
        $this->e_password = $e_password;
    }

    // Getters
    public function getID() { return $this->dni; }
    public function getNombre() { return $this->nombre; }
    public function getApellidos() { return $this->apellidos; }
    public function getTelefono() { return $this->telefono; }
    public function getSucursal() { return $this->id_sucursal; }
    public function getPuesto() { return $this->puesto; }
    public function getUsername() { return $this->e_username; }
    public function getPassword() { return $this->e_password; }

    // Setters
    public function setID($dni) { $this->dni = $dni; }
    public function setNombre($nombre) { $this->nombre = $nombre; }
    public function setApellidos($apellidos) { $this->apellidos = $apellidos; }
    public function setTelefono($telefono) { $this->telefono = $telefono; }
    public function setSucursal($sucursal) { $this->id_sucursal = $sucursal; }
    public function setPuesto($puesto) { $this->puesto = $puesto; }
    public function setUsername($username) { $this->e_username = $username; }
    public function setPassword($password) { $this->e_password = $password; }

    // Método para obtener nombre completo
    public function getNombreCompleto() {
        return $this->nombre . ' ' . $this->apellidos;
    }
}