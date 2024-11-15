<?php
class PromocionModel extends Model {

    // Obtener todas las promociones
    public function getAll() {
        $sql = "SELECT ID_promocion, descripcion, descuento, periodo_validez, ID_empleado FROM promocion";
        $stmt = $this->executeQuery($sql);
        $promociones = [];
        
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $promociones[] = new Promocion(
                $row['ID_promocion'],
                $row['descripcion'],
                $row['descuento'],
                $row['periodo_validez'],
                $row['ID_empleado']
            );
        }
        
        return $promociones;
    }

    // Obtener promociones paginadas
    public function getPaginated($page = 1, $limit = 10, $search = '') {
        try {
            $offset = ($page - 1) * $limit;
            
            // Consulta base para obtener promociones
            $sql = "SELECT ID_promocion, descripcion, descuento, periodo_validez, ID_empleado FROM promocion";
            $countSql = "SELECT COUNT(*) as total FROM promocion";
            $params = [];

            // Agregar búsqueda si existe
            if (!empty($search)) {
                $searchWhere = " WHERE descripcion LIKE :search OR ID_promocion LIKE :search";
                $sql .= $searchWhere;
                $countSql .= $searchWhere;
                $params[':search'] = "%$search%";
            }

            // Añadir paginación usando parámetros nombrados
            $sql .= " LIMIT :limit OFFSET :offset";

            // Obtener el total de registros
            $stmt = $this->db->prepare($countSql);
            if (!empty($search)) {
                $stmt->bindValue(':search', "%$search%", PDO::PARAM_STR);
            }
            $stmt->execute();
            $total = $stmt->fetch(PDO::FETCH_ASSOC)['total'];

            // Ejecutar la consulta principal con los parámetros de búsqueda y paginación
            $stmt = $this->db->prepare($sql);
            if (!empty($search)) {
                $stmt->bindValue(':search', "%$search%", PDO::PARAM_STR);
            }
            $stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
            $stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
            $stmt->execute();
            $promociones = [];

            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $promociones[] = new Promocion(
                    $row['ID_promocion'],
                    $row['descripcion'],
                    $row['descuento'],
                    $row['periodo_validez'],
                    $row['ID_empleado']
                );
            }

            // Convertir los objetos Promocion a arrays para JSON
            $promocionesArray = array_map(function($promocion) {
                return [
                    'ID_promocion' => $promocion->getID(),
                    'descripcion' => $promocion->getDescripcion(),
                    'descuento' => $promocion->getDescuento(),
                    'periodo_validez' => $promocion->getPeriodoValidez(),
                    'ID_empleado' => $promocion->getEmpleado()
                ];
            }, $promociones);

            return [
                'data' => $promocionesArray,
                'total' => $total,
                'totalPages' => ceil($total / $limit),
                'currentPage' => $page
            ];

        } catch (PDOException $e) {
            throw new Exception("Error en la consulta: " . $e->getMessage());
        }
    }

    // Obtener promoción por ID
    public function getByID($ID_promocion) {
        $sql = "SELECT * FROM promocion WHERE ID_promocion = ?";
        $stmt = $this->executeQuery($sql, [$ID_promocion]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        
        if ($row) {
            return new Promocion(
                $row['ID_promocion'],
                $row['descripcion'],
                $row['descuento'],
                $row['periodo_validez'],
                $row['ID_empleado']
            );
        }
        return null;
    }

    // Crear una nueva promoción
    public function crear(Promocion $promocion) {
        $sql = "INSERT INTO promocion (ID_promocion, descripcion, descuento, periodo_validez, ID_empleado) 
                VALUES (?, ?, ?, ?, ?)";
        
        return $this->executeQuery($sql, [
            $promocion->getID(),
            $promocion->getDescripcion(),
            $promocion->getDescuento(),
            $promocion->getPeriodoValidez(),
            $promocion->getEmpleado()
        ]);
    }

    // Actualizar una promoción
    public function actualizar(Promocion $promocion) {
        $sql = "UPDATE promocion 
                SET descripcion = ?, descuento = ?, periodo_validez = ?, ID_empleado = ? 
                WHERE ID_promocion = ?";
        
        return $this->executeQuery($sql, [
            $promocion->getDescripcion(),
            $promocion->getDescuento(),
            $promocion->getPeriodoValidez(),
            $promocion->getEmpleado(),
            $promocion->getID()
        ]);
    }

    // Eliminar una promoción
    public function eliminar($ID_promocion) {
        $sql = "DELETE FROM promocion WHERE ID_promocion = ?";
        return $this->executeQuery($sql, [$ID_promocion]);
    }

    // Obtener promociones de un empleado
    public function getByEmpleado($ID_empleado) {
        $sql = "SELECT * FROM promocion WHERE ID_empleado = ?";
        $stmt = $this->executeQuery($sql, [$ID_empleado]);
        $promociones = [];
        
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $promociones[] = new Promocion(
                $row['ID_promocion'],
                $row['descripcion'],
                $row['descuento'],
                $row['periodo_validez'],
                $row['ID_empleado']
            );
        }
        
        return $promociones;
    }
}
