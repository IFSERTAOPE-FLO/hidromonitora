<?php

    include_once('config.php');

    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $senha = $_POST['senha'];
    $telefone = $_POST['telefone'];
 
    $result = mysqli_query($conexao, "INSERT INTO cadastro(nome,senha,email,telefone) 
    VALUES ('$nome','$senha','$email','$telefone')");
    header('Location: login.php');

?>