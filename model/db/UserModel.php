<?php

require_once 'Database.php';
require_once 'model/User.php';

class UserModel {
	private $db;

	// Construtor para inicializar a instância da classe Database
	public function __construct() {
		$this->db = new Database();
	}

	// Método para criar um novo usuário com prepared statements
	public function createUser(User $user) {
		$sql = "INSERT INTO users (nome, cpf, email, senha, telefone, endereco, instituicao, funcao, status, data_cadastro, data_atualizacao) VALUES (:nome, :cpf, :email, :senha, :telefone, :endereco, :instituicao, :funcao, :status, NOW(), NOW())";
		$params = [
			':nome' => $user->getNome(),
			':cpf' => $user->getCpf(),
			':email' => $user->getEmail(),
			':senha' => $user->getSenha(),
			':telefone' => $user->getTelefone(),
			':endereco' => $user->getEndereco(),
			':instituicao' => $user->getInstituicao(),
			':funcao' => $user->getFuncao(),
			':status' => 0 // 0 = Inativo, 1 = Ativo
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
	public function updateUser($user) {
		$sql = "UPDATE users SET name = :name, email = :email, telefone = :telefone, endereco = :endereco, instituicao = :instituicao, funcao = :funcao, status = :status, data_atualizacao = NOW() WHERE id = :id";
		$params = [
			':id' => $user->getId(),
			':name' => $user->getName(),
			':email' => $user->getEmail(),
			':telefone' => $user->getTelefone(),
			':endereco' => $user->getEndereco(),
			':instituicao' => $user->getInstituicao(),
			':funcao' => $user->getFuncao(),
			':status' => $user->getStatus()
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
		$sql = "SELECT * FROM users";
		$stmt = $this->db->executeQuery($sql);
		return $stmt->fetchAll(PDO::FETCH_ASSOC);
	}

	// Método para verificar se um email ou CPF já estão cadastrados
	public function verifiedEmailAndCPF($email, $cpf=null) {
		if ($cpf == null) {
			$sql = "SELECT * FROM users WHERE email = :email";
			$params = [':email' => $email];
		} else {
			$sql = "SELECT * FROM users WHERE email = :email OR cpf = :cpf";
			$params = [
				':email' => $email,
				':cpf' => $cpf
			];
		}
		$stmt = $this->db->executeQuery($sql, $params);
		$user = $stmt->fetch(PDO::FETCH_ASSOC);
		if ($user) {
			return true;
		} else {
			return false;
		}
	}

	// Método para verificar se um email e senha correspondem a um usuário cadastrado
	public function verifiedEmailAndPassword($email, $password) {
		$sql = "SELECT * FROM users WHERE email = :email AND senha = :senha";
		$params = [
			':email' => $email,
			':senha' => $password
		];
		$stmt = $this->db->executeQuery($sql, $params);
		return $stmt->fetch(PDO::FETCH_ASSOC);
		if ($user) {
			return true;
		} else {
			return false;
		}
	}
}
?>