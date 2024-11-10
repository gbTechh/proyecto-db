<?php
class EmpleadoModel extends Model {
    
    // Obtener todos los empleados
    public function getAll() {
        $sql = "SELECT dni, nombre, apellidos, telefono, id_sucursal, puesto, e_username, e_password FROM empleado";
        $stmt = $this->executeQuery($sql);
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
    public function getPaginated($page = 1, $limit = 10, $search = '') {
        try {
            $offset = ($page - 1) * $limit;
            
            // Construir la consulta base
            $sql = "SELECT dni, nombre, apellidos, telefono, id_sucursal, puesto, e_username 
                   FROM empleado";
            $countSql = "SELECT COUNT(*) as total FROM empleado";
            $params = [];

            // Agregar búsqueda si existe
            if (!empty($search)) {
                $searchWhere = " WHERE nombre LIKE :search OR apellidos LIKE :search OR dni LIKE :search";
                $sql .= $searchWhere;
                $countSql .= $searchWhere;
                $params[':search'] = "%$search%";
            }

            // Agregar paginación usando parámetros nombrados
            $sql .= " LIMIT :limit OFFSET :offset";

            // Obtener total de registros
            $stmt = $this->db->prepare($countSql);
            if (!empty($search)) {
                $stmt->bindValue(':search', "%$search%", PDO::PARAM_STR);
            }
            $stmt->execute();
            $total = $stmt->fetch(PDO::FETCH_ASSOC)['total'];

            // Preparar y ejecutar la consulta principal
            $stmt = $this->db->prepare($sql);
            
            // Vincular parámetros de búsqueda si existen
            if (!empty($search)) {
                $stmt->bindValue(':search', "%$search%", PDO::PARAM_STR);
            }
            
            // Vincular parámetros de paginación
            $stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
            $stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
            
            $stmt->execute();
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
                    ''  // No enviamos la contraseña
                );
            }

            // Convertir los objetos Empleado a arrays para JSON
            $empleadosArray = array_map(function($empleado) {
                return [
                    'dni' => $empleado->getID(),
                    'nombre' => $empleado->getNombre(),
                    'apellidos' => $empleado->getApellidos(),
                    'telefono' => $empleado->getTelefono(),
                    'id_sucursal' => $empleado->getSucursal(),
                    'puesto' => $empleado->getPuesto(),
                    'username' => $empleado->getUsername()
                ];
            }, $empleados);

            return [
                'data' => $empleadosArray,
                'total' => $total,
                'totalPages' => ceil($total / $limit),
                'currentPage' => $page
            ];

        } catch (PDOException $e) {
            throw new Exception("Error en la consulta: " . $e->getMessage());
        }
    }
    // Obtener empleado por DNI
    public function getByDni($dni) {
        $sql = "SELECT * FROM empleado WHERE dni = ?";
        $stmt = $this->executeQuery($sql, [$dni]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        
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
        $sql = "INSERT INTO empleado (dni, nombre, apellidos, telefono, id_sucursal, puesto, e_username, e_password) 
                VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
        
        return $this->executeQuery($sql, [
            $empleado->getID(),
            $empleado->getNombre(),
            $empleado->getApellidos(),
            $empleado->getTelefono(),
            $empleado->getSucursal(),
            $empleado->getPuesto(),
            $empleado->getUsername(),
            $empleado->getPassword()
        ]);
    }

    // Actualizar empleado
    public function actualizar(Empleado $empleado) {
        $sql = "UPDATE empleado 
                SET nombre = ?, apellidos = ?, telefono = ?, 
                    id_sucursal = ?, puesto = ?, e_username = ?, e_password = ? 
                WHERE dni = ?";
        
        return $this->executeQuery($sql, [
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
        return $this->executeQuery($sql, [$dni]);
    }

    // Buscar empleados por sucursal
    public function getBySucursal($idSucursal) {
        $sql = "SELECT * FROM empleado WHERE id_sucursal = ?";
        $stmt = $this->executeQuery($sql, [$idSucursal]);
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