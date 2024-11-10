<?php
class CiudadModel extends Model {

    // Obtener todas las ciudades
    public function getAll() {
        $sql = "SELECT ID_ciudad, nombre, pais FROM ciudad";
        $stmt = $this->executeQuery($sql);
        $ciudades = [];
        
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $ciudades[] = new Ciudad(
                $row['ID_ciudad'],
                $row['nombre'],
                $row['pais']
            );
        }
        
        return $ciudades;
    }

    // Obtener ciudad por ID
    public function getByID($ID_ciudad) {
        $sql = "SELECT * FROM ciudad WHERE ID_ciudad = ?";
        $stmt = $this->executeQuery($sql, [$ID_ciudad]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        
        if ($row) {
            return new Ciudad(
                $row['ID_ciudad'],
                $row['nombre'],
                $row['pais']
            );
        }
        return null;
    }

    // Crear nueva ciudad
    public function crear(Ciudad $ciudad) {
        $sql = "INSERT INTO ciudad (ID_ciudad, nombre, pais) 
                VALUES (?, ?, ?)";
        
        return $this->executeQuery($sql, [
            $ciudad->getID(),
            $ciudad->getNombre(),
            $ciudad->getPais()
        ]);
    }

    // Actualizar ciudad
    public function actualizar(Ciudad $ciudad) {
        $sql = "UPDATE ciudad 
                SET nombre = ?, pais = ? 
                WHERE ID_ciudad = ?";
        
        return $this->executeQuery($sql, [
            $ciudad->getNombre(),
            $ciudad->getPais(),
            $ciudad->getID()
        ]);
    }

    // Eliminar ciudad
    public function eliminar($ID_ciudad) {
        $sql = "DELETE FROM ciudad WHERE ID_ciudad = ?";
        return $this->executeQuery($sql, [$ID_ciudad]);
    }
}
