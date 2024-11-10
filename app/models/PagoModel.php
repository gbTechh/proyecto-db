<?php
class PagoModel extends Model {

    // Obtener todos los pagos
    public function getAll() {
        $sql = "SELECT ID_pago, monto, fecha, estado, metodo_pago, ID_reserva FROM pago";
        $stmt = $this->executeQuery($sql);
        $pagos = [];
        
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $pagos[] = new Pago(
                $row['ID_pago'],
                $row['monto'],
                $row['fecha'],
                $row['estado'],
                $row['metodo_pago'],
                $row['ID_reserva']
            );
        }
        
        return $pagos;
    }

    // Obtener pagos paginados
    public function getPaginated($page = 1, $limit = 10, $search = '') {
        try {
            $offset = ($page - 1) * $limit;
            
            $sql = "SELECT ID_pago, monto, fecha, estado, metodo_pago, ID_reserva FROM pago";
            $countSql = "SELECT COUNT(*) as total FROM pago";
            $params = [];

            // Agregar búsqueda si existe
            if (!empty($search)) {
                $searchWhere = " WHERE ID_pago LIKE :search OR estado LIKE :search OR metodo_pago LIKE :search";
                $sql .= $searchWhere;
                $countSql .= $searchWhere;
                $params[':search'] = "%$search%";
            }

            // Agregar paginación
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
            if (!empty($search)) {
                $stmt->bindValue(':search', "%$search%", PDO::PARAM_STR);
            }
            $stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
            $stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
            $stmt->execute();
            $pagos = [];

            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $pagos[] = new Pago(
                    $row['ID_pago'],
                    $row['monto'],
                    $row['fecha'],
                    $row['estado'],
                    $row['metodo_pago'],
                    $row['ID_reserva']
                );
            }

            // Convertir los objetos Pago a arrays para JSON
            $pagosArray = array_map(function($pago) {
                return [
                    'ID_pago' => $pago->getID(),
                    'monto' => $pago->getMonto(),
                    'fecha' => $pago->getFecha(),
                    'estado' => $pago->getEstado(),
                    'metodo_pago' => $pago->getMetodo_Pago(),
                    'ID_reserva' => $pago->getReserva()
                ];
            }, $pagos);

            return [
                'data' => $pagosArray,
                'total' => $total,
                'totalPages' => ceil($total / $limit),
                'currentPage' => $page
            ];

        } catch (PDOException $e) {
            throw new Exception("Error en la consulta: " . $e->getMessage());
        }
    }

    // Obtener pago por ID
    public function getByID($ID_pago) {
        $sql = "SELECT * FROM pago WHERE ID_pago = ?";
        $stmt = $this->executeQuery($sql, [$ID_pago]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        
        if ($row) {
            return new Pago(
                $row['ID_pago'],
                $row['monto'],
                $row['fecha'],
                $row['estado'],
                $row['metodo_pago'],
                $row['ID_reserva']
            );
        }
        return null;
    }

    // Crear un nuevo pago
    public function crear(Pago $pago) {
        $sql = "INSERT INTO pago (ID_pago, monto, fecha, estado, metodo_pago, ID_reserva) 
                VALUES (?, ?, ?, ?, ?, ?)";
        
        return $this->executeQuery($sql, [
            $pago->getID(),
            $pago->getMonto(),
            $pago->getFecha(),
            $pago->getEstado(),
            $pago->getMetodo_Pago(),
            $pago->getReserva()
        ]);
    }

    // Actualizar un pago
    public function actualizar(Pago $pago) {
        $sql = "UPDATE pago 
                SET monto = ?, fecha = ?, estado = ?, metodo_pago = ?, ID_reserva = ? 
                WHERE ID_pago = ?";
        
        return $this->executeQuery($sql, [
            $pago->getMonto(),
            $pago->getFecha(),
            $pago->getEstado(),
            $pago->getMetodo_Pago(),
            $pago->getReserva(),
            $pago->getID()
        ]);
    }

    // Eliminar un pago
    public function eliminar($ID_pago) {
        $sql = "DELETE FROM pago WHERE ID_pago = ?";
        return $this->executeQuery($sql, [$ID_pago]);
    }

    // Obtener pagos por reserva
    public function getByReserva($ID_reserva) {
        $sql = "SELECT * FROM pago WHERE ID_reserva = ?";
        $stmt = $this->executeQuery($sql, [$ID_reserva]);
        $pagos = [];
        
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $pagos[] = new Pago(
                $row['ID_pago'],
                $row['monto'],
                $row['fecha'],
                $row['estado'],
                $row['metodo_pago'],
                $row['ID_reserva']
            );
        }
        
        return $pagos;
    }
}
