<?php
class GuiaTuristicoModel extends Model {

    // Obtener todos los guías turísticos
    public function getAll() {
        $sql = "SELECT g.id_guia, g.nombre, g.telefono, g.idioma, c.nombre AS 'ciudad' FROM guia_turistico g
                INNER JOIN ciudad c ON c.id_ciudad = g.id_ciudad";

        $stmt = $this->db->executeQuery($sql);
        $guias = [];
        
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $guias[] = new GuiaTuristico(
                $row['id_guia'],
                $row['nombre'],
                $row['telefono'],
                $row['idioma'],
                $row['ciudad']
            );
        }
        
        return $guias;
    }

    // Obtener guía por ID
    public function getByID($id_guia) {
        $sql = "SELECT * FROM guia_turistico WHERE id_guia = ?";
        $stmt = $this->db->executeQuery($sql, [$id_guia]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        
        if ($row) {
            return new GuiaTuristico(
                $row['id_guia'],
                $row['nombre'],
                $row['telefono'],
                $row['idioma'],
                $row['id_ciudad']
            );
        }
        return null;
    }
    // Crear nuevo guía turístico
    public function crear(GuiaTuristico $guia) {
        $sql = "INSERT INTO guia_turistico (id_guia, nombre, telefono, idioma, id_ciudad) 
                VALUES (?, ?, ?, ?, ?)";
        
        return $this->db->executeQuery($sql, [
            $guia->getID(),
            $guia->getNombre(),
            $guia->getTelefono(),
            $guia->getIdioma(),
            $guia->getCiudad()
        ]);
    }

    // Actualizar guía turístico
    public function actualizar(GuiaTuristico $guia) {
        $sql = "UPDATE guia_turistico 
                SET nombre = ?, telefono = ?, idioma = ?, id_ciudad = ? 
                WHERE id_guia = ?";
        
        return $this->db->executeQuery($sql, [
            $guia->getNombre(),
            $guia->getTelefono(),
            $guia->getIdioma(),
            $guia->getCiudad(),
            $guia->getID()
        ]);
    }

    // Eliminar guía turístico
    public function eliminar($id_guia) {
        $sql = "DELETE FROM guia_turistico WHERE id_guia = ?";
        return $this->db->executeQuery($sql, [$id_guia]);
    }

    // Buscar guías por ciudad
    public function getByCiudad($id_ciudad) {
        $sql = "SELECT * FROM guia_turistico WHERE id_ciudad = ?";
        $stmt = $this->db->executeQuery($sql, [$id_ciudad]);
        $guias = [];
        
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $guias[] = new GuiaTuristico(
                $row['id_guia'],
                $row['nombre'],
                $row['telefono'],
                $row['idioma'],
                $row['id_ciudad']
            );
        }
        
        return $guias;
    }

    private function getciudadIdPornombre($nombre) {
        $sql = "SELECT id_ciudad FROM ciudad WHERE nombre = ?";
        $stmt = $this->db->executeQuery($sql, [$nombre]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return $row ? $row['id_ciudad'] : null; 
    }

    public function buscarGuias($nombreciudad) {
        $idciudad = $this->getciudadIdPornombre($nombreciudad);
        $sql = "SELECT g.id_guia, g.nombre, g.telefono, g.idioma, c.nombre as 'ciudad' FROM guia_turistico g
        INNER JOIN ciudad c ON g.id_ciudad = c.id_ciudad
        WHERE c.id_ciudad = ?";
    
        $stmt = $this->db->executeQuery($sql, [$idciudad]);
        $guiasturisticos = [];
        
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $guiasturisticos[] = new GuiaTuristico(

                ID_guia: $row['id_guia'],
                nombre: $row['nombre'],
                telefono: $row['telefono'],
                idioma: $row['idioma'],
                ID_ciudad: $row['ciudad']
            );
        }
        
        return $guiasturisticos;
    }

    public function getPaginated($page = 1, $limit = 10, $search = '') { 
        try {
            $offset = ($page - 1) * $limit;
    
            // Consulta base
            $sql = "SELECT id_guia, nombre, telefono, idioma, id_ciudad FROM guia_turistico";
            $countSql = "SELECT COUNT(*) as total FROM guia_turistico";
            $params = [];
    
            // Si hay búsqueda, agregarla a las consultas
            if (!empty($search)) {
                $searchWhere = " WHERE nombre LIKE :search OR telefono LIKE :search OR idioma LIKE :search";
                $sql .= $searchWhere;
                $countSql .= $searchWhere;
                $params[':search'] = "%$search%";
            }
    
            // Agregar limit y offset para paginación
            $sql .= " LIMIT :limit OFFSET :offset";
    
            // Obtener total de guías turísticos
            $stmt = $this->db->prepare($countSql);
            if (!empty($search)) {
                $stmt->bindValue(':search', "%$search%", PDO::PARAM_STR);
            }
            $stmt->execute();
            $total = $stmt->fetch(PDO::FETCH_ASSOC)['total'];
    
            // Ejecutar la consulta principal para obtener los guías turísticos
            $stmt = $this->db->prepare($sql);
            if (!empty($search)) {
                $stmt->bindValue(':search', "%$search%", PDO::PARAM_STR);
            }
            $stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
            $stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
            $stmt->execute();
    
            $guias = [];
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $guias[] = new GuiaTuristico(
                    $row['id_guia'],
                    $row['nombre'],
                    $row['telefono'],
                    $row['idioma'],
                    $row['id_ciudad']
                );
            }
    
            // Convertir los objetos GuiaTuristico a arrays para JSON
            $guiasArray = array_map(function($guia) {
                return [
                    'id_guia' => $guia->getID(),
                    'nombre' => $guia->getNombre(),
                    'telefono' => $guia->getTelefono(),
                    'idioma' => $guia->getIdioma(),
                    'id_ciudad' => $guia->getCiudad()
                ];
            }, $guias);
    
            return [
                'data' => $guiasArray,
                'total' => $total,
                'totalPages' => ceil($total / $limit),
                'currentPage' => $page
            ];
    
        } catch (PDOException $e) {
            throw new Exception("Error en la consulta: " . $e->getMessage());
        }
    }
    
}
