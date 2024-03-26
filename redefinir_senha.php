<?php

$errors = array();

// Verificar se o token está presente na URL
if(isset($_GET['token'])) {
    $token = $_GET['token'];
    // Aqui você pode realizar as validações necessárias para o token, como verificar se ele existe no banco de dados e se está dentro do prazo de validade, por exemplo.
    // Se as validações forem bem-sucedidas, exiba o formulário de redefinição de senha.

    // Verificar se o token é válido
    include_once('config.php');
    $consulta = "SELECT COUNT(*) as count FROM `cadastro` WHERE reset_token = '$token'";
    $resultado = mysqli_query($conn, $consulta);
    $row = mysqli_fetch_assoc($resultado);
    $count = $row['count'];
    $tokenValido = $count > 0;

    if ($tokenValido) {
        if(isset($_POST['submit'])) {
            $novaSenha = trim($_POST['nova_senha']);
            $confirmarSenha = trim($_POST['confirmar_senha']);

            if (empty($novaSenha) || empty($confirmarSenha)) {
                $errors[] = "Preencha todos os campos.";
            } elseif (strlen($novaSenha) < 6) {
                $errors[] = "A senha deve ter no mínimo 6 caracteres.";
            }

            // Validar se a nova senha e a confirmação são iguais
            if ($novaSenha !== $confirmarSenha) {
                $errors[] = "As senhas não coincidem. Por favor, tente novamente.";
            }

            if (empty($errors)) {
                // Criptografa a nova senha usando um algoritmo seguro
                $hashedNovaSenha = password_hash($novaSenha, PASSWORD_DEFAULT);
            
                // Código para atualizar a senha no banco de dados
                $query = "UPDATE `cadastro` SET senha = '$hashedNovaSenha', reset_token = NULL WHERE reset_token = '$token'";
                
                if (mysqli_query($conn, $query)) {
                    $sucesso[] = "Senha redefinida com sucesso! Volte para a <a href='login.php'>tela de login</a> e use a sua nova senha.";
                } else {
                    $errors[] = "Ocorreu um erro ao redefinir a senha. Por favor, tente novamente mais tarde.";
                }
            } else {
                $errors['cadastro'] = "Ocorreu um erro ao redefinir a senha.";
            }
            
        }
    } else {
        header('Location: esqueceu_senha.php');
    }
} else {
    // Caso o token não esteja presente na URL, exiba uma mensagem de erro ou redirecione o usuário para a página de solicitação de redefinição de senha.
    header('Location: esqueceu_senha.php');
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Redefinir Senha</title>
    <link rel="stylesheet" type="text/css" href="css/formulario.css"/>
</head>
<body>
<section class="sticky">
    <div class="bubbles">
        <div class="bubble"></div>
        <div class="bubble"></div>
        <div class="bubble"></div>
        <div class="bubble"></div>
        <div class="bubble"></div>
        <div class="bubble"></div>
        <div class="bubble"></div>
        <div class="bubble"></div>
        <div class="bubble"></div>
        <div class="bubble"></div>      
    </div>
</section>
<div class="container">
    <?php
    if (isset($_GET['token']) && $tokenValido == true) {
        echo "<h1 class='heading'>Redefinir Senha</h1>";
        echo "<br>";
        echo "<p class='descricao'>Por favor, insira sua nova senha nos campos abaixo para redefinir sua senha.</p>";
        echo "<br><br>";
        echo "<form method='POST' action=''>";

        echo "<div class='inputBox'>";
        echo "<input type='password' name='nova_senha' class='inputUser' required>";
        echo "<label for='nova_senha' class='labelInput'>Nova senha</label>";
        echo "</div>";

        echo "<br><br>";

        echo "<div class='inputBox'>";
        echo "<input type='password' name='confirmar_senha' class='inputUser' required>";
        echo "<label for='confirmar_senha' class='labelInput'>Confirmar senha</label>";
        echo "</div>";

        echo "<br><br>";

        if (!empty($errors)) {
            echo "<div style='background: #ffa5ae;color: red; font-size: 15px; border-radius: 5px; text-align: center; padding: 5px;'>";
            echo "<ul style='list-style: none;'>";
            echo "<li>" . reset($errors) . "</li>";
            echo "</ul>";
            echo "</div>";
        } elseif (!empty($sucesso)) {
            echo "<div>";
            echo "<ul style='list-style: none;background: #bbffb1;color: green; font-size: 15px; border-radius: 5px; text-align: center; padding: 5px;'>";
            echo "<li>" . reset($sucesso) . "</li>";
            echo "</ul>";
            echo "</div><br>";
        }

        echo "<input type='submit' name='submit' class='btn' value='Redefinir Senha'>";
        echo "</form>";
    } else {
        // Caso o token não esteja presente na URL ou haja erros, exiba uma mensagem de erro.
        header('Location: esqueceu_senha.php');
    }
    ?>
</div>
</body>
</html>
