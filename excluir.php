<!doctype html>
<html lang="pt-br">
	<head>
        <title>Anexar nova matriz</title>
		<meta charset="utf-8"/>
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0" />
        <link rel="stylesheet" type="text/css" href="css/centralizar.css"/>
		<link rel="stylesheet" type="text/css" href="css/formulario.css"/>
        <link rel='stylesheet' href='https://cdn-uicons.flaticon.com/uicons-regular-rounded/css/uicons-regular-rounded.css'>
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
        
        <!-- Formulário para anexar nova tabela -->
        <div class="container2">
            <div class="titulo">
                <h1 class="heading">Exclusão de arquivo</h1>   
            </div>
            <form action="excluir.php" method="post" enctype="multipart/form-data">
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
            </form>
            <a href='tabelas.php'><button class="btn reset">Voltar</button></a>
        </div>
        
        <br>
        <script src="modal.js"></script>
    </body>
</html>
