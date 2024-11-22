<?php
class Database {
    private static $instance = null;
    private $conn;

    private function __construct() {
        try {
            $this->conn = new PDO(
                "mysql:host=" . DB_HOST . ";dbname=" . DB_NAME . ";charset=utf8mb4",
                DB_USER, 
                DB_PASS,
                [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]
            );
        } catch(PDOException $e) {
            die("Error de conexión: " . $e->getMessage());
        }
    }

    public static function getInstance() {
        if (!self::$instance) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    public function query($sql, $params = []) {
        $stmt = $this->conn->prepare($sql);
        $stmt->execute($params);
        return $stmt;
    }

    public function getAll($sql, $params = []) {
        return $this->query($sql, $params)->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getOne($sql, $params = []) {
        return $this->query($sql, $params)->fetch(PDO::FETCH_ASSOC);
    }

    public function insert($sql, $params = []) {
        $this->query($sql, $params);
        return $this->conn->lastInsertId();
    }

    public function getLastInsertId() {
        return $this->conn->lastInsertId();
    }
    
    public function executeQuery($sql, $params = []) {
        try {
            $stmt = $this->conn->prepare($sql);
            $stmt->execute($params);
            return $stmt;
        } catch (PDOException $e) {
            die("Error en la consulta: " . $e->getMessage());
        }
    }
    public function executeQuery2($sql, $params = []) {
        try {
            // Debug
            error_log("SQL: " . $sql);
            error_log("Params: " . print_r($params, true));

            // Preparar la consulta
            $stmt = $this->conn->prepare($sql);
            if (!$stmt) {
                throw new PDOException($this->conn->errorInfo()[2]);
            }

            // Ejecutar la consulta
            $success = $stmt->execute($params);
            if (!$success) {
                throw new PDOException($stmt->errorInfo()[2]);
            }

            return $stmt;
            
        } catch (PDOException $e) {
            // Registrar el error para debugging
            error_log("Database Error: " . $e->getMessage());
            error_log("SQL: " . $sql);
            error_log("Params: " . print_r($params, true));
            
            throw new Exception("Error en la consulta: " . $e->getMessage());
        }
    }
}