<?php
class TransporteModel extends Model {

    // Obtener todos los transportes
    public function getAll() {
         $sql = "SELECT id_transporte, tipo, costo, empresa FROM transporte";
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

    // Obtener transporte por ID
    public function getByID($id_transporte) {
        $sql = "SELECT * FROM transporte WHERE id_transporte = ?";
        $stmt = $this->db->executeQuery($sql, [$id_transporte]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        
        if ($row) {
            return new Transporte(
                $row['id_transporte'],
                $row['tipo'],
                $row['costo'],
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

    public function getByTipo($tipo) {
        $sql = "SELECT * FROM transporte WHERE tipo = ?";
        $stmt = $this->db->executeQuery($sql, [$tipo]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        
        if ($row) {
            return new Transporte(
                $row['id_transporte'],
                $row['tipo'],
                $row['costo'],
                $row['empresa']
            );
        }
        return null;
    }

    public function getByCosto($costo) {
        $sql = "SELECT * FROM transporte WHERE costo = ?";
        $stmt = $this->db->executeQuery($sql, [$costo]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        
        if ($row) {
            return new Transporte(
                $row['id_transporte'],
                $row['tipo'],
                $row['costo'],
                $row['empresa']
            );
        }
        return null;
    }

    // Obtener transporte por Empresa
    public function getByEmpresa($empresa) {
        $sql = "SELECT * FROM transporte WHERE empresa = ?";
        $stmt = $this->db->executeQuery($sql, [$empresa]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        
        if ($row) {
            return new Transporte(
                $row['id_transporte'],
                $row['tipo'],
                $row['costo'],
                $row['empresa']
            );
        }
        return null;
    }

    // Crear nuevo transporte
    public function crear(Transporte $transporte) {
        $sql = "INSERT INTO transporte (tipo, costo, empresa) 
                VALUES (?, ?, ?)";
        
        return $this->db->executeQuery($sql, [
            $transporte->getTipo(),
            $transporte->getCosto(),
            $transporte->getEmpresa()
        ]);
    }

    // Actualizar transporte
    public function actualizar(Transporte $transporte) {
        $sql = "UPDATE transporte 
                SET tipo = ?, costo = ?, empresa = ? 
                WHERE id_transporte = ?";
        
        return $this->db->executeQuery($sql, [
            $transporte->getTipo(),
            $transporte->getCosto(),
            $transporte->getEmpresa(),
            $transporte->getID()
        ]);
    }

    // Eliminar transporte
    public function eliminar($id_transporte) {
        $sql = "DELETE FROM transporte WHERE id_transporte = ?";
        return $this->db->executeQuery($sql, [$id_transporte]);
    }
}
