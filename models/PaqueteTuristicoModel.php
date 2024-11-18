<?php
class PaqueteTuristicoModel extends Model {

    // Obtener todos los paquetes turísticos
    public function getAll() {
        $sql = "SELECT ID_paquete, nombre, descripcion, precio FROM paquete_turistico";
        $stmt = $this->executeQuery($sql);
        $paquetes = [];
        
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $paquetes[] = new PaqueteTuristico(
                $row['ID_paquete'],
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
        $sql = "SELECT * FROM paquete_turistico WHERE ID_paquete = ?";
        $stmt = $this->executeQuery($sql, [$ID_paquete]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        
        if ($row) {
            return new PaqueteTuristico(
                $row['ID_paquete'],
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
        $sql = "INSERT INTO paquete_turistico (nombre, descripcion, precio) 
                VALUES (?, ?, ?)";
        
        return $this->executeQuery($sql, [
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
                WHERE ID_paquete = ?";
        
        return $this->executeQuery($sql, [
            $paquete->getNombre(),
            $paquete->getDescripcion(),
            $paquete->getPrecio(),
            $paquete->getID(),
            $paquete->getCiudad()
        ]);
    }

    // Eliminar paquete turístico
    public function eliminar($ID_paquete) {
        $sql = "DELETE FROM paquete_turistico WHERE ID_paquete = ?";
        return $this->executeQuery($sql, [$ID_paquete]);
    }

    private function getCiudadIdPorNombre($nombre) {
        $sql = "SELECT ID_ciudad FROM Ciudad WHERE nombre = ?";
        $stmt = $this->db->executeQuery($sql, [$nombre]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return $row ? $row['ID_ciudad'] : null; 
    }

    // Obtener paquetes turísticos por ciudad
    public function buscarPaquetes($nombreCiudad) {

        $idCiudad = $this->getCiudadIdPorNombre($nombreCiudad);

        $sql = "SELECT 
            p.ID_paquete,
            p.nombre,
            p.descripcion,
            p.precio,
            c.ID_ciudad,
            c.nombre as nombre_ciudad
        FROM paquete_turistico p
        INNER JOIN Ciudad c ON p.ID_ciudad = c.ID_ciudad
        WHERE c.ID_ciudad = ?";
    
        $stmt = $this->db->executeQuery($sql, [$idCiudad]);
        $paquetes = [];
    
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            // Crear un array con los datos del paquete para el formato JSON
            $paquetes[] = [
                'id' => $row['ID_paquete'],
                'nombre' => $row['nombre'],
                'descripcion' => $row['descripcion'],
                'precio' => $row['precio'],
                'ciudad' => $row['nombre_ciudad']
            ];
        }

        return ['paquetes' => $paquetes];
    }
}
