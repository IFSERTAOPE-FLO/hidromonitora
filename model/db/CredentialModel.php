<?php

require_once 'Database.php';

class CredentialModel {
    private $db;

    // Construtor para inicializar a instância da classe Database
    public function __construct() {
        $this->db = new Database();
    }

    // Método para criar um novo usuário
    public function createCredential($email, $password) {
        $sql = "INSERT INTO credentials (email, password) VALUES (:email, :password)";
        $params = [
            ':email' => $email,
            ':password' => $password
        ];
        return $this->db->executeQuery($sql, $params);
    }

    // Método para obter um usuário pelo ID
    public function getCredentialByEmail($email) {
        $sql = "SELECT * FROM credentials WHERE email = :email";
        $params = [':email' => $email];
        $stmt = $this->db->executeQuery($sql, $params);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Método para atualizar os dados de um usuário
    public function updateCredential($email, $password) {
        $sql = "UPDATE credentials SET email = :email, password = :password WHERE email = :email";
        $params = [
            ':email' => $email,
            ':password' => $password
        ];
        return $this->db->executeQuery($sql, $params);
    }

    // Método para deletar um usuário pelo ID
    public function deleteCredential($email) {
        $sql = "DELETE FROM credentials WHERE email = :email";
        $params = [':email' => $email];
        return $this->db->executeQuery($sql, $params);
    }

    // Método para obter todos os usuários
    public function getAllCredentials() {
        $sql = "SELECT * FROM credentials";
        $stmt = $this->db->executeQuery($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}