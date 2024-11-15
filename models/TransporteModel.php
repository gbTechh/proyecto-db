<?php
class TransporteModel extends Model {

    // Obtener todos los transportes
    public function getAll() {
        $sql = "SELECT ID_transporte, telefono, empresa FROM transporte";
        $stmt = $this->executeQuery($sql);
        $transportes = [];
        
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $transportes[] = new Transporte(
                $row['ID_transporte'],
                $row['telefono'],
                $row['empresa']
            );
        }
        
        return $transportes;
    }

    // Obtener transporte por ID
    public function getByID($ID_transporte) {
        $sql = "SELECT * FROM transporte WHERE ID_transporte = ?";
        $stmt = $this->executeQuery($sql, [$ID_transporte]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        
        if ($row) {
            return new Transporte(
                $row['ID_transporte'],
                $row['telefono'],
                $row['empresa']
            );
        }
        return null;
    }

    // Crear nuevo transporte
    public function crear(Transporte $transporte) {
        $sql = "INSERT INTO transporte (telefono, empresa) 
                VALUES (?, ?)";
        
        return $this->executeQuery($sql, [
            $transporte->getTelefono(),
            $transporte->getEmpresa()
        ]);
    }

    // Actualizar transporte
    public function actualizar(Transporte $transporte) {
        $sql = "UPDATE transporte 
                SET telefono = ?, empresa = ? 
                WHERE ID_transporte = ?";
        
        return $this->executeQuery($sql, [
            $transporte->getTelefono(),
            $transporte->getEmpresa(),
            $transporte->getID()
        ]);
    }

    // Eliminar transporte
    public function eliminar($ID_transporte) {
        $sql = "DELETE FROM transporte WHERE ID_transporte = ?";
        return $this->executeQuery($sql, [$ID_transporte]);
    }
}
