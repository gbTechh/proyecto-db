<?php
class GuiaTuristicoModel extends Model {

    // Obtener todos los guías turísticos
    public function getAll() {
        $sql = "SELECT ID_guia, nombre, telefono, idioma, ID_ciudad FROM guia_turistico";
        $stmt = $this->executeQuery($sql);
        $guias = [];
        
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $guias[] = new GuiaTuristico(
                $row['ID_guia'],
                $row['nombre'],
                $row['telefono'],
                $row['idioma'],
                $row['ID_ciudad']
            );
        }
        
        return $guias;
    }

    // Obtener guía por ID
    public function getByID($ID_guia) {
        $sql = "SELECT * FROM guia_turistico WHERE ID_guia = ?";
        $stmt = $this->executeQuery($sql, [$ID_guia]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        
        if ($row) {
            return new GuiaTuristico(
                $row['ID_guia'],
                $row['nombre'],
                $row['telefono'],
                $row['idioma'],
                $row['ID_ciudad']
            );
        }
        return null;
    }

    // Crear nuevo guía turístico
    public function crear(GuiaTuristico $guia) {
        $sql = "INSERT INTO guia_turistico (ID_guia, nombre, telefono, idioma, ID_ciudad) 
                VALUES (?, ?, ?, ?, ?)";
        
        return $this->executeQuery($sql, [
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
                SET nombre = ?, telefono = ?, idioma = ?, ID_ciudad = ? 
                WHERE ID_guia = ?";
        
        return $this->executeQuery($sql, [
            $guia->getNombre(),
            $guia->getTelefono(),
            $guia->getIdioma(),
            $guia->getCiudad(),
            $guia->getID()
        ]);
    }

    // Eliminar guía turístico
    public function eliminar($ID_guia) {
        $sql = "DELETE FROM guia_turistico WHERE ID_guia = ?";
        return $this->executeQuery($sql, [$ID_guia]);
    }

    // Buscar guías por ciudad
    public function getByCiudad($ID_ciudad) {
        $sql = "SELECT * FROM guia_turistico WHERE ID_ciudad = ?";
        $stmt = $this->executeQuery($sql, [$ID_ciudad]);
        $guias = [];
        
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $guias[] = new GuiaTuristico(
                $row['ID_guia'],
                $row['nombre'],
                $row['telefono'],
                $row['idioma'],
                $row['ID_ciudad']
            );
        }
        
        return $guias;
    }
}
