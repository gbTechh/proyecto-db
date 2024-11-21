<?php
class ReservaModel extends Model {

    // Obtener todas las reservas
    public function getAll() {
        $sql = "SELECT id_reserva, fecha, num_personas, estado, ID_cliente, ID_empleado, ID_viaje FROM reserva";
        $stmt = $this->db->executeQuery($sql);
        $reservas = [];
        
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $reservas[] = new Reserva(
                $row['id_reserva'],
                $row['fecha'],
                $row['num_personas'],
                $row['estado'],
                $row['ID_cliente'],
                $row['ID_empleado'],
                $row['ID_viaje']
            );
        }
        
        $stmt = $this->db->executeQuery($sql);
      
        return $reservas;
    }

    // Obtener reservas paginadas
    public function getPaginated($page = 1, $limit = 10, $search = '') {
        try {
            $offset = ($page - 1) * $limit;
            
            // Construir la consulta base
            $sql = "SELECT ID_reserva, fecha, num_personas, estado, ID_cliente, ID_empleado, ID_viaje FROM reserva";
            $countSql = "SELECT COUNT(*) as total FROM reserva";
            $params = [];

            // Agregar búsqueda si existe
            if (!empty($search)) {
                $searchWhere = " WHERE ID_reserva LIKE :search OR estado LIKE :search";
                $sql .= $searchWhere;
                $countSql .= $searchWhere;
                $params[':search'] = "%$search%";
            }

            // Agregar paginación usando parámetros nombrados
            $sql .= " LIMIT :limit OFFSET :offset";

            // Obtener el total de registros
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
            $reservas = [];

            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $reservas[] = new Reserva(
                    $row['ID_reserva'],
                    $row['fecha'],
                    $row['num_personas'],
                    $row['estado'],
                    $row['ID_cliente'],
                    $row['ID_empleado'],
                    $row['ID_viaje']
                );
            }

            // Convertir los objetos Reserva a arrays para JSON
            $reservasArray = array_map(function($reserva) {
                return [
                    'ID_reserva' => $reserva->getID(),
                    'fecha' => $reserva->getFecha(),
                    'num_personas' => $reserva->getNum_Personas(),
                    'estado' => $reserva->getEstado(),
                    'ID_cliente' => $reserva->getCliente(),
                    'ID_empleado' => $reserva->getEmpleado(),
                    'ID_viaje' => $reserva->getViaje()
                ];
            }, $reservas);

            return [
                'data' => $reservasArray,
                'total' => $total,
                'totalPages' => ceil($total / $limit),
                'currentPage' => $page
            ];

        } catch (PDOException $e) {
            throw new Exception("Error en la consulta: " . $e->getMessage());
        }
    }

    // Obtener reserva por ID
    public function getByID($ID_reserva) {
        $sql = "SELECT * FROM reserva WHERE ID_reserva = ?";
        $stmt = $this->executeQuery($sql, [$ID_reserva]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        
        if ($row) {
            return new Reserva(
                $row['ID_reserva'],
                $row['fecha'],
                $row['num_personas'],
                $row['estado'],
                $row['ID_cliente'],
                $row['ID_empleado'],
                $row['ID_viaje']
            );
        }
        return null;
    }

    // Crear una nueva reserva
    public function crear(Reserva $reserva) {
        $sql = "INSERT INTO reserva (ID_reserva, fecha, num_personas, estado, ID_cliente, ID_empleado, ID_viaje) 
                VALUES (?, ?, ?, ?, ?, ?, ?)";
        
        return $this->executeQuery($sql, [
            $reserva->getID(),
            $reserva->getFecha(),
            $reserva->getNum_Personas(),
            $reserva->getEstado(),
            $reserva->getCliente(),
            $reserva->getEmpleado(),
            $reserva->getViaje()
        ]);
    }

    // Actualizar una reserva
    public function actualizar(Reserva $reserva) {
        $sql = "UPDATE reserva 
                SET fecha = ?, num_personas = ?, estado = ?, ID_cliente = ?, ID_empleado = ?, ID_viaje = ? 
                WHERE ID_reserva = ?";
        
        return $this->executeQuery($sql, [
            $reserva->getFecha(),
            $reserva->getNum_Personas(),
            $reserva->getEstado(),
            $reserva->getCliente(),
            $reserva->getEmpleado(),
            $reserva->getViaje(),
            $reserva->getID()
        ]);
    }

    // Eliminar una reserva
    public function eliminar($ID_reserva) {
        $sql = "DELETE FROM reserva WHERE ID_reserva = ?";
        return $this->executeQuery($sql, [$ID_reserva]);
    }

    // Obtener reservas por cliente
    public function getByCliente($ID_cliente) {
        $sql = "SELECT * FROM reserva WHERE ID_cliente = ?";
        $stmt = $this->executeQuery($sql, [$ID_cliente]);
        $reservas = [];
        
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $reservas[] = new Reserva(
                $row['ID_reserva'],
                $row['fecha'],
                $row['num_personas'],
                $row['estado'],
                $row['ID_cliente'],
                $row['ID_empleado'],
                $row['ID_viaje']
            );
        }
        
        return $reservas;
    }

    // Obtener reservas por viaje
    public function getByViaje($ID_viaje) {
        $sql = "SELECT * FROM reserva WHERE ID_viaje = ?";
        $stmt = $this->executeQuery($sql, [$ID_viaje]);
        $reservas = [];
        
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $reservas[] = new Reserva(
                $row['ID_reserva'],
                $row['fecha'],
                $row['num_personas'],
                $row['estado'],
                $row['ID_cliente'],
                $row['ID_empleado'],
                $row['ID_viaje']
            );
        }
        
        return $reservas;
    }
}
