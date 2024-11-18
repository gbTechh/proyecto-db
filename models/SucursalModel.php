<?php
class SucursalModel extends Model {
    
    // Obtener todos los empleados
    public function getAll() {
      $sql = "SELECT ID_sucursal, Direccion as 'direccion', Telefono as 'telefono', nombre FROM Sucursal";
      $stmt = $this->db->executeQuery($sql);
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
            return $this->db->insert(
            "INSERT INTO Sucursal (Direccion, Telefono, nombre) 
                    VALUES (?, ?, ?)",
            [$sucursal->getDireccion(), $sucursal->getTelefono(),$sucursal->getNombre()]
        );
  

        } catch (PDOException $e) {
            throw new Exception("Error al crear la sucursal: " . $e->getMessage());
        } 
    }
    
    public function existeNombre($nombre, $excludeId = null) {
        $sql = "SELECT COUNT(*) FROM Sucursal WHERE nombre = :nombre";
        $params = [':nombre' => $nombre];
        
        if ($excludeId !== null) {
            $sql .= " AND ID_Sucursal != :id";
            $params[':id'] = $excludeId;
        }
        
        $stmt = $this->db->executeQuery($sql, $params);
        return $stmt->fetchColumn() > 0;
    }
    
   
}