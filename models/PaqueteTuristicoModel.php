<?php
class PaqueteTuristicoModel extends Model {

    // Obtener todos los paquetes turísticos
    public function getAll() {
        $sql = "SELECT p.id_paquete, p.nombre, p.descripcion, p.precio, c.nombre AS 'ciudad' FROM paquete_turistico p INNER JOIN ciudad c ON c.id_ciudad = p.id_ciudad";
        $stmt = $this->db->executeQuery($sql);
        $paquetes = [];
        
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $paquetes[] = new PaqueteTuristico(
                $row['id_paquete'],
                $row['nombre'],
                $row['descripcion'],
                $row['precio'],
                $row['ciudad']
            );
        }
        
        return $paquetes;
    }

    // Obtener paquete turístico por ID
    public function getByID($ID_paquete) {
        $sql = "SELECT * FROM paquete_turistico WHERE id_paquete = ?";
        $stmt = $this->db->executeQuery($sql, [$ID_paquete]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        
        if ($row) {
            return new PaqueteTuristico(
                $row['id_paquete'],
                $row['nombre'],
                $row['descripcion'],
                $row['precio'],
                $row['ciudad']
            );
        }
        return null;
    }

    // Crear nuevo paquete turístico
    public function crear(PaqueteTuristico $paquete) {
        $sql = "INSERT INTO paquete_turistico (nombre, descripcion, precio, id_ciudad) 
                VALUES (?, ?, ?, ?)";
        
        return $this->db->executeQuery($sql, [
            $paquete->getNombre(),
            $paquete->getDescripcion(),
            $paquete->getPrecio(),
            $paquete->getCiudad()
        ]);
    }

    // Actualizar paquete turístico
    public function actualizar(PaqueteTuristico $paquete) {
        $sql = "UPDATE paquete_turistico 
                SET nombre = ?, descripcion = ?, precio = ? 
                WHERE id_paquete = ?";
        
        return $this->db->executeQuery($sql, [
            $paquete->getNombre(),
            $paquete->getDescripcion(),
            $paquete->getPrecio(),
            $paquete->getID(),
            $paquete->getCiudad()
        ]);
    }

    // Eliminar paquete turístico
    public function eliminar($ID_paquete) {
        $sql = "DELETE FROM paquete_turistico WHERE id_paquete = ?";
        return $this->db->executeQuery($sql, [$ID_paquete]);
    }

    private function getCiudadIdPorNombre($nombre) {
        $sql = "SELECT id_ciudad FROM ciudad WHERE nombre = ?";
        $stmt = $this->db->executeQuery($sql, [$nombre]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return $row ? $row['ciudad'] : null; 
    }

    // Obtener paquetes turísticos por ciudad
    public function buscarPaquetes($nombreCiudad) {

        $idCiudad = $this->getCiudadIdPorNombre($nombreCiudad);

        $sql = "SELECT 
            p.id_paquete,
            p.nombre,
            p.descripcion,
            p.precio,
            c.id_ciudad,
            c.nombre as nombre_ciudad
        FROM paquete_turistico p
        INNER JOIN ciudad c ON p.id_ciudad = c.id_ciudad
        WHERE c.id_ciudad = ?";
    
        $stmt = $this->db->executeQuery($sql, [$idCiudad]);
        $paquetes = [];
    
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            // Crear un array con los datos del paquete para el formato JSON
            $paquetes[] = [
                'id' => $row['id_paquete'],
                'nombre' => $row['nombre'],
                'descripcion' => $row['descripcion'],
                'precio' => $row['precio'],
                'ciudad' => $row['nombre_ciudad']
            ];
        }

        return ['paquetes' => $paquetes];
    }
    // Obtener paquetes turísticos paginados
    public function getPaginated($page = 1, $limit = 10, $search = '') {
        try {
            $offset = ($page - 1) * $limit;

            // Consulta base
            $sql = "SELECT 
                        p.id_paquete, 
                        p.nombre, 
                        p.descripcion, 
                        p.precio, 
                        c.nombre AS 'ciudad' 
                    FROM paquete_turistico p 
                    INNER JOIN ciudad c ON c.id_ciudad = p.id_ciudad";
            $countSql = "SELECT COUNT(*) as total FROM paquete_turistico p INNER JOIN ciudad c ON c.id_ciudad = p.id_ciudad";
            $params = [];

            // Si hay búsqueda, agregar filtros
            if (!empty($search)) {
                $searchWhere = " WHERE p.nombre LIKE :search OR p.descripcion LIKE :search OR c.nombre LIKE :search";
                $sql .= $searchWhere;
                $countSql .= $searchWhere;
                $params[':search'] = "%$search%";
            }

            // Agregar limit y offset para paginación
            $sql .= " LIMIT :limit OFFSET :offset";

            // Obtener total de paquetes turísticos
            $stmt = $this->db->executeQuery($countSql);
            if (!empty($search)) {
                $stmt->bindValue(':search', "%$search%", PDO::PARAM_STR);
            }
            $stmt->execute();
            $total = $stmt->fetch(PDO::FETCH_ASSOC)['total'];

            // Ejecutar consulta principal
            $stmt = $this->db->executeQuery($sql);
            if (!empty($search)) {
                $stmt->bindValue(':search', "%$search%", PDO::PARAM_STR);
            }
            $stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
            $stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
            $stmt->execute();

            $paquetes = [];
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                // Formatear cada paquete para JSON
                $paquetes[] = [
                    'id_paquete' => $row['id_paquete'],
                    'nombre' => $row['nombre'],
                    'descripcion' => $row['descripcion'],
                    'precio' => $row['precio'],
                    'ciudad' => $row['ciudad']
                ];
            }

            return [
                'data' => $paquetes,
                'total' => $total,
                'totalPages' => ceil($total / $limit),
                'currentPage' => $page
            ];

        } catch (PDOException $e) {
            throw new Exception("Error en la consulta: " . $e->getMessage());
        }
    }

}
