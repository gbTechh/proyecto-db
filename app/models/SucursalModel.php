<?php
class SucursalModel extends Model {
    
    // Obtener todos los empleados
    public function getAll() {
      $sql = "SELECT ID_sucursal, Direccion as 'direccion', Telefono as 'telefono', nombre FROM sucursal";
      $stmt = $this->executeQuery($sql);
      $sucursales = [];
      
      while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
          $sucursales[] = new Sucursal(
              $row['ID_sucursal'],
              $row['direccion'],
              $row['telefono'],
              $row['nombre'],
             
          );
      }
      return $sucursales;
    }

    public function crear(Sucursal $sucursal) {
        try {
            $sql = "INSERT INTO sucursal (ID_sucursal, Telefono, nombre, Direccion) 
                    VALUES (:ID_sucursal, :telefono, :nombre, :direccion)";
            
            $params = [
                ':ID_sucursal' => $sucursal->getID(),
                ':nombre' => $sucursal->getNombre(),
                ':telefono' => $sucursal->getTelefono(),
                ':direccion' => $sucursal->getDireccion(),
            ];

            $stmt = $this->db->prepare($sql);
            $stmt->execute($params);
            
            return $this->db->lastInsertId();
        } catch (PDOException $e) {
            throw new Exception("Error al crear sucursal: " . $e->getMessage());
        }    
    }
    
    public function existeNombre($nombre, $excludeId = null) {
        $sql = "SELECT COUNT(*) FROM sucursal WHERE nombre = :nombre";
        $params = [':nombre' => $nombre];
        
        if ($excludeId !== null) {
            $sql .= " AND ID_sucursal != :id";
            $params[':id'] = $excludeId;
        }
        
        $stmt = $this->db->prepare($sql);
        $stmt->execute($params);
        
        return $stmt->fetchColumn() > 0;
    }
    
   
}