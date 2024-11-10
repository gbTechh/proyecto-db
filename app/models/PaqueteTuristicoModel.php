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
                $row['precio']
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
                $row['precio']
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
            $paquete->getPrecio()
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
            $paquete->getID()
        ]);
    }

    // Eliminar paquete turístico
    public function eliminar($ID_paquete) {
        $sql = "DELETE FROM paquete_turistico WHERE ID_paquete = ?";
        return $this->executeQuery($sql, [$ID_paquete]);
    }
}
