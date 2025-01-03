<?php
class ClienteModel extends Model {
    
    protected $db;
    
    public function __construct() {
        $this->db = Database::getInstance();
    }

    // Obtener todos los clientes
    public function getAll() {
        $sql = "SELECT dni as 'id', nombre as 'nombre', apellidos as 'apellidos', telefono as 'telefono', email as 'email',c_username,c_password FROM cliente";
       
        $rows = $this->db->getAll($sql);
        $clientes = [];
        
        foreach($rows as $row) {
            $ciudad = new Cliente(
                $row['id'],
                $row['nombre'],
                $row['apellidos'],
                $row['telefono'],
                $row['email'],
                $row['c_username'],
                $row['c_password']
            );
            $clientes[] = $ciudad;
        }
                   
        return $clientes;
    }

    public function crear(Cliente $cliente) {
        try { 
            $sql = "INSERT INTO cliente (dni, nombre, apellidos, telefono, email, c_username, c_password) 
                    VALUES (:dni, :nombre, :apellidos, :telefono, :email, :username, :password)";
            
            $params = [
                ':dni' => $cliente->getID(),
                ':nombre' => $cliente->getNombre(),
                ':apellidos' => $cliente->getApellidos(),
                ':telefono' => $cliente->getTelefono(),
                ':email' => $cliente->getEmail(),
                ':username' => $cliente->getUsername(),
                ':password' => $cliente->getPassword()
            ];

            $stmt = $this->db->executeQuery($sql, $params);
            return $stmt->rowCount() > 0;    

        } catch (PDOException $e) {
            throw new Exception("Error al crear cliente: " . $e->getMessage());
        }    
    }

    public function existeEmail($email, $excludeId = null) {
        $sql = "SELECT COUNT(*) FROM cliente WHERE email = :email";
        $params = [':email' => $email];
        
        if ($excludeId !== null) {
            $sql .= " AND DNI != :id";
            $params[':id'] = $excludeId;
        }
        
        $stmt = $this->db->executeQuery($sql, $params);
        return $stmt->fetchColumn() > 0;
    }
   

}