<?php

require_once '../model/db/UserModel.php';

class UserController {
    private $userModel;

    public function __construct() {
        $this->userModel = new UserModel();
    }

    public function createUser(User $user) : User {
        $this->userModel->createUser($user);
        return $user;
    }

    public function getUserById($id) : User {
        $user = $this->userModel->getUserById($id);
        $userObj = new User();
        $userObj->setId($user['id']);
        $userObj->setNome($user['nome']);
        $userObj->setEmail($user['email']);
        return $userObj;
    }

    public function updateUser($user) {
        return $this->userModel->updateUser($user);
    }

    public function deleteUser($id) {
        return $this->userModel->deleteUser($id);
    }

    public function getAllUsers() {
        $users = $this->userModel->getAllUsers();
        $usersList = [];
        foreach ($users as $user) {
            $userObj = new User();
            $userObj->setId($user['id']);
            $userObj->setNome($user['nome']);
            $userObj->setEmail($user['email']);
            $userObj->setTelefone($user['telefone']);
            $userObj->setEndereco($user['endereco']);
            $userObj->setCpf($user['cpf']);
            $userObj->setInstituicao($user['instituicao']);
            $userObj->setFuncao($user['funcao']);
            $usersList[] = $userObj;
        }
        return $usersList;
    }
}