<?php
class VueloModel extends Model {

    // Obtener todos los vuelos
    public function getAll() {
        $sql = "SELECT v.id_vuelo, v.num_vuelo, c.nombre as 'ciudad_origen', c2.nombre as 'ciudad_destino', v.fecha_salida, v.fecha_llegada, v.precio FROM vuelo v INNER JOIN ciudad c on v.ciudad_origen = c.id_ciudad INNER JOIN ciudad c2 on v.ciudad_destino = c2.id_ciudad;";
        $stmt = $this->db->executeQuery($sql);
        $vuelos = [];
        
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $vuelos[] = new Vuelo(
                $row['id_vuelo'],
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
        $sql = "SELECT * FROM vuelo WHERE id_vuelo = ?";
        $stmt = $this->db->executeQuery($sql, [$ID_vuelo]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        
        if ($row) {
            return new Vuelo(
                $row['id_vuelo'],
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
        $sql = "INSERT INTO vuelo (num_vuelo, ciudad_origen, ciudad_destino, fecha_salida, fecha_llegada, precio) 
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
        $sql = "UPDATE vuelo 
                SET num_vuelo = ?, ciudad_origen = ?, ciudad_destino = ?, fecha_salida = ?, fecha_llegada = ?, precio = ? 
                WHERE id_vuelo = ?";
        
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
        $sql = "DELETE FROM vuelo WHERE id_vuelo = ?";
        return $this->db->executeQuery($sql, [$ID_vuelo]);
    }

    // Obtener vuelos por ciudad de origen
    public function getByCiudadOrigen($ciudad_origen) {
        $sql = "SELECT * FROM vuelo WHERE ciudad_origen = ?";
        $stmt = $this->db->executeQuery($sql, [$ciudad_origen]);
        $vuelos = [];
        
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $vuelos[] = new Vuelo(
                $row['id_vuelo'],
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
    
    private function getCiudadIdPorNombre($nombre) {
        $sql = "SELECT id_ciudad FROM ciudad WHERE nombre = ?";
        $stmt = $this->db->executeQuery($sql, [$nombre]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return $row ? $row['id_ciudad'] : null; 
    }

    //Obtener vuelos por ciudad de origen, y destino y por fechas
    public function buscarVuelos($origen, $destino, $fechaInicio, $fechaFin) {

        $fechaInicio = date('Y-m-d', strtotime($fechaInicio));
        $fechaFin = date('Y-m-d', strtotime($fechaFin));
        
        // Obtener los IDs de las ciudades
        $idOrigen = $this->getCiudadIdPorNombre($origen);
        $idDestino = $this->getCiudadIdPorNombre($destino);

        if (!$idOrigen || !$idDestino) {
            return ['ida' => [], 'regreso' => []];
        }

        // Consulta para vuelos de ida
        $sqlIda = "SELECT 
            v.id_vuelo,
            v.num_vuelo,
            co.nombre as ciudad_origen,
            cd.nombre as ciudad_destino,
            v.fecha_salida,
            v.fecha_llegada,
            v.precio
        FROM vuelo v
        INNER JOIN ciudad co ON v.ciudad_origen = co.id_ciudad
        INNER JOIN ciudad cd ON v.ciudad_destino = cd.id_ciudad
        WHERE v.ciudad_origen = ? 
        AND v.ciudad_destino = ?
        AND DATE(v.fecha_salida) = ?";

        

        $stmtIda = $this->db->executeQuery($sqlIda, [$idOrigen, $idDestino, $fechaInicio]);
        $vuelosIda = [];

        while ($row = $stmtIda->fetch(PDO::FETCH_ASSOC)) {
            $vuelosIda[] = new Vuelo(
                $row['id_vuelo'],
                $row['num_vuelo'],
                $row['ciudad_origen'],
                $row['ciudad_destino'],
                $row['fecha_salida'],
                $row['fecha_llegada'],
                $row['precio']
            );
        }

        // Consulta para vuelos de regreso
        $sqlRegreso = "SELECT 
            v.id_vuelo,
            v.num_vuelo,
            co.nombre as ciudad_origen,
            cd.nombre as ciudad_destino,
            v.fecha_salida,
            v.fecha_llegada,
            v.precio
        FROM vuelo v
        INNER JOIN ciudad co ON v.ciudad_origen = co.id_ciudad
        INNER JOIN ciudad cd ON v.ciudad_destino = cd.id_ciudad
        WHERE v.ciudad_origen = ? 
        AND v.ciudad_destino = ?
        AND DATE(v.fecha_llegada) = ?";

        $stmtRegreso = $this->db->executeQuery($sqlRegreso, [$idDestino, $idOrigen, $fechaFin]);
        $vuelosRegreso = [];

        while ($row = $stmtRegreso->fetch(PDO::FETCH_ASSOC)) {
            $vuelosRegreso[] = new Vuelo(
                $row['id_vuelo'],
                $row['num_vuelo'],
                $row['ciudad_origen'],
                $row['ciudad_destino'],
                $row['fecha_salida'],
                $row['fecha_llegada'],
                $row['precio']
            );
        }


        $response = [
            'ida' => array_map(function($vuelo) {
                return [
                    'id' => $vuelo->getID(),
                    'num_vuelo' => $vuelo->getNumVuelo(),
                    'origen' => $vuelo->getCiudadOrigen(),
                    'destino' => $vuelo->getCiudadDestino(),
                    'fecha_salida' => $vuelo->getFechaSalida(),
                    'fecha_llegada' => $vuelo->getFechaLlegada(),
                    'precio' => $vuelo->getPrecio()
                ];
            }, $vuelosIda),
            'regreso' => array_map(function($vuelo) {
                return [
                    'id' => $vuelo->getID(),
                    'num_vuelo' => $vuelo->getNumVuelo(),
                    'origen' => $vuelo->getCiudadOrigen(),
                    'destino' => $vuelo->getCiudadDestino(),
                    'fecha_salida' => $vuelo->getFechaSalida(),
                    'fecha_llegada' => $vuelo->getFechaLlegada(),
                    'precio' => $vuelo->getPrecio()
                ];
            }, $vuelosRegreso)
        ];

        return $response;
    }

    
    
}
