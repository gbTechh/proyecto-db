<?php
class PaqueteTuristicoModel extends Model {

    // Obtener todos los paquetes turísticos
    public function getAll() {
        $sql = "SELECT id_paquete, nombre, descripcion, precio, id_ciudad, imagen FROM paquete_turistico";
        $stmt = $this->db->executeQuery($sql);
        $paquetes = [];
        
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $paquetes[] = new PaqueteTuristico(
                $row['id_paquete'],
                $row['nombre'],
                $row['descripcion'],
                $row['precio'],
                $row['id_ciudad'],
                $row['imagen']
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
                $row['id_ciudad'],
                $row['imagen']
            );
        }
        return null;
    }

    // Crear nuevo paquete turístico
    public function crear(PaqueteTuristico $paquete) {
        $sql = "INSERT INTO paquete_turistico (nombre, descripcion, precio, id_ciudad, imagen) 
                VALUES (?, ?, ?, ?, ?)";
        
        return $this->db->executeQuery($sql, [
            $paquete->getNombre(),
            $paquete->getDescripcion(),
            $paquete->getPrecio(),
            $paquete->getCiudad(),
            $paquete->getImagen()
        ]);
    }

    // Actualizar paquete turístico
    public function actualizar(PaqueteTuristico $paquete) {
        $sql = "UPDATE paquete_turistico 
                SET nombre = ?, descripcion = ?, precio = ?, imagen = ? 
                WHERE id_paquete = ?";
        
        return $this->db->executeQuery($sql, [
            $paquete->getNombre(),
            $paquete->getDescripcion(),
            $paquete->getPrecio(),
            $paquete->getImagen(),
            $paquete->getID()
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
        return $row ? $row['id_ciudad'] : null; 
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
            c.nombre as nombre_ciudad,
            p.imagen
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
                'ciudad' => $row['nombre_ciudad'],
                'imagen' => $row['imagen'] 
            ];
        }

        return ['paquetes' => $paquetes];
    }
}
