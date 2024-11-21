<?php
class ViajeModel extends Model {

    // Obtener todos los viajes
    public function getAll() {
        $sql = "SELECT id_viaje, nombre, descripcion, duracion, precio FROM viaje";
        $stmt = $this->db->executeQuery($sql);
        $viajes = [];
        
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $viajes[] = new Viaje(
                $row['id_viaje'],
                $row['nombre'],
                $row['descripcion'],
                $row['duracion'],
                $row['precio']
            );
        }
        
        return $viajes;
    }

    // Obtener viaje por ID
    public function getByID($ID_viaje) {
        $sql = "SELECT * FROM viaje WHERE id_viaje = ?";
        $stmt = $this->db->executeQuery($sql, [$ID_viaje]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        
        if ($row) {
            return new Viaje(
                $row['id_viaje'],
                $row['nombre'],
                $row['descripcion'],
                $row['duracion'],
                $row['precio']
            );
        }
        return null;
    }

    // Crear nuevo viaje
    public function crear(Viaje $viaje) {
        $sql = "INSERT INTO viaje (nombre, descripcion, duracion, precio) 
                VALUES (?, ?, ?, ?)";
        
        return $this->db->executeQuery($sql, [
            $viaje->getNombre(),
            $viaje->getDescripcion(),
            $viaje->getDuracion(),
            $viaje->getPrecio()
        ]);
    }

    // Actualizar viaje
    public function actualizar(Viaje $viaje) {
        $sql = "UPDATE viaje 
                SET nombre = ?, descripcion = ?, duracion = ?, precio = ? 
                WHERE id_viaje = ?";
        
        return $this->db->executeQuery($sql, [
            $viaje->getNombre(),
            $viaje->getDescripcion(),
            $viaje->getDuracion(),
            $viaje->getPrecio(),
            $viaje->getID()
        ]);
    }

    // Eliminar viaje
    public function eliminar($ID_viaje) {
        $sql = "DELETE FROM viaje WHERE id_viaje = ?";
        return $this->db->executeQuery($sql, [$ID_viaje]);
    }
}
