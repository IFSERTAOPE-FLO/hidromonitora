<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $estrela = $_POST['estrela'];
    $comentario = $_POST['comentario'];
    $nome = $_POST['nome'];

   /* if (isset($_SESSION['email'])) {
        $usuario = $_SESSION['email'];
    } else {
        echo "Usuário não autenticado.";
        exit();
    }*/
    // Conexão ao banco de dados (exemplo usando MySQLi)
    $dbHost = 'localhost';
    $dbUsername = 'root';
    $dbPassword = '';
    $dbName = 'projeto';

    // Cria a conexão
    $conexao = new mysqli($dbHost, $dbUsername, $dbPassword, $dbName);

    // Verifica a conexão
    if ($conexao->connect_error) {
        die("Falha na conexão: " . $conexao->connect_error);
    }

    // Insere os dados na tabela
    $sql = "INSERT INTO feedback (estrela, comentario, nome) VALUES ('$estrela', '$comentario', '$nome')";

    if ($conexao->query($sql) === TRUE) {
        echo "Feedback enviado com sucesso!";
        header("Location: index.php");
    } else {
        echo "Erro: " . $sql . "<br>" . $conexao->error;
    }

    // Fecha a conexão
    $conexao->close();
}
?>
