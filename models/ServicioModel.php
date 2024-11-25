<?php
class ServicioModel extends Model {

    // Obtener todos los servicios
    public function getAll() {
        $sql = "SELECT s.id_servicio, p.nombre AS 'proveedor', s.descripcion, s.costo, c.nombre AS 'ciudad' 
                FROM servicio s 
                INNER JOIN proveedor p ON p.id_proveedor = s.id_proveedor 
                INNER JOIN ciudad c ON c.id_ciudad = s.id_ciudad";
        
        $stmt = $this->db->executeQuery($sql);
        $servicios = [];
        
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $servicios[] = new Servicio(
                $row['id_servicio'],
                $row['proveedor'],
                $row['descripcion'],
                $row['costo'],
                $row['ciudad']
            );
        }
        
        return $servicios;
    }

    // Obtener servicio por ID
    public function getByID($id_servicio) {
        $sql = "SELECT * FROM servicio WHERE id_servicio = ?";
        $stmt = $this->db->executeQuery($sql, [$id_servicio]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        
        if ($row) {
            return new Servicio(
                $row['id_servicio'],
                $row['id_proveedor'],
                $row['descripcion'],
                $row['costo'],
                $row['id_ciudad']
            );
        }
        return null;
    }
    
    public function crear(Servicio $servicio) {
    
        $sql = "INSERT INTO servicio (id_servicio, id_proveedor, descripcion, costo, id_ciudad) 
                VALUES (?, ?, ?, ?, ?)";
        return $this->db->executeQuery($sql, [
            $servicio->getID(),
            $servicio->getProveedor(),
            $servicio->getDescripcion(),
            $servicio->getCosto(),
            $servicio->getCiudad()
        ]);
    }
    

    // Actualizar servicio
    public function actualizar(Servicio $servicio) {
        // Actualización del servicio
        $sql = "UPDATE servicio 
                SET id_proveedor = ?, descripcion = ?, costo = ?, id_ciudad = ? 
                WHERE id_servicio = ?";
        
        return $this->db->executeQuery($sql, [
            $servicio->getProveedor(),
            $servicio->getDescripcion(),
            $servicio->getCosto(),
            $servicio->getCiudad(),
            $servicio->getID()
        ]);
    }

    // Eliminar servicio
    public function eliminar($id_servicio) {
        $sql = "DELETE FROM servicio WHERE id_servicio = ?";
        return $this->db->executeQuery($sql, [$id_servicio]);
    }

    // Buscar servicios por ciudad
    public function getByCiudad($id_ciudad) {
        $sql = "SELECT * FROM servicio WHERE id_ciudad = ?";
        $stmt = $this->db->executeQuery($sql, [$id_ciudad]);
        $servicios = [];
        
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $servicios[] = new Servicio(
                $row['id_servicio'],
                $row['id_proveedor'],
                $row['descripcion'],
                $row['costo'],
                $row['id_ciudad']
            );
        }
        
        return $servicios;
    }

    // Buscar servicios por proveedor
    public function getByProveedor($id_proveedor) {
        $sql = "SELECT * FROM servicio WHERE id_proveedor = ?";
        $stmt = $this->db->executeQuery($sql, [$id_proveedor]);
        $servicios = [];
        
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $servicios[] = new Servicio(
                $row['id_servicio'],
                $row['id_proveedor'],
                $row['descripcion'],
                $row['costo'],
                $row['id_ciudad']
            );
        }
        
        return $servicios;
    }

    // Obtener el ID de la ciudad por nombre
    private function getCiudadIdPorNombre($nombre) {
        $sql = "SELECT id_ciudad FROM ciudad WHERE nombre = ?";
        $stmt = $this->db->executeQuery($sql, [$nombre]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return $row ? $row['id_ciudad'] : null;
    }

    // Obtener el ID del proveedor por nombre
    private function getProveedorIdPorNombre($nombre) {
        $sql = "SELECT id_proveedor FROM proveedor WHERE nombre = ?";
        $stmt = $this->db->executeQuery($sql, [$nombre]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return $row ? $row['id_proveedor'] : null;
    }

    // Obtener servicios paginados
    public function getPaginated($page = 1, $limit = 10, $search = '') {
        $offset = ($page - 1) * $limit;
        $sql = "SELECT s.id_servicio, p.nombre AS 'proveedor', s.descripcion, s.costo, c.nombre AS 'ciudad' 
                FROM servicio s 
                INNER JOIN proveedor p ON p.id_proveedor = s.id_proveedor 
                INNER JOIN ciudad c ON c.id_ciudad = s.id_ciudad";
        
        $params = [];
        if (!empty($search)) {
            $sql .= " WHERE s.descripcion LIKE :search OR p.nombre LIKE :search";
            $params[':search'] = "%$search%";
        }

        $sql .= " LIMIT :limit OFFSET :offset";
        $stmt = $this->db->executeQuery($sql);
        $stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
        $stmt->bindValue(':offset', $offset, PDO::PARAM_INT);

        foreach ($params as $key => $value) {
            $stmt->bindValue($key, $value);
        }

        $stmt->execute();
        $servicios = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $servicios;
    }
}
?>
