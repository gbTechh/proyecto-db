<?php
class ServicioModel extends Model {

     // Obtener todos los servicios
    public function getAll() {
        $sql = "SELECT s.id_servicio, p.nombre AS 'proveedor', s.descripcion, s.costo, c.nombre AS 'ciudad' 
                FROM servicio s 
                INNER JOIN proveedor p ON p.id_proveedor = s.id_proveedor 
                INNER JOIN ciudad c ON c.id_ciudad = s.ciudad_int;";
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
    private function getCiudadIdPorNombre($nombre) {
        $sql = "SELECT id_ciudad FROM ciudad WHERE nombre = ?";
        $stmt = $this->db->executeQuery($sql, [$nombre]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return $row ? $row['id_ciudad'] : null; 
    }

    public function buscarServicios($nombreCiudad) {
        $idCiudad = $this->getCiudadIdPorNombre($nombreCiudad);
        $sql = "SELECT s.id_servicio, s.descripcion, s.costo, c.nombre as 'ciudad' FROM servicio s
        INNER JOIN ciudad c ON s.ciudad_int = c.id_ciudad
        WHERE c.id_ciudad = ?";
    
        $stmt = $this->db->executeQuery($sql, [$idCiudad]);
        $servicios = [];
        
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $servicios[] = new Servicio(
                id_servicio: $row['id_servicio'],
                descripcion: $row['descripcion'],
                costo: $row['costo'],
                ciudad: $row['ciudad'],
                proveedor: '',
            );
        }
        
        return $servicios;
    }

   
    // Obtener un servicio por ID
    public function getByID($id_servicio) {
        $sql = "SELECT * FROM servicio WHERE id_servicio = ?";
        $stmt = $this->db->executeQuery($sql, [$id_servicio]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        
        if ($row) {
            return new Servicio(
                $row['id_servicio'],
                $row['proveedor'],
                $row['descripcion'],
                $row['costo'],
                $row['ciudad']
            );
        }
        return null;
    }

    // Crear un nuevo servicio
    public function crear(Servicio $servicio) {
        $sql = "INSERT INTO servicio (id_proveedor, descripcion, costo, ciudad_int) 
                VALUES (?, ?, ?, ?)";
        
        return $this->db->executeQuery($sql, [
         
            $servicio->getProveedor(),
            $servicio->getDescripcion(),
            $servicio->getCosto(),
            $servicio->getCiudad()
        ]);
    }

    // Actualizar un servicio
    public function actualizar(Servicio $servicio) {
        $sql = "UPDATE servicio 
                SET proveedor = ?, descripcion = ?, costo = ?, ciudad = ? 
                WHERE id_servicio = ?";
        
        return $this->db->executeQuery($sql, [
            $servicio->getProveedor(),
            $servicio->getDescripcion(),
            $servicio->getCosto(),
            $servicio->getCiudad(),
            $servicio->getID()
        ]);
    }

    // Eliminar un servicio
    public function eliminar($id_servicio) {
        $sql = "DELETE FROM servicio WHERE id_servicio = ?";
        return $this->db->executeQuery($sql, [$id_servicio]);
    }
}
