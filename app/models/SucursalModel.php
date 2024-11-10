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

    

    
   
}