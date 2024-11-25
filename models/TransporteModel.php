<?php
class TransporteModel extends Model {

    // Obtener todos los transportes
    public function getAll() {
        $sql = "SELECT id_transporte, tipo, costo, empresa FROM transporte";
        $stmt = $this->db->executeQuery($sql);
        $transportes = [];
        
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $transportes[] = $this->mapRowToTransporte($row);
        }
        
        return $transportes;
    }

    // Obtener transporte por ID
    public function getByID($id_transporte) {
        $sql = "SELECT id_transporte, tipo, costo, empresa FROM transporte WHERE id_transporte = ?";
        $stmt = $this->db->executeQuery($sql, [$id_transporte]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        
        return $row ? $this->mapRowToTransporte($row) : null;
    }

    // Obtener transportes por tipo
    public function getByTipo($tipo) {
        $sql = "SELECT id_transporte, tipo, costo, empresa FROM transporte WHERE tipo = ?";
        $stmt = $this->db->executeQuery($sql, [$tipo]);
        $transportes = [];
        
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $transportes[] = $this->mapRowToTransporte($row);
        }
        
        return $transportes;
    }

    // Crear nuevo transporte
    public function crear(Transporte $transporte) {
        $sql = "INSERT INTO transporte (tipo, costo, empresa) VALUES (?, ?, ?)";
        try {
            return $this->db->executeQuery($sql, [
                $transporte->getTipo(),
                $transporte->getCosto(),
                $transporte->getEmpresa()
            ]);
        } catch (PDOException $e) {
            throw new Exception("Error al crear transporte: " . $e->getMessage());
        }
    }

    // Actualizar transporte
    public function actualizar(Transporte $transporte) {
        $sql = "UPDATE transporte SET tipo = ?, costo = ?, empresa = ? WHERE id_transporte = ?";
        try {
            return $this->db->executeQuery($sql, [
                $transporte->getTipo(),
                $transporte->getCosto(),
                $transporte->getEmpresa(),
                $transporte->getID()
            ]);
        } catch (PDOException $e) {
            throw new Exception("Error al actualizar transporte: " . $e->getMessage());
        }
    }

    // Eliminar transporte
    /*public function eliminar($id_transporte) {
        $sql = "DELETE FROM transporte WHERE id_transporte = ?";
        try {
            return $this->db->executeQuery($sql, [$id_transporte]);
        } catch (PDOException $e) {
            throw new Exception("Error al eliminar transporte: " . $e->getMessage());
        }
    }*/

    public function eliminar($id_transporte) {
        // Verificar si el transporte existe antes de eliminar
        if ($this->getByID($id_transporte)) {
            $sql = "DELETE FROM transporte WHERE id_transporte = ?";
            try {
                return $this->db->executeQuery($sql, [$id_transporte]);
            } catch (PDOException $e) {
                throw new Exception("Error al eliminar transporte: " . $e->getMessage());
            }
        } else {
            throw new Exception("Transporte no encontrado para eliminar.");
        }
    }
    

    // Obtener transportes por nombre de empresa
    public function buscarTransportes($nombreEmpresa) {
        $sql = "SELECT id_transporte, tipo, costo, empresa FROM transporte WHERE empresa LIKE ?";
        $stmt = $this->db->executeQuery($sql, ["%$nombreEmpresa%"]);
        $transportes = [];
        
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $transportes[] = $this->mapRowToTransporte($row);
        }
        
        return $transportes;
    }

    // Mapeo de filas a objetos Transporte
    private function mapRowToTransporte($row) {
        return new Transporte(
            $row['id_transporte'],
            $row['tipo'],
            $row['costo'],
            $row['empresa']
        );
    }
}
