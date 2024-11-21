<?php
class SucursalModel extends Model {
    
    // Obtener todos los empleados
    public function getAll() {
      $sql = "SELECT id_sucursal, direccion, telefono, nombre FROM sucursal";
      $stmt = $this->db->executeQuery($sql);
      $sucursales = [];
      
      while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
          $sucursales[] = new Sucursal(
              $row['id_sucursal'],
              $row['direccion'],
              $row['telefono'],
              $row['nombre'],
             
          );
      }
      return $sucursales;
    }

    public function crear(Sucursal $sucursal) {          
        try { 
            return $this->db->insert(
            "INSERT INTO sucursal (direccion, telefono, nombre) 
                    VALUES (?, ?, ?)",
            [$sucursal->getDireccion(), $sucursal->getTelefono(),$sucursal->getNombre()]
        );
  

        } catch (PDOException $e) {
            throw new Exception("Error al crear la sucursal: " . $e->getMessage());
        } 
    }
    
    public function existeNombre($nombre, $excludeId = null) {
        $sql = "SELECT COUNT(*) FROM sucursal WHERE nombre = :nombre";
        $params = [':nombre' => $nombre];
        
        if ($excludeId !== null) {
            $sql .= " AND id_sucursal != :id";
            $params[':id'] = $excludeId;
        }
        
        $stmt = $this->db->executeQuery($sql, $params);
        return $stmt->fetchColumn() > 0;
    }
    
   
}