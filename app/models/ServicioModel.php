<?php
class ServicioModel extends Model {

    // Obtener todos los servicios
    public function getAll() {
        $sql = "SELECT ID_servicio, tipo_transporte, empresa, costo FROM servicio";
        $stmt = $this->executeQuery($sql);
        $servicios = [];
        
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $servicios[] = new Servicio(
                $row['ID_servicio'],
                $row['tipo_transporte'],
                $row['empresa'],
                $row['costo']
            );
        }
        
        return $servicios;
    }

    // Obtener servicios paginados
    public function getPaginated($page = 1, $limit = 10, $search = '') {
        try {
            $offset = ($page - 1) * $limit;
            
            // Consulta base
            $sql = "SELECT ID_servicio, tipo_transporte, empresa, costo FROM servicio";
            $countSql = "SELECT COUNT(*) as total FROM servicio";
            $params = [];

            // Si hay búsqueda, agregarla a las consultas
            if (!empty($search)) {
                $searchWhere = " WHERE tipo_transporte LIKE :search OR empresa LIKE :search";
                $sql .= $searchWhere;
                $countSql .= $searchWhere;
                $params[':search'] = "%$search%";
            }

            // Agregar limit y offset para paginación
            $sql .= " LIMIT :limit OFFSET :offset";

            // Obtener el total de servicios
            $stmt = $this->db->prepare($countSql);
            if (!empty($search)) {
                $stmt->bindValue(':search', "%$search%", PDO::PARAM_STR);
            }
            $stmt->execute();
            $total = $stmt->fetch(PDO::FETCH_ASSOC)['total'];

            // Ejecutar la consulta principal para obtener los servicios
            $stmt = $this->db->prepare($sql);
            if (!empty($search)) {
                $stmt->bindValue(':search', "%$search%", PDO::PARAM_STR);
            }
            $stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
            $stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
            $stmt->execute();

            $servicios = [];
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $servicios[] = new Servicio(
                    $row['ID_servicio'],
                    $row['tipo_transporte'],
                    $row['empresa'],
                    $row['costo']
                );
            }

            // Convertir los objetos Servicio a arrays para JSON
            $serviciosArray = array_map(function($servicio) {
                return [
                    'ID_servicio' => $servicio->getID(),
                    'tipo_transporte' => $servicio->getTipoTransporte(),
                    'empresa' => $servicio->getEmpresa(),
                    'costo' => $servicio->getCosto()
                ];
            }, $servicios);

            return [
                'data' => $serviciosArray,
                'total' => $total,
                'totalPages' => ceil($total / $limit),
                'currentPage' => $page
            ];

        } catch (PDOException $e) {
            throw new Exception("Error en la consulta: " . $e->getMessage());
        }
    }

    // Obtener un servicio por ID
    public function getByID($ID_servicio) {
        $sql = "SELECT * FROM servicio WHERE ID_servicio = ?";
        $stmt = $this->executeQuery($sql, [$ID_servicio]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        
        if ($row) {
            return new Servicio(
                $row['ID_servicio'],
                $row['tipo_transporte'],
                $row['empresa'],
                $row['costo']
            );
        }
        return null;
    }

    // Crear un nuevo servicio
    public function crear(Servicio $servicio) {
        $sql = "INSERT INTO servicio (ID_servicio, tipo_transporte, empresa, costo) 
                VALUES (?, ?, ?, ?)";
        
        return $this->executeQuery($sql, [
            $servicio->getID(),
            $servicio->getTipoTransporte(),
            $servicio->getEmpresa(),
            $servicio->getCosto()
        ]);
    }

    // Actualizar un servicio
    public function actualizar(Servicio $servicio) {
        $sql = "UPDATE servicio 
                SET tipo_transporte = ?, empresa = ?, costo = ? 
                WHERE ID_servicio = ?";
        
        return $this->executeQuery($sql, [
            $servicio->getTipoTransporte(),
            $servicio->getEmpresa(),
            $servicio->getCosto(),
            $servicio->getID()
        ]);
    }

    // Eliminar un servicio
    public function eliminar($ID_servicio) {
        $sql = "DELETE FROM servicio WHERE ID_servicio = ?";
        return $this->executeQuery($sql, [$ID_servicio]);
    }
}
