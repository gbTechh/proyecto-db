<?php
class Database {
    private static $instance = null;
    private $connection;
    private $statement;

    private function __construct() {
        try {
            $dsn = "mysql:host=" . DB_HOST . ";dbname=" . DB_NAME . ";charset=utf8mb4";
            $options = [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                PDO::ATTR_EMULATE_PREPARES => false
            ];
            
            $this->connection = new PDO($dsn, DB_USER, DB_PASS, $options);
        } catch(PDOException $e) {
            throw new Exception("Error de conexión: " . $e->getMessage());
        }
    }

    // Patrón Singleton
    public static function getInstance() {
        if (self::$instance === null) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    // Preparar consulta
    public function query($sql) {
        $this->statement = $this->connection->prepare($sql);
        return $this;
    }

    // Vincular valores
    public function bind($param, $value, $type = null) {
        if (is_null($type)) {
            switch (true) {
                case is_int($value):
                    $type = PDO::PARAM_INT;
                    break;
                case is_bool($value):
                    $type = PDO::PARAM_BOOL;
                    break;
                case is_null($value):
                    $type = PDO::PARAM_NULL;
                    break;
                default:
                    $type = PDO::PARAM_STR;
            }
        }
        $this->statement->bindValue($param, $value, $type);
        return $this;
    }

    // Ejecutar consulta
    public function execute() {
        return $this->statement->execute();
    }

    // Obtener un solo registro
    public function single() {
        $this->execute();
        return $this->statement->fetch();
    }

    // Obtener todos los registros
    public function all() {
        $this->execute();
        return $this->statement->fetchAll();
    }

    // Obtener cantidad de filas afectadas
    public function rowCount() {
        return $this->statement->rowCount();
    }

    // Obtener último ID insertado
    public function lastInsertId() {
        return $this->connection->lastInsertId();
    }

    // Iniciar transacción
    public function beginTransaction() {
        return $this->connection->beginTransaction();
    }

    // Confirmar transacción
    public function commit() {
        return $this->connection->commit();
    }

    // Revertir transacción
    public function rollBack() {
        return $this->connection->rollBack();
    }
}