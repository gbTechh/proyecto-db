<?php
class ReservaModel extends Model {

    // Obtener todas las reservas confirmadas
    public function getAllConfirmadas($id_sucursal = null) {
        $sql = "SELECT r.id_reserva, r.fecha, r.estado, r.id_viaje, r.id_sucursal, r.dni_empleado, c.dni as 'dni_cliente', CONCAT(c.nombre, ' ', c.apellidos) as 'nombre_cliente' FROM reserva r
        INNER JOIN viaje v ON r.id_viaje = v.id_viaje
        INNER JOIN cliente c ON c.dni = v.dni_cliente
        WHERE r.id_sucursal = ? and estado = 'Confirmado'; ";

       
        $stmt = $this->db->executeQuery($sql, [$id_sucursal]);
        $reservas = [];

        //WHERE dni_empleado is null or dni_empleado = ?
        
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $reservas[] = new Reserva(
                $row['id_reserva'],
                $row['fecha'],
                $row['estado'],
                $row['id_viaje'],
                $row['id_sucursal'],
                $row['dni_empleado'],
                $row['dni_cliente'],
                $row['nombre_cliente'],
            );
        }
        
      
        return $reservas;
    }
    public function getAllPendientes() {
       $sql = "SELECT r.id_reserva, r.fecha, r.estado, r.id_viaje, r.id_sucursal, r.dni_empleado, c.dni as 'dni_cliente', CONCAT(c.nombre, ' ', c.apellidos) as 'nombre_cliente' FROM reserva r
        INNER JOIN viaje v ON r.id_viaje = v.id_viaje
        INNER JOIN cliente c ON c.dni = v.dni_cliente
        WHERE estado = 'Pendiente';";
        $stmt = $this->db->executeQuery($sql);
        $reservas = [];

        //WHERE dni_empleado is null or dni_empleado = ?
        
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $reservas[] = new Reserva(
                $row['id_reserva'],
                $row['fecha'],
                $row['estado'],
                $row['id_viaje'],
                $row['id_sucursal'],
                $row['dni_empleado'],
                $row['dni_cliente'],
                $row['nombre_cliente'],
            );
        }
        
      
        return $reservas;
    }
    public function buscarReserva($str) {
        try {
            $sql = "SELECT r.id_reserva, r.fecha, r.estado, r.id_viaje, 
                        r.id_sucursal, r.dni_empleado, 
                        c.dni as 'dni_cliente', 
                        CONCAT(c.nombre, ' ', c.apellidos) as 'nombre_cliente' 
                    FROM reserva r
                    INNER JOIN viaje v ON r.id_viaje = v.id_viaje
                    INNER JOIN cliente c ON c.dni = v.dni_cliente
                    WHERE c.dni LIKE ? 
                    OR r.estado LIKE ?
                    OR c.nombre LIKE ?
                    OR c.apellidos LIKE ?";

            $searchTerm = "%{$str}%";
            // El mismo término para cada condición
            $params = [$searchTerm, $searchTerm, $searchTerm, $searchTerm];

            $stmt = $this->db->executeQuery($sql, $params);
            $reservas = [];

            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $reservas[] = new Reserva(
                    $row['id_reserva'],
                    $row['fecha'],
                    $row['estado'],
                    $row['id_viaje'],
                    $row['id_sucursal'],
                    $row['dni_empleado'],
                    $row['dni_cliente'],
                    $row['nombre_cliente']
                );
            }

            return [
                'success' => true,
                'data' => $reservas,
                'count' => count($reservas)
            ];

        } catch (Exception $e) {
            return [
                'success' => false,
                'error' => $e->getMessage()
            ];
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
    public function confirmarReserva($id, $sucursal, $dni_empleado) {
        try {
            // Primero verifica que la reserva existe
            $sqlCheck = "SELECT id_reserva FROM reserva WHERE id_reserva = ?";
            $stmtCheck = $this->db->executeQuery($sqlCheck, [$id]);
            
            if ($stmtCheck->rowCount() === 0) {
                throw new Exception("La reserva con ID {$id} no existe");
            }

            // Realiza la actualización
            $sql = "UPDATE reserva SET estado = 'Confirmado', id_sucursal = ?, dni_empleado = ?  WHERE id_reserva = ?";
            $stmt = $this->db->executeQuery($sql, [$sucursal, $dni_empleado, $id]);
            
            // Verifica si se actualizó alguna fila
            if ($stmt->rowCount() > 0) {
                return [
                    'success' => true,
                    'message' => "Reserva confirmada exitosamente",
                    'rows_affected' => $stmt->rowCount()
                ];
            } else {
                throw new Exception("No se pudo actualizar la reserva");
            }
            
        } catch (PDOException $e) {
            throw new Exception("Error al confirmar la reserva: " . $e->getMessage());
        }
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
