<?php
require_once 'UserModel.php';

$userModel = new UserModel();

//Listar todos os usuários
$users = $userModel->getAllUsers();
foreach ($users as $user) {
    echo "ID: " . $user['id'] . "<br>";
    echo "Nome: " . $user['nome'] . "<br>";
    echo "Email: " . $user['email'] . "<br>";
    echo "<hr>";
}