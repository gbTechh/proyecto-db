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

   

}