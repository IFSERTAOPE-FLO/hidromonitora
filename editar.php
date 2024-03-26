<?php
session_start();
include_once('config.php');

if (empty($_SESSION['email']) || empty($_SESSION['senha'])) {
    header('Location: login.php');
    exit;
}

$log = true;
$email = $_SESSION['email'];

if (isset($_POST['submit'])) {
    // Validação do formulário
    $nome_tabela = htmlspecialchars($_POST['nome_tabela']);
    $descricao = htmlspecialchars($_POST['descricao']);
    $tipo = htmlspecialchars($_POST['tipo']);
    $visibilidade = htmlspecialchars($_POST['visibilidade']);
    $id = $_POST['id']; // ID da tabela a ser editada

    // Insira as informações de conexão com o banco de dados aqui
    $db_host = 'localhost';
    $db_name = 'projeto';
    $db_user = 'root';
    $db_pass = '';

    // Conexão com o banco de dados
    $conn = new mysqli($db_host, $db_user, $db_pass, $db_name);

    // Verificar conexão
    if ($conn->connect_error) {
        die('Erro na conexão: ' . $conn->connect_error);
    }

    try {
        // Atualiza os dados da tabela
        $stmt = $conn->prepare("UPDATE tabelas SET nome_tabela = ?, descricao = ?, tipo = ?, visibilidade = ? WHERE id = ?");
        $stmt->bind_param("ssssi", $nome_tabela, $descricao, $tipo, $visibilidade, $id);
        $stmt->execute();

        $sucesso[] = '<br><div style="background: #bbffb1;color: green; font-size: 15px; border-radius: 5px; text-align: center; padding: 5px;">Tabela editada com sucesso!</div>';
    } catch (Exception $e) {
        $errors[] = 'Erro: ' . $e->getMessage();
    }
}

// Obtém os dados da tabela a ser editada
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    try {
        $stmt = $conn->prepare("SELECT * FROM tabelas WHERE id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            // Dados da tabela
            $row = $result->fetch_assoc();
            $id = $row['id'];
            $nome_tabela = $row['nome_tabela'];
            $descricao = $row['descricao'];
            $tipo = $row['tipo'];
            $visibilidade = $row['visibilidade'];

            // Exibir o formulário de edição
            ?>
            <!DOCTYPE html>
            <heah>
                <title>Editar tabela</title>
                <meta http-equiv="X-UA-Compatible" content="IE=edge">
                <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0" />
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
                <div class="container2">
                    <div class="titulo">
                        <h1 class="heading">Editar tabela</h1>
                        <p class="descricao">Preencha o formulário abaixo para editar a tabela.</p>
                    </div>
                    <br><br>
                    <form method="post" action="">

                        <input type="hidden" name="id" value="<?php echo $id; ?>">

                        <div class="inputBox">
                            <input type="text" id="nome_tabela" name="nome_tabela" value="<?php echo $nome_tabela; ?>" class="inputUser" title="Nome da matriz" minlength="3" required><br><br>
                            <label for="nome_tabela" class="labelInput">Nome da Tabela:</label>
                        </div>
                      
                        <div class="inputBox">
                            <label for="descricao">Descrição:</label>
                            <textarea id="descricao" cols="62" name="descricao" title="Descrição abreviada da matriz (limite de XX caracteres)"><?php echo $descricao; ?></textarea><br><br>
                        </div>
                        <br><br>

                        <div class="inputBox">
                            <label for="tipo">Tipo de dado:</label>
                            <input type="radio" id="tipo_biologico" name="tipo" value="biologico" required <?php echo ($tipo == 'biologico') ? 'checked' : ''; ?>>
                            <label for="tipo_biologico">Biológico</label>
                            <input type="radio" id="tipo_ambiental" name="tipo" value="ambiental" required <?php echo ($tipo == 'ambiental') ? 'checked' : ''; ?>>
                            <label for="tipo_ambiental">Ambiental</label>
                            <input type="radio" id="tipo_etnobiologico" name="tipo" value="etnobiologico" required <?php echo ($tipo == 'etnobiologico') ? 'checked' : ''; ?>>
                            <label for="tipo_etnobiologico">Etnobiológico</label>
                        </div>
                        
                        <div class="inputBox">
                            <label for="visibilidade">Tipo de visualização:</label>
                            <input type="radio" id="publico" name="visibilidade" value="1" required <?php echo ($visibilidade == '1') ? 'checked' : ''; ?>>
                            <label for="publico">Pública</label>
                            <input type="radio" id="privado" name="visibilidade" value="0" required <?php echo ($visibilidade == '0') ? 'checked' : ''; ?>>
                            <label for="privado">Privada</label>
                        </div>
                        

                        <?php
                            if (!empty($errors)) {
                                echo "<div style='background: #ffa5ae;color: red; font-size: 15px; border-radius: 5px; text-align: center; padding: 5px;'>";
                                echo "<ul style='list-style: none;'>";
                                echo "<li>" . reset($errors) . "</li>";
                                echo "</ul>";
                                echo "</div>";
                            } elseif (!empty($sucesso)) {
                                echo "<div>";
                                echo "<ul style='list-style: none;'>";
                                echo "<li>" . reset($sucesso) . "</li>";
                                echo "</ul>";
                                echo "</div>";
                            }
                        ?>

                        <br>
                        <input type='submit' name='submit' value='Editar'  class='btn'>
                    </form>
                    <a href='minhas_matrizes.php'><button class="btn reset">Voltar</button></a>
                </div>
            </body>
            <?php
        } else {
            $errors[] = 'A tabela não foi encontrada.';
        }
    } catch (Exception $e) {
        $errors[] = 'Erro: ' . $e->getMessage();
    }
}

$conn->close();
?>
