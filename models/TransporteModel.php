<?php
class TransporteModel extends Model {

    // Obtener todos los transportes
    public function getAll() {
        $sql = "SELECT id_transporte, telefono, empresa FROM transporte";
        $stmt = $this->db->executeQuery($sql);
        $transportes = [];
        
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $transportes[] = new Transporte(
                $row['id_transporte'],
                $row['telefono'],
                $row['empresa']
            );
        }
        
        return $transportes;
    }

    // Obtener transporte por ID
    public function getByID($ID_transporte) {
        $sql = "SELECT * FROM transporte WHERE id_transporte = ?";
        $stmt = $this->db->executeQuery($sql, [$ID_transporte]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        
        if ($row) {
            return new Transporte(
                $row['id_transporte'],
                $row['telefono'],
                $row['empresa']
            );
        }
        return null;
    }

    public function get4() {
        $sql = "SELECT id_transporte, tipo, costo, empresa FROM transporte ORDER BY RAND() LIMIT 4";
        $stmt = $this->db->executeQuery($sql);
        $transportes = [];
        
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $transportes[] = new Transporte(
                $row['id_transporte'],
                $row['tipo'],
                $row['costo'],
                $row['empresa']
            );
        }
        
        return $transportes;
    }

    // Crear nuevo transporte
    public function crear(Transporte $transporte) {
        $sql = "INSERT INTO transporte (telefono, empresa) 
                VALUES (?, ?)";
        
        return $this->db->executeQuery($sql, [
            $transporte->getTelefono(),
            $transporte->getEmpresa()
        ]);
    }

    // Actualizar transporte
    public function actualizar(Transporte $transporte) {
        $sql = "UPDATE transporte 
                SET telefono = ?, empresa = ? 
                WHERE ID_transporte = ?";
        
        return $this->db->executeQuery($sql, [
            $transporte->getTelefono(),
            $transporte->getEmpresa(),
            $transporte->getID()
        ]);
    }

    // Eliminar transporte
    public function eliminar($ID_transporte) {
        $sql = "DELETE FROM transporte WHERE ID_transporte = ?";
        return $this->db->executeQuery($sql, [$ID_transporte]);
    }
}
