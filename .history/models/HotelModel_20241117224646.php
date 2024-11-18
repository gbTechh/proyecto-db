<?php
class HotelModel extends Model {

    // Obtener todos los hoteles
    public function getAll() {
        $sql = "SELECT ID_hotel, nombre, direccion, categoria, telefono, precio_por_noche, ID_ciudad FROM Hotel";
        $stmt = $this->executeQuery($sql);
        $hoteles = [];
        
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $hoteles[] = new Hotel(
                $row['ID_hotel'],
                $row['nombre'],
                $row['direccion'],
                $row['categoria'],
                $row['telefono'],
                $row['precio_por_noche'],
                $row['ID_ciudad']
            );
        }
        
        return $hoteles;
    }

    public function buscarHoteles($destino) {
        $sql = "SELECT ID_hotel, nombre, direccion, categoria, telefono, precio_por_noche FROM Hotel WHERE ID_ciudad = ?";
        $stmt = $this->executeQuery($sql, [$destino]);
        $hoteles = [];
        
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $hoteles[] = new Hotel(
                $row['ID_hotel'],
                $row['nombre'],
                $row['direccion'],
                $row['categoria'],
                $row['telefono'],
                $row['precio_por_noche']
            );
        }
        
        return $hoteles;
    }

    // Obtener hoteles paginados
    public function getPaginated($page = 1, $limit = 10, $search = '') {
        try {
            $offset = ($page - 1) * $limit;
            
            // Consulta base
            $sql = "SELECT ID_hotel, nombre, direccion, categoria, telefono, precio_por_noche, ID_ciudad FROM Hotel";
            $countSql = "SELECT COUNT(*) as total FROM Hotel";
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
                    $row['ID_hotel'],
                    $row['nombre'],
                    $row['direccion'],
                    $row['categoria'],
                    $row['telefono'],
                    $row['precio_por_noche'],
                    $row['ID_ciudad']
                );
            }

            // Convertir los objetos Hotel a arrays para JSON
            $hotelesArray = array_map(function($hotel) {
                return [
                    'ID_hotel' => $hotel->getID(),
                    'nombre' => $hotel->getNombre(),
                    'direccion' => $hotel->getDireccion(),
                    'categoria' => $hotel->getCategoria(),
                    'telefono' => $hotel->getTelefono(),
                    'precio_por_noche' => $hotel->getPrecioPorNoche(),
                    'ID_ciudad' => $hotel->getCiudad()
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

    // Obtener un hotel por ID
    public function getByID($ID_hotel) {
        $sql = "SELECT * FROM Hotel WHERE ID_hotel = ?";
        $stmt = $this->executeQuery($sql, [$ID_hotel]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        
        if ($row) {
            return new Hotel(
                $row['ID_hotel'],
                $row['nombre'],
                $row['direccion'],
                $row['categoria'],
                $row['telefono'],
                $row['precio_por_noche'],
                $row['ID_ciudad']
            );
        }
        return null;
    }

    // Crear un nuevo hotel
    public function crear(Hotel $hotel) {
        $sql = "INSERT INTO Hotel (ID_hotel, nombre, direccion, categoria, telefono, precio_por_noche, ID_ciudad) 
                VALUES (?, ?, ?, ?, ?, ?, ?)";
        
        return $this->executeQuery($sql, [
            $hotel->getID(),
            $hotel->getNombre(),
            $hotel->getDireccion(),
            $hotel->getCategoria(),
            $hotel->getTelefono(),
            $hotel->getPrecioPorNoche(),
            $hotel->getCiudad()
        ]);
    }

    // Actualizar un hotel
    public function actualizar(Hotel $hotel) {
        $sql = "UPDATE Hotel 
                SET nombre = ?, direccion = ?, categoria = ?, telefono = ?, precio_por_noche = ?, ID_ciudad = ? 
                WHERE ID_hotel = ?";
        
        return $this->executeQuery($sql, [
            $hotel->getNombre(),
            $hotel->getDireccion(),
            $hotel->getCategoria(),
            $hotel->getTelefono(),
            $hotel->getPrecioPorNoche(),
            $hotel->getCiudad(),
            $hotel->getID()
        ]);
    }

    // Eliminar un hotel
    public function eliminar($ID_hotel) {
        $sql = "DELETE FROM hotel WHERE ID_hotel = ?";
        return $this->executeQuery($sql, [$ID_hotel]);
    }
}
