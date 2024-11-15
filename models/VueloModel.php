<?php
class VueloModel extends Model {

    // Obtener todos los vuelos
    public function getAll() {
        $sql = "SELECT v.ID_vuelo, v.num_vuelo, c.Nombre as 'ciudad_origen', c2.Nombre as 'ciudad_destino', v.fecha_salida, v.fecha_llegada, v.precio FROM Vuelo v INNER JOIN Ciudad c on v.Ciudad_Origen = c.ID_Ciudad INNER JOIN Ciudad c2 on v.Ciudad_Destino = c2.ID_Ciudad;";
        $stmt = $this->db->executeQuery($sql);
        $vuelos = [];
        
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $vuelos[] = new Vuelo(
                $row['ID_vuelo'],
                $row['num_vuelo'],
                $row['ciudad_origen'],
                $row['ciudad_destino'],
                $row['fecha_salida'],
                $row['fecha_llegada'],
                $row['precio']
            );
        }
        
        return $vuelos;
    }

    // Obtener vuelo por ID
    public function getByID($ID_vuelo) {
        $sql = "SELECT * FROM Vuelo WHERE ID_vuelo = ?";
        $stmt = $this->db->executeQuery($sql, [$ID_vuelo]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        
        if ($row) {
            return new Vuelo(
                $row['ID_vuelo'],
                $row['num_vuelo'],
                $row['ciudad_origen'],
                $row['ciudad_destino'],
                $row['fecha_salida'],
                $row['fecha_llegada'],
                $row['precio']
            );
        }
        return null;
    }

    // Crear nuevo vuelo
    public function crear(Vuelo $vuelo) {
        $sql = "INSERT INTO Vuelo (num_vuelo, ciudad_origen, ciudad_destino, fecha_salida, fecha_llegada, precio) 
                VALUES (?, ?, ?, ?, ?, ?)";
        
        return $this->db->executeQuery($sql, [
            $vuelo->getNumVuelo(),
            $vuelo->getCiudadOrigen(),
            $vuelo->getCiudadDestino(),
            $vuelo->getFechaSalida(),
            $vuelo->getFechaLlegada(),
            $vuelo->getPrecio()
        ]);
    }

    // Actualizar vuelo
    public function actualizar(Vuelo $vuelo) {
        $sql = "UPDATE Vuelo 
                SET num_vuelo = ?, ciudad_origen = ?, ciudad_destino = ?, fecha_salida = ?, fecha_llegada = ?, precio = ? 
                WHERE ID_vuelo = ?";
        
        return $this->db->executeQuery($sql, [
            $vuelo->getNumVuelo(),
            $vuelo->getCiudadOrigen(),
            $vuelo->getCiudadDestino(),
            $vuelo->getFechaSalida(),
            $vuelo->getFechaLlegada(),
            $vuelo->getPrecio(),
            $vuelo->getID()
        ]);
    }

    // Eliminar vuelo
    public function eliminar($ID_vuelo) {
        $sql = "DELETE FROM Vuelo WHERE ID_vuelo = ?";
        return $this->db->executeQuery($sql, [$ID_vuelo]);
    }

    // Obtener vuelos por ciudad de origen
    public function getByCiudadOrigen($ciudad_origen) {
        $sql = "SELECT * FROM Vuelo WHERE ciudad_origen = ?";
        $stmt = $this->db->executeQuery($sql, [$ciudad_origen]);
        $vuelos = [];
        
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $vuelos[] = new Vuelo(
                $row['ID_vuelo'],
                $row['num_vuelo'],
                $row['ciudad_origen'],
                $row['ciudad_destino'],
                $row['fecha_salida'],
                $row['fecha_llegada'],
                $row['precio']
            );
        }
        
        return $vuelos;
    }
}
