<?php
class Cliente {
    private $dni;
    private $nombre;
    private $apellidos;
    private $telefono;
    private $email;
    private $c_username;
    private $c_password;

    public function __construct($dni, $nombre, $apellidos, $telefono, $email, $c_username, $c_password) {
        $this->dni = $dni;
        $this->nombre = $nombre;
        $this->apellidos = $apellidos;
        $this->telefono = $telefono;
        $this->email = $email;
        $this->c_username = $c_username;
        $this->c_password = $c_password;
    }

    // Getters
    public function getID() { return $this->dni; }
    public function getNombre() { return $this->nombre; }
    public function getApellidos() { return $this->apellidos; }
    public function getTelefono() { return $this->telefono; }
    public function getEmail() { return $this->email; }
    public function getUsername() { return $this->c_username; }
    public function getPassword() { return $this->c_password; }

    // Setters
    public function setID($dni) { $this->dni = $dni; }
    public function setNombre($nombre) { $this->nombre = $nombre; }
    public function setApellidos($apellidos) { $this->apellidos = $apellidos; }
    public function setTelefono($telefono) { $this->telefono = $telefono; }
    public function setEmaiñ($email) { $this->email = $email; }
    public function setUsername($username) { $this->c_username = $username; }
    public function setPassword($password) { $this->c_password = $password; }

    // Método para obtener nombre completo
    public function getNombreCompleto() {
        return $this->nombre . ' ' . $this->apellidos;
    }
}