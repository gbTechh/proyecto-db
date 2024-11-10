<?php
class ProveedorModel extends Model {

    // Obtener todos los proveedores
    public function getAll() {
        $sql = "SELECT ID_proveedor, nombre, direccion, telefono, email FROM proveedor";
        $stmt = $this->executeQuery($sql);
        $proveedores = [];
        
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $proveedores[] = new Proveedor(
                $row['ID_proveedor'],
                $row['nombre'],
                $row['direccion'],
                $row['telefono'],
                $row['email']
            );
        }
        
        return $proveedores;
    }

    // Obtener proveedores paginados
    public function getPaginated($page = 1, $limit = 10, $search = '') {
        try {
            $offset = ($page - 1) * $limit;
            
            // Consulta base
            $sql = "SELECT ID_proveedor, nombre, direccion, telefono, email FROM proveedor";
            $countSql = "SELECT COUNT(*) as total FROM proveedor";
            $params = [];

            // Si hay búsqueda, agregarla a las consultas
            if (!empty($search)) {
                $searchWhere = " WHERE nombre LIKE :search OR direccion LIKE :search OR telefono LIKE :search";
                $sql .= $searchWhere;
                $countSql .= $searchWhere;
                $params[':search'] = "%$search%";
            }

            // Agregar limit y offset para paginación
            $sql .= " LIMIT :limit OFFSET :offset";

            // Obtener total de proveedores
            $stmt = $this->db->prepare($countSql);
            if (!empty($search)) {
                $stmt->bindValue(':search', "%$search%", PDO::PARAM_STR);
            }
            $stmt->execute();
            $total = $stmt->fetch(PDO::FETCH_ASSOC)['total'];

            // Ejecutar la consulta principal para obtener los proveedores
            $stmt = $this->db->prepare($sql);
            if (!empty($search)) {
                $stmt->bindValue(':search', "%$search%", PDO::PARAM_STR);
            }
            $stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
            $stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
            $stmt->execute();

            $proveedores = [];
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $proveedores[] = new Proveedor(
                    $row['ID_proveedor'],
                    $row['nombre'],
                    $row['direccion'],
                    $row['telefono'],
                    $row['email']
                );
            }

            // Convertir los objetos Proveedor a arrays para JSON
            $proveedoresArray = array_map(function($proveedor) {
                return [
                    'ID_proveedor' => $proveedor->getID(),
                    'nombre' => $proveedor->getNombre(),
                    'direccion' => $proveedor->getDireccion(),
                    'telefono' => $proveedor->getTelefono(),
                    'email' => $proveedor->getEmail()
                ];
            }, $proveedores);

            return [
                'data' => $proveedoresArray,
                'total' => $total,
                'totalPages' => ceil($total / $limit),
                'currentPage' => $page
            ];

        } catch (PDOException $e) {
            throw new Exception("Error en la consulta: " . $e->getMessage());
        }
    }

    // Obtener proveedor por ID
    public function getByID($ID_proveedor) {
        $sql = "SELECT * FROM proveedor WHERE ID_proveedor = ?";
        $stmt = $this->executeQuery($sql, [$ID_proveedor]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        
        if ($row) {
            return new Proveedor(
                $row['ID_proveedor'],
                $row['nombre'],
                $row['direccion'],
                $row['telefono'],
                $row['email']
            );
        }
        return null;
    }

    // Crear un nuevo proveedor
    public function crear(Proveedor $proveedor) {
        $sql = "INSERT INTO proveedor (ID_proveedor, nombre, direccion, telefono, email) 
                VALUES (?, ?, ?, ?, ?)";
        
        return $this->executeQuery($sql, [
            $proveedor->getID(),
            $proveedor->getNombre(),
            $proveedor->getDireccion(),
            $proveedor->getTelefono(),
            $proveedor->getEmail()
        ]);
    }

    // Actualizar un proveedor
    public function actualizar(Proveedor $proveedor) {
        $sql = "UPDATE proveedor 
                SET nombre = ?, direccion = ?, telefono = ?, email = ? 
                WHERE ID_proveedor = ?";
        
        return $this->executeQuery($sql, [
            $proveedor->getNombre(),
            $proveedor->getDireccion(),
            $proveedor->getTelefono(),
            $proveedor->getEmail(),
            $proveedor->getID()
        ]);
    }

    // Eliminar un proveedor
    public function eliminar($ID_proveedor) {
        $sql = "DELETE FROM proveedor WHERE ID_proveedor = ?";
        return $this->executeQuery($sql, [$ID_proveedor]);
    }
}
