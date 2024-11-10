<?php
class ClienteModel extends Model {
    
    // Obtener todos los clientes
    public function getAll() {
        $sql = "SELECT DNI as 'id', Nombre as 'nombre', Apellidos as 'apellidos', Telefono as 'telefono', Email as 'email',c_username,c_password FROM cliente";
        $stmt = $this->executeQuery($sql);
        $clientes = [];
        
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $clientes[] = new Cliente(
                $row['id'],
                $row['nombre'],
                $row['apellidos'],
                $row['telefono'],
                $row['email'],
                $row['c_username'],
                $row['c_password']
            );
        }
        
        return $clientes;
    }

    public function crear(Cliente $cliente) {
        try {
            $sql = "INSERT INTO cliente (Nombre, Apellidos, Telefono, Email, c_username, c_password) 
                    VALUES (:nombre, :apellidos, :telefono, :email, :username, :password)";
            
            $params = [
                ':nombre' => $cliente->getNombre(),
                ':apellidos' => $cliente->getApellidos(),
                ':telefono' => $cliente->getTelefono(),
                ':email' => $cliente->getEmail(),
                ':username' => $cliente->getUsername(),
                ':password' => $cliente->getPassword()
            ];

            $stmt = $this->db->prepare($sql);
            $stmt->execute($params);
            
            return $this->db->lastInsertId();
        } catch (PDOException $e) {
            throw new Exception("Error al crear cliente: " . $e->getMessage());
        }    
    }

    public function existeEmail($email, $excludeId = null) {
        $sql = "SELECT COUNT(*) FROM cliente WHERE email = :email";
        $params = [':email' => $email];
        
        if ($excludeId !== null) {
            $sql .= " AND id != :id";
            $params[':id'] = $excludeId;
        }
        
        $stmt = $this->db->prepare($sql);
        $stmt->execute($params);
        return $stmt->fetchColumn() > 0;
    }
   

}