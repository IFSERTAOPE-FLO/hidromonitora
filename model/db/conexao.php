<?php
// Conexão singleton
class Conexao {
    private $host = 'localhost';
    private $dbUsername = 'root';
    private $dbPassword = '';
    private $dbName = 'projeto';
    private $conn;
    private static $instance = null;

    // Construtor para inicializar a conexão

    public function __construct() {
        $this->connect();
    }

    public static function getInstance() {
        if (!self::$instance) {
            self::$instance = new conexao();
        }
        return self::$instance;
    }

    public function getConnection() {
        return $this->conn;
    }

    // Método para abrir a conexão com o banco de dados (singleton)
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

}