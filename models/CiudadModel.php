<?php
class CiudadModel extends Model {

    protected $db;
    
    public function __construct() {
        $this->db = Database::getInstance();
    }

    // Obtener todas las ciudades
    public function getAll() {
        $sql = "SELECT c.id_ciudad, c.nombre, c.pais, 
                COUNT(DISTINCT g.id_guia) as cant_guias, 
                COUNT(DISTINCT h.id_hotel) as cant_hoteles 
                FROM ciudad c 
                LEFT JOIN guia_turistico g ON g.id_ciudad = c.id_ciudad 
                LEFT JOIN hotel h ON h.id_ciudad = c.id_ciudad 
                GROUP BY c.id_ciudad, c.nombre, c.pais";

        $rows = $this->db->getAll($sql);
        $ciudades = [];
        
        foreach($rows as $row) {
            $ciudad = new Ciudad(
                $row['id_ciudad'],
                $row['nombre'],
                $row['pais'],
                $row['cant_guias'],
                $row['cant_hoteles']
            );
            $ciudades[] = $ciudad;
        }
        
        return $ciudades;
    }

    // Obtener ciudad por ID
    public function getByID($id_ciudad) {
        $sql = "SELECT c.id_ciudad, c.nombre, c.pais, 
                COUNT(DISTINCT g.id_Guia) as cant_guias, 
                COUNT(DISTINCT h.id_Hotel) as cant_hoteles 
                FROM ciudad c 
                LEFT JOIN guia_turistico g ON g.id_ciudad = c.id_ciudad 
                LEFT JOIN hotel h ON h.id_ciudad = c.id_ciudad 
                WHERE c.id_ciudad = ?
                GROUP BY c.id_ciudad, c.nombre, c.pais";

        $stmt = $this->db->executeQuery($sql, [$id_ciudad]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        
        if ($row) {
            return new Ciudad(
                $row['id_ciudad'],
                $row['nombre'],
                $row['pais'],
                $row['cant_guias'],
                $row['cant_hoteles']
            );
        }
        return null;
    }

    // Crear nueva ciudad
    public function crear(Ciudad $ciudad) {
        try { 
            return $this->db->insert(
            "INSERT INTO ciudad (nombre, pais) VALUES (?, ?)",
            [$ciudad->getNombre(), $ciudad->getPais()]
        );
  

        } catch (PDOException $e) {
            throw new Exception("Error al crear la ciudad: " . $e->getMessage());
        } 
    }

    // Actualizar ciudad
    public function actualizar(Ciudad $ciudad) {
        return $this->db->query(
            "UPDATE ciudad SET nombre = ?, pais = ? WHERE id_ciudad = ?",
            [$ciudad->getNombre(), $ciudad->getPais(), $ciudad->getID()]
        );
    }

    // Eliminar ciudad
    public function eliminar($ID_ciudad) {
        return $this->db->query("DELETE FROM ciudad WHERE id_ciudad = ?", [$ID_ciudad]);
    }

    // Obtener el ID de la ciudad por su nombre
    public function getCiudadIdPorNombre($nombreCiudad) {
        $sql = "SELECT id_ciudad FROM ciudad WHERE nombre = ?";
        $stmt = $this->db->executeQuery($sql, [$nombreCiudad]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return $row ? $row['id_ciudad'] : null;
    }

}
