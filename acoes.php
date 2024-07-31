<?php 
session_start();
require 'conexao.php';

if(isset($_POST['adicionar'])){
    $email = mysqli_real_escape_string($conexao, trim($_POST['email']));
    $texto = mysqli_real_escape_string($conexao, trim($_POST['texto']));

    $sql = "INSERT INTO cruds (email, texto) VALUES ('$email', '$texto')";

    if(mysqli_query($conexao, $sql)){
        // Armazena a variável na sessão
        $_SESSION['texto'] = $texto;
        $_SESSION['mensagem'] = 'Texto criado com sucesso';
        header('Location: crud.php'); // Redireciona para a página onde a variável será exibida
        exit;
    } else {
        $_SESSION['mensagem'] = 'Texto não foi criado';
        header('Location: crud.php');
        exit;
    }
}
if(isset($_POST['editar'])){
    $crud_id= mysqli_real_escape_string($conexao, $_POST['crud_id']);

    $email = mysqli_real_escape_string($conexao, trim($_POST['email']));
    $texto = mysqli_real_escape_string($conexao, trim($_POST['texto']));

    $sql = "UPDATE cruds SET email = '$email', texto = '$texto'";

    $sql .= "WHERE id = '$crud_id'";

    mysqli_query($conexao, $sql);

    if(mysqli_affected_rows($conexao) >0){
        $_SESSION['mensagem'] = 'Texto atualizado com sucesso!';
        header('Location: crud.php');
        exit;
    }else{
        $_SESSION['mensagem'] = 'Texto não foi atualizado';
        header('Location: crud.php');
        exit;
    }
}
if (isset($_POST['apagar_texto'])) {
    $crud_id = mysqli_real_escape_string($conexao, $_POST['apagar_texto']);

    // Update the record to set the text field to an empty string
    $sql = "UPDATE cruds SET email = '' WHERE id = '$crud_id'";
    $sql = "UPDATE cruds SET texto = '' WHERE id = '$crud_id'";

    if (mysqli_query($conexao, $sql)) {
        $_SESSION['mensagem'] = 'Texto apagado com sucesso';
    } else {
        $_SESSION['mensagem'] = 'Texto não foi apagado';
    }
    header('Location: crud.php');
    exit;
}
?>
