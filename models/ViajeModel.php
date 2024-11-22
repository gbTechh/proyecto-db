<?php
class ViajeModel extends Model {

    // Obtener todos los viajes
    public function getAll() {
        $sql = "SELECT v.id_viaje, v.duracion, v.precio, v.dni_cliente, c.nombre as 'ciudad_origen', c2.nombre as 'ciudad_destino', 
t.tipo as 'tipo_transporte',
s.descripcion as 'servicio',
h.nombre as 'hotel',
pt.nombre as 'paquete',
g.nombre as 'guia'
FROM viaje v
LEFT JOIN vuelo vu ON vu.id_vuelo = v.vuelo_ida
LEFT JOIN vuelo vu2 ON vu2.id_vuelo = v.vuelo_regreso
LEFT JOIN ciudad c ON vu.ciudad_origen = c.id_ciudad
LEFT JOIN ciudad c2 ON vu2.ciudad_origen = c2.id_ciudad
LEFT JOIN transporte t ON t.id_transporte = v.transporte
LEFT JOIN servicio s ON s.id_servicio = v.servicio
LEFT JOIN hotel h ON h.id_hotel = v.hotel
LEFT JOIN paquete_turistico pt ON pt.id_paquete = v.paquete_turistico
LEFT JOIN guia_turistico g ON g.id_guia = v.guia;";
        $stmt = $this->db->executeQuery($sql);
        $viajes = [];
        
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $viajes[] = new Viaje(
                $row['id_viaje'],
                $row['nombre'],
                $row['descripcion'],
                $row['duracion'],
                $row['precio']
            );
        }
        
        return $viajes;
    }

    // Obtener viaje por ID
    public function getByID($ID_viaje) {
        $sql = "SELECT * FROM viaje WHERE id_viaje = ?";
        $stmt = $this->db->executeQuery($sql, [$ID_viaje]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        
        if ($row) {
            return new Viaje(
                $row['id_viaje'],
                $row['nombre'],
                $row['descripcion'],
                $row['duracion'],
                $row['precio']
            );
        }
        return null;
    }

    // Crear nuevo viaje
    public function crear(Viaje $viaje) {
        $sql = "INSERT INTO viaje (nombre, descripcion, duracion, precio) 
                VALUES (?, ?, ?, ?)";
        
        return $this->db->executeQuery($sql, [
            $viaje->getNombre(),
            $viaje->getDescripcion(),
            $viaje->getDuracion(),
            $viaje->getPrecio()
        ]);
    }

    // Actualizar viaje
    public function actualizar(Viaje $viaje) {
        $sql = "UPDATE viaje 
                SET nombre = ?, descripcion = ?, duracion = ?, precio = ? 
                WHERE id_viaje = ?";
        
        return $this->db->executeQuery($sql, [
            $viaje->getNombre(),
            $viaje->getDescripcion(),
            $viaje->getDuracion(),
            $viaje->getPrecio(),
            $viaje->getID()
        ]);
    }

    // Eliminar viaje
    public function eliminar($ID_viaje) {
        $sql = "DELETE FROM viaje WHERE id_viaje = ?";
        return $this->db->executeQuery($sql, [$ID_viaje]);
    }
}
