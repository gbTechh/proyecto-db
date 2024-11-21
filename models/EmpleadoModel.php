<?php
class EmpleadoModel extends Model {
    
    // Obtener todos los empleados
    public function getAll() {      

        $sql = "SELECT e.dni, e.nombre, e.apellidos, e.telefono, s.nombre as 'name_sucursal', e.puesto, e.e_username, e.e_password FROM empleado e 
        LEFT JOIN sucursal s on s.id_sucursal = e.id_sucursal;";
        
        $rows = $this->db->getAll($sql);
        $empleados = [];
        
        foreach($rows as $row) {
            $empleado = new Empleado(
                $row['dni'],
                $row['nombre'],
                $row['apellidos'],
                $row['telefono'],
                $row['name_sucursal'],
                $row['puesto'],
                $row['e_username'],
                $row['e_password']
            );
            $empleados[] = $empleado;
        }
        
        return $empleados;

    }
   
    // Obtener empleado por DNI
    public function getByDni($dni) {
        $sql = "SELECT * FROM empleado WHERE dni = ?";
        $row = $this->db->getOne($sql, [$dni]);
        if ($row) {
            return new Empleado(
                $row['dni'],
                $row['nombre'],
                $row['apellidos'],
                $row['telefono'],
                $row['id_sucursal'],
                $row['puesto'],
                $row['e_username'],
                $row['e_password']
            );
        }
        return null;
    }

    // Crear nuevo empleado
    public function crear(Empleado $empleado) {        
        try { 
            $sql = "INSERT INTO empleado (dni, nombre, apellidos, telefono, id_sucursal, puesto, e_username, e_password) VALUES (:dni, :nombre, :apellidos, :telefono, :id_sucursal, :puesto, :username, :password)";
            
            $params = [
                ':dni' => $empleado->getID(),
                ':nombre' => $empleado->getNombre(),
                ':apellidos' => $empleado->getApellidos(),
                ':telefono' => $empleado->getTelefono(),
                ':id_sucursal' => $empleado->getSucursal(),
                ':puesto' => $empleado->getPuesto(),
                ':username' => $empleado->getUsername(),
                ':password' => $empleado->getPassword()
            ];

            $stmt = $this->db->executeQuery($sql, $params);
            return $stmt->rowCount() > 0;    

        } catch (PDOException $e) {
            throw new Exception("Error al crear el empleado: " . $e->getMessage());
        }    
    }

    // Actualizar empleado
    public function actualizar(Empleado $empleado) {
        $sql = "UPDATE empleado 
                SET nombre = ?, apellidos = ?, telefono = ?, 
                    id_sucursal = ?, puesto = ?, e_username = ?, e_password = ? 
                WHERE dni = ?";
        
        return $this->db->executeQuery($sql, [
            $empleado->getNombre(),
            $empleado->getApellidos(),
            $empleado->getTelefono(),
            $empleado->getSucursal(),
            $empleado->getPuesto(),
            $empleado->getUsername(),
            $empleado->getPassword(),
            $empleado->getID()
        ]);
    }

    // Eliminar empleado
    public function eliminar($dni) {
        $sql = "DELETE FROM empleado WHERE dni = ?";
        return $this->db->executeQuery($sql, [$dni]);
    }

    // Buscar empleados por sucursal
    public function getBySucursal($idSucursal) {
        $sql = "SELECT * FROM empleado WHERE id_sucursal = ?";
        $stmt = $this->db->executeQuery($sql, [$idSucursal]);
        $empleados = [];
        
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $empleados[] = new Empleado(
                $row['dni'],
                $row['nombre'],
                $row['apellidos'],
                $row['telefono'],
                $row['id_sucursal'],
                $row['puesto'],
                $row['e_username'],
                $row['e_password']
            );
        }
        
        return $empleados;
    }
}