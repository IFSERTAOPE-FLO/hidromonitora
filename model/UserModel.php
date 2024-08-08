<?php

require_once 'Database.php';

class UserModel {
	private $db;

	// Construtor para inicializar a instância da classe Database
	public function __construct() {
		$this->db = new Database();
	}

	// Método para criar um novo usuário
	public function createUser($name, $email) {
		$sql = "INSERT INTO users (name, email) VALUES (:name, :email)";
		$params = [
			':name' => $name,
			':email' => $email
		];
		return $this->db->executeQuery($sql, $params);
	}

	// Método para obter um usuário pelo ID
	public function getUserById($id) {
		$sql = "SELECT * FROM users WHERE id = :id";
		$params = [':id' => $id];
		$stmt = $this->db->executeQuery($sql, $params);
		return $stmt->fetch(PDO::FETCH_ASSOC);
	}

	// Método para atualizar os dados de um usuário
	public function updateUser($id, $name, $email) {
		$sql = "UPDATE users SET name = :name, email = :email WHERE id = :id";
		$params = [
			':id' => $id,
			':name' => $name,
			':email' => $email
		];
		return $this->db->executeQuery($sql, $params);
	}

	// Método para deletar um usuário pelo ID
	public function deleteUser($id) {
		$sql = "DELETE FROM users WHERE id = :id";
		$params = [':id' => $id];
		return $this->db->executeQuery($sql, $params);
	}

	// Método para obter todos os usuários
	public function getAllUsers() {
		$sql = "SELECT * FROM cadastro";
		$stmt = $this->db->executeQuery($sql);
		return $stmt->fetchAll(PDO::FETCH_ASSOC);
	}
}
?>