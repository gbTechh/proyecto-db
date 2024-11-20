<?php
class HotelModel extends Model {

    // Obtener todos los hoteles
    public function getAll() {
        $sql = "SELECT h.id_hotel, h.nombre, h.categoria, h.telefono, h.direccion, h.precio_por_noche, c.nombre AS ciudad
                FROM hotel h
                INNER JOIN ciudad c ON h.id_ciudad = c.id_ciudad";  
        
        $rows = $this->db->getAll($sql);
        $hoteles = [];
        
        foreach ($rows as $row) {
            $hotel = new Hotel(
                $row['id_hotel'],
                $row['nombre'],
                $row['direccion'],
                $row['categoria'],
                $row['telefono'],
                $row['precio_por_noche'],
                $row['ciudad'],
            );
            $hoteles[] = $hotel;
        }
        
        return $hoteles;
    }
    

    // Obtener un hotel por ID
    public function getByID($id_hotel) {
        $sql = "SELECT * FROM hotel WHERE id_hotel = ?";
        $stmt = $this->db->executeQuery($sql, [$id_hotel]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        
        if ($row) {
            return new Hotel(
                $row['id_hotel'],
                $row['nombre'],
                $row['direccion'],
                $row['categoria'],
                $row['telefono'],
                $row['precio_por_noche'],
                $row['id_ciudad']
            );
        }
        return null;
    }

    // Crear un nuevo hotel
    public function crear(Hotel $hotel, $id_proveedor) {
        $sql = "INSERT INTO hotel (nombre, direccion, categoria, telefono, precio_por_noche, id_ciudad) 
                VALUES (?, ?, ?, ?, ?, ?)";
        $this->db->executeQuery($sql, [
            $hotel->getNombre(),
            $hotel->getDireccion(),
            $hotel->getCategoria(),
            $hotel->getTelefono(),
            $hotel->getPrecioPorNoche(),
            $hotel->getCiudad()
        ]);

        // Obtener el último ID insertado
        $id_hotel = $this->db->getLastInsertId();

        $sql_proveedor = "INSERT INTO proveedor_hotel (id_proveedor, id_hotel)
                          VALUES (?, ?)";
        return $this->db->executeQuery($sql_proveedor, [
            $id_proveedor,
            $id_hotel
        ]);                
    }

    
    // Actualizar un hotel
    public function actualizar(Hotel $hotel, $ids_proveedores) {
        $sql = "UPDATE hotel 
                SET nombre = ?, direccion = ?, categoria = ?, telefono = ?, precio_por_noche = ?, id_ciudad = ? 
                WHERE id_hotel = ?";
        
        $resultado = $this->db->executeQuery($sql, [
            $hotel->getNombre(),
            $hotel->getDireccion(),
            $hotel->getCategoria(),
            $hotel->getTelefono(),
            $hotel->getPrecioPorNoche(),
            $hotel->getCiudad(),
            $hotel->getID()
        ]);

        $this->actualizarProveedoresPorHotel($hotel->getID(), $ids_proveedores);
        return  $resultado;
    }

    public function actualizarProveedoresPorHotel($id_hotel, $ids_proveedores) {
        // Imprimir el ID del hotel para verificarlo
        echo "<pre>ID del hotel: ";
        var_dump($id_hotel);
        echo "</pre>";
    
        // Imprimir los IDs de los proveedores para verificar qué datos están llegando
        echo "<pre>IDs de proveedores recibidos: ";
        var_dump($ids_proveedores);
        echo "</pre>";
    
        // Eliminar todos los proveedores actuales para este hotel en la tabla
        $sqlDelete = "DELETE FROM proveedor_hotel WHERE id_hotel = ?";
        $this->db->executeQuery($sqlDelete, [$id_hotel]);
        echo "<p>Proveedores actuales eliminados para el hotel con ID {$id_hotel}</p>";
    
        // Insertar los nuevos proveedores asociados si hay algún ID en $ids_proveedores
        if (!empty($ids_proveedores)) {
            $sqlInsert = "INSERT INTO proveedor_hotel (id_hotel, id_proveedor) VALUES (?, ?)";
            foreach ($ids_proveedores as $id_proveedor) {
                echo "<p>Insertando proveedor con ID {$id_proveedor} para el hotel con ID {$id_hotel}</p>";
                $this->db->executeQuery($sqlInsert, [$id_hotel, $id_proveedor]);
            }
        } else {
            echo "<p>No hay proveedores para insertar para el hotel con ID {$id_hotel}</p>";
        }
    
        echo "<p>Actualización de proveedores completada para el hotel con ID {$id_hotel}</p>";
    }
    
    // Eliminar un hotel
    public function eliminar($id_hotel) {
        $sql = "DELETE FROM hotel WHERE id_hotel = ?";
        return $this->db->executeQuery($sql, [$id_hotel]);
    }

    // Buscar hoteles por ciudad
    public function buscarHotelesPorCiudad($nombreCiudad) {
        // Obtener el ID de la ciudad
        $sql = "SELECT id_ciudad FROM ciudad WHERE nombre = ?";
        $stmt = $this->db->executeQuery($sql, [$nombreCiudad]);
        $ciudad = $stmt->fetch(PDO::FETCH_ASSOC);
        
        if ($ciudad) {
            $idCiudad = $ciudad['id_ciudad'];
            // Obtener los hoteles en esa ciudad
            $sql = "SELECT id_hotel, nombre, direccion, categoria, telefono, precio_por_noche, id_ciudad 
                    FROM hotel WHERE id_ciudad = ?";
            $stmt = $this->db->executeQuery($sql, [$idCiudad]);
            $hoteles = [];
            
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $hoteles[] = new Hotel(
                    $row['id_hotel'],
                    $row['nombre'],
                    $row['direccion'],
                    $row['categoria'],
                    $row['telefono'],
                    $row['precio_por_noche'],
                    $row['id_ciudad']
                );
            }
            
            return $hoteles;
        }
        return [];
    }

    // Obtener hoteles paginados
    public function getPaginated($page = 1, $limit = 10, $search = '') {
        try {
            $offset = ($page - 1) * $limit;
            
            // Consulta base
            $sql = "SELECT id_hotel, nombre, direccion, categoria, telefono, precio_por_noche, id_ciudad FROM hotel";
            $countSql = "SELECT COUNT(*) as total FROM hotel";
            $params = [];

            // Si hay búsqueda, agregarla a las consultas
            if (!empty($search)) {
                $searchWhere = " WHERE nombre LIKE :search OR direccion LIKE :search OR categoria LIKE :search";
                $sql .= $searchWhere;
                $countSql .= $searchWhere;
                $params[':search'] = "%$search%";
            }

            // Agregar limit y offset para paginación
            $sql .= " LIMIT :limit OFFSET :offset";

            // Obtener total de hoteles
            $stmt = $this->db->prepare($countSql);
            if (!empty($search)) {
                $stmt->bindValue(':search', "%$search%", PDO::PARAM_STR);
            }
            $stmt->execute();
            $total = $stmt->fetch(PDO::FETCH_ASSOC)['total'];

            // Ejecutar la consulta principal para obtener los hoteles
            $stmt = $this->db->prepare($sql);
            if (!empty($search)) {
                $stmt->bindValue(':search', "%$search%", PDO::PARAM_STR);
            }
            $stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
            $stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
            $stmt->execute();

            $hoteles = [];
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $hoteles[] = new Hotel(
                    $row['id_hotel'],
                    $row['nombre'],
                    $row['direccion'],
                    $row['categoria'],
                    $row['telefono'],
                    $row['precio_por_noche'],
                    $row['id_ciudad']
                );
            }

            // Convertir los objetos Hotel a arrays para JSON
            $hotelesArray = array_map(function($hotel) {
                return [
                    'id_hotel' => $hotel->getID(),
                    'nombre' => $hotel->getNombre(),
                    'direccion' => $hotel->getDireccion(),
                    'categoria' => $hotel->getCategoria(),
                    'telefono' => $hotel->getTelefono(),
                    'precio_por_noche' => $hotel->getPrecioPorNoche(),
                    'id_ciudad' => $hotel->getCiudad()
                ];
            }, $hoteles);

            return [
                'data' => $hotelesArray,
                'total' => $total,
                'totalPages' => ceil($total / $limit),
                'currentPage' => $page
            ];

        } catch (PDOException $e) {
            throw new Exception("Error en la consulta: " . $e->getMessage());
        }
    }
}
?>
