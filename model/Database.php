<?php
class Database {
    private $host = 'localhost';
    private $dbUsername = 'root';
    private $dbPassword = '';
    private $dbName = 'projeto';
    private $conn;

    // Construtor para inicializar a conexão
    public function __construct() {
        $this->connect();
    }

    // Método para abrir a conexão com o banco de dados
    private function connect() {
        try {
            $dsn = "mysql:host={$this->host};dbname={$this->dbName}";
            $this->conn = new PDO($dsn, $this->dbUsername, $this->dbPassword);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            die("Falha na conexão: " . $e->getMessage());
        }
    }

    // Método para fechar a conexão com o banco de dados
    public function disconnect() {
        $this->conn = null;
    }

    // Método para executar consultas
    public function executeQuery($sql, $params = []) {
        try {
            $stmt = $this->conn->prepare($sql);
            $stmt->execute($params);
            return $stmt;
        } catch (PDOException $e) {
            die("Erro na consulta: " . $e->getMessage());
        }
    }
    
}

?>