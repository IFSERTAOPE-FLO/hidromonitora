<?php
    include_once('config.php');

    session_start();
    
    // Verifica se o usuário está autenticado
    if (!isset($_SESSION['email'])) {
        // Redireciona o usuário para a página de login ou exibe uma mensagem de acesso não autorizado
        header('Location: login.php');
        exit;
    }
    
    // Obtém o ID do registro que será excluído
    if (isset($_GET['id'])) {
        $id = mysqli_real_escape_string($conn, $_GET['id']);
    
        // Query SQL para obter as informações da tabela com base no ID
        $sql = "SELECT * FROM tabelas WHERE id = $id";
        $result = mysqli_query($conn, $sql);
    
        if (mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
    
            // Verifica se o usuário autenticado é o autor da tabela ou se é um administrador com permissão para exclusão
            if ($row['autor'] == $_SESSION['email']) {
                // Query SQL para excluir o registro com o ID especificado
                $deleteSql = "DELETE FROM tabelas WHERE id = $id";
    
                // Executa a query SQL de exclusão
                if (mysqli_query($conn, $deleteSql)) {
                    echo "A tabela foi excluída com sucesso!";
                } else {
                    echo "Erro ao excluir a tabela: " . mysqli_error($conn);
                }
            } else {
                echo "Você não tem permissão para excluir esta tabela.";
            }
        } else {
            echo "Tabela não encontrada.";
        }
    } else {
        echo "ID da tabela não especificado.";
    }
    
?>
