<?php
class CiudadModel extends Model {

    protected $db;
    
    public function __construct() {
        $this->db = Database::getInstance();
    }

    // Obtener todas las ciudades
    public function getAll() {
        $sql = "SELECT c.ID_Ciudad, c.Nombre, c.Pais, 
                COUNT(DISTINCT g.ID_Guia) as cant_guias, 
                COUNT(DISTINCT h.ID_Hotel) as cant_hoteles 
                FROM Ciudad c 
                LEFT JOIN Guia_Turistico g ON g.ID_Ciudad = c.ID_Ciudad 
                LEFT JOIN Hotel h ON h.ID_Ciudad = c.ID_Ciudad 
                GROUP BY c.ID_Ciudad, c.Nombre, c.Pais";

        $rows = $this->db->getAll($sql);
        $ciudades = [];
        
        foreach($rows as $row) {
            $ciudad = new Ciudad(
                $row['ID_Ciudad'],
                $row['Nombre'],
                $row['Pais'],
                $row['cant_guias'],
                $row['cant_hoteles']
            );
            $ciudades[] = $ciudad;
        }
        
        return $ciudades;
    }

    // Obtener ciudad por ID
    public function getByID($ID_ciudad) {
        $row = $this->db->getOne("SELECT * FROM Ciudad WHERE ID_ciudad = ?", [$ID_ciudad]);
        return $row ? new Ciudad(
            $row['ID_ciudad'],
            $row['nombre'],
            $row['pais'],
            $row['cant_guias'],
            $row['cant_hoteles']
        ) : null;
    }

    // Crear nueva ciudad
    public function crear(Ciudad $ciudad) {
        try { 
            return $this->db->insert(
            "INSERT INTO Ciudad (nombre, pais) VALUES (?, ?)",
            [$ciudad->getNombre(), $ciudad->getPais()]
        );
  

        } catch (PDOException $e) {
            throw new Exception("Error al crear la ciudad: " . $e->getMessage());
        } 
    }

    // Actualizar ciudad
    public function actualizar(Ciudad $ciudad) {
        return $this->db->query(
            "UPDATE Ciudad SET nombre = ?, pais = ? WHERE ID_ciudad = ?",
            [$ciudad->getNombre(), $ciudad->getPais(), $ciudad->getID()]
        );
    }

    // Eliminar ciudad
    public function eliminar($ID_ciudad) {
        return $this->db->query("DELETE FROM Ciudad WHERE ID_ciudad = ?", [$ID_ciudad]);
    }

    // Obtener el ID de la ciudad por su nombre
    public function getCiudadIdPorNombre($nombreCiudad) {
        $sql = "SELECT ID_ciudad FROM Ciudad WHERE nombre = ?";
        $stmt = $this->db->executeQuery($sql, [$nombreCiudad]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return $row ? $row['ID_ciudad'] : null;
    }

}
