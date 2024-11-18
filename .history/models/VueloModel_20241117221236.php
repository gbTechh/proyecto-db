class VueloModel extends Model {

public function getAll() {
    $sql = "SELECT v.ID_vuelo, v.num_vuelo, c.Nombre as 'ciudad_origen', c2.Nombre as 'ciudad_destino', v.fecha_salida, v.fecha_llegada, v.precio 
            FROM Vuelo v 
            INNER JOIN Ciudad c ON v.Ciudad_Origen = c.ID_Ciudad 
            INNER JOIN Ciudad c2 ON v.Ciudad_Destino = c2.ID_Ciudad;";
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

public function buscarVuelos($fechaSalida, $paisOrigen, $paisDestino) {
    $fechaSalida = date('Y-m-d', strtotime($fechaSalida));
    $sql = "CALL BuscarVuelos(?, ?, ?)";
    $stmt = $this->db->executeQuery($sql, [$fechaSalida, $paisOrigen, $paisDestino]);

    $vuelos = [];
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $vuelos[] = [
            'num_vuelo' => $row['Num_Vuelo'],
            'fecha_salida' => $row['Fecha_Salida'],
            'fecha_llegada' => $row['Fecha_Llegada'],
            'precio' => $row['Precio'],
            'ciudad_origen' => $row['Ciudad Origen'],
            'pais_origen' => $row['Pais Origen'],
            'ciudad_destino' => $row['Ciudad Destino'],
            'pais_destino' => $row['Pais Destino']
        ];
    }

    return $vuelos;
}
}