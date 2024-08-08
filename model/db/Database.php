<?php

require_once 'conexao.php';

class Database {
    private $conn;

    // Construtor para inicializar a instância da classe Conexao
    public function __construct() {
        $this->conn = Conexao::getInstance()->getConnection();
    }

    // Destructor para fechar a conexão com o banco de dados
    public function __destruct() {
        Conexao::getInstance()->disconnect();
    }

    // Método para executar uma query no banco de dados
    public function executeQuery($sql, $params = []) {
        $stmt = $this->conn->prepare($sql);
        $stmt->execute($params);
        return $stmt;
    }
    
}

?>