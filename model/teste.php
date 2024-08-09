<?php

require_once '../controller/UserController.php';
require_once 'User.php';

$userController = new UserController();

//Criar um novo usuário
$user = new User("John Doe", "123.456.789-00", "joho@gmail.com", "123456", "123456789", "Rua das Flores, 123", "Universidade XYZ", "Professor");
$novoObj = $userController->createUser($user);

//echo "Usuário criado com sucesso! ID: " . $novoObj->getId() . "<br>";

//Listar todos os usuários
$users = $userController->getAllUsers();
foreach ($users as $user) {
    echo "ID: " . $user->getId() . "<br>";
    echo "Nome: " . $user->getNome() . "<br>";
    echo "Email: " . $user->getEmail() . "<br>";
    echo "telefone: " . $user->getTelefone() . "<br>";
    echo "Endereço: " . $user->getEndereco() . "<br>";
    echo "CPF: " . $user->getCpf() . "<br>";
    echo "Insituição: " . $user->getInstituicao() . "<br>";
    echo "Função: " . $user->getFuncao() . "<br>";
    echo "<hr>";
}