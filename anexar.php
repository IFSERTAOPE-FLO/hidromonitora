
<?php
session_start();

if (empty($_SESSION['email']) || empty($_SESSION['senha'])) {
    header('Location: login.php');
    exit;
}

$log = true;
$email = $_SESSION['email'];

if (isset($_POST['submit'])) {
    // Validação do formulário
    $nome = htmlspecialchars($_POST['nome']);
    $descricao = htmlspecialchars($_POST['descricao']);
    $tipo = htmlspecialchars($_POST['tipo']);
    $visibilidade = htmlspecialchars($_POST['visibilidade']);
    $autor = $_SESSION['email'];
    $data_cadastro = date('Y-m-d');
    $arquivo = $_FILES["arquivo"]["tmp_name"];
    $tamanho = $_FILES["arquivo"]["size"];
    $formato = $_FILES["arquivo"]["type"];

    // Define o prefixo com base no tipo de dado
    switch ($tipo) {
        case 'biologico':
            $prefixo = 'BIO';
            break;
        case 'ambiental':
            $prefixo = 'AMB';
            break;
        case 'etnobiologico':
            $prefixo = 'ETNO';
            break;
        default:
            $prefixo = 'OUTRO';
            break;
    }

    // Gera o código automático
    $codigo = $prefixo . uniqid();

    // Conexão com o banco de dados
    $conn = new PDO("mysql:host=localhost;dbname=projeto;charset=utf8", 'root', '');
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Verificação da existência do código
   /* $stmt = $conn->prepare("SELECT * FROM tabelas WHERE codigo = ?");
    $stmt->bindParam(1, $codigo);
    $stmt->execute();
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);*/
    require_once 'model/db/SpreadsheetModel.php';
    include_once('controller/SpreadsheetController.php');
    $spreadsheetController = new SpreadsheetController();
    $result = $spreadsheetController->checkCode($codigo);

    if (count($result) == 0) {
        $errors = array();

        // Verificações do nome da tabela
        if (empty($nome)) {
            $errors['nome'] = 'O nome da tabela é obrigatório!';
        } 
        if (strlen($nome) < 3) {
            $errors['nome'] = 'O nome da tabela não pode ter menos de 3 caracteres!';
        }
        if (strlen($nome) > 15) {
            $errors['nome'] = 'O nome da tabela não pode ter mais de 15 caracteres!';
        }

        // Verificações da descrição
        if (empty($descricao)) {
            $errors['descricao'] = 'A descrição é obrigatória!';
        } 
        if (strlen($descricao) < 3) {
            $errors['descricao'] = 'A descrição não pode ter menos de 3 caracteres!';
        }
        if (strlen($descricao) > 45) {
            $errors['descricao'] = 'A descrição não pode ter mais de 30 caracteres!';
        }
        if ($arquivo != "none" && empty($errors)) {
            // Verificação do tamanho do arquivo
            if ($_FILES["arquivo"]["size"] > 209715200) { // 200MB em bytes
                $errors[] = 'O tamanho do arquivo deve ser menor que 200MB.';
            } else {
                if ($_FILES['arquivo']['type'] == 'image/jpeg' || $_FILES['arquivo']['type'] == 'image/png') {
                    // Processar imagem
                    $tamanho = $_FILES['arquivo']['size'];
                    $conteudo = file_get_contents($_FILES['arquivo']['tmp_name']);
                    $formato = $_FILES['arquivo']['type'];

                    try {
                        // Prepara e executa a inserção dos dados para imagem
                       /* $stmt = $conn->prepare("INSERT INTO spreadsheets VALUES (0, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
                        $stmt->bindParam(1, $codigo);
                        $stmt->bindParam(2, $nome);
                        $stmt->bindParam(3, $descricao);
                        $stmt->bindParam(4, $tipo);
                        $stmt->bindParam(5, $visibilidade);
                        $stmt->bindParam(6, $autor);
                        $stmt->bindParam(7, $data_cadastro);
                        $stmt->bindParam(8, $formato);
                        $stmt->bindParam(9, $tamanho, PDO::PARAM_INT);
                        $stmt->bindParam(10, $conteudo, PDO::PARAM_LOB);
                        $stmt->execute();*/
                        $spreadsheetController->createSpreadsheet($codigo, $nome, $descricao, $tipo, $visibilidade, $autor, $data_cadastro, $formato, $tamanho, $conteudo);

                        $sucesso[] = '<br><div style="background: #bbffb1;color: green; font-size: 15px; border-radius: 5px; text-align: center; padding: 5px;">Arquivo de imagem enviado com sucesso para o servidor!</div>';
                    } catch (PDOException $e) {
                        $errors[] = 'Erro: ' . $e->getMessage();
                    }
                } elseif ($_FILES['arquivo']['type'] == 'text/csv') {
                    // Processar arquivo CSV
                    $conteudo = file_get_contents($arquivo);

                    // Mapeamento dos tipos de dado para os cabeçalhos esperados
                    $tiposDadoHeader = array(
                        'biologico' => array('mine', 'worker', 'happy', 'lamp', 'oldest'),
                        'ambiental' => array('shot', 'triangle', 'plus', 'red', 'month'),
                        'etnobiologico' => array('pleasure', 'probably', 'was', 'oil', 'planned')
                    );

                    // Verificar campos vazios no arquivo CSV
                    $lines = explode("\n", $conteudo);
                    $isEmpty = false;
                    $header = str_getcsv($lines[0], ';'); // Obtém o cabeçalho da matriz CSV

                    // Obter o cabeçalho esperado para o tipo de dado atual
                    $expectedHeader = $tiposDadoHeader[$tipo];

                    // Verificar se o cabeçalho atual é igual ao cabeçalho esperado
                    if (count($header) !== count($expectedHeader) || array_diff($expectedHeader, $header)) {
                        if($tipo == 'biologico'){
                            $errors[] = 'O arquivo CSV não possui os campos de cabeçalho esperados para o tipo de dado <strong>biológico</strong>.';
                        }
                        if($tipo == 'ambiental'){
                            $errors[] = 'O arquivo CSV não possui os campos de cabeçalho esperados para o tipo de dado <strong>ambiental</strong>.';
                        }
                        if($tipo == 'etnobiologico'){
                            $errors[] = 'O arquivo CSV não possui os campos de cabeçalho esperados para o tipo de dado <strong>etnobiológico</strong>.';
                        }

                    } else {
                        foreach ($lines as $line) {
                            $fields = str_getcsv($line, ';');
                            foreach ($fields as $field) {
                                if (empty($field)) {
                                    $isEmpty = true;
                                    break 2; // Sair dos loops aninhados
                                }
                            }
                        }

                        if ($isEmpty) {
                            $errors[] = 'O arquivo CSV contém campos vazios.';
                        } else {
                            try {
                                // Prepara e executa a inserção dos dados para CSV
                               /* $stmt = $conn->prepare("INSERT INTO spreadsheets VALUES (0, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
                                $stmt->bindParam(1, $codigo);
                                $stmt->bindParam(2, $nome);
                                $stmt->bindParam(3, $descricao);
                                $stmt->bindParam(4, $tipo);
                                $stmt->bindParam(5, $visibilidade);
                                $stmt->bindParam(6, $autor);
                                $stmt->bindParam(7, $data_cadastro);
                                $stmt->bindParam(8, $formato);
                                $stmt->bindParam(9, $tamanho, PDO::PARAM_INT);
                                $stmt->bindValue(10, $conteudo, PDO::PARAM_LOB);
                                $stmt->execute();*/
                                $spreadsheetController->createSpreadsheet($codigo, $nome, $descricao, $tipo, $visibilidade, $autor, $data_cadastro, $formato, $tamanho, $conteudo);
                                echo gettype($formato) . "<br>";
                                echo gettype($tamanho) . "<br>";
                                echo gettype($conteudo) . "<br>";
                                
                                $sucesso[] = '<br><div style="background: #bbffb1;color: green; font-size: 15px; border-radius: 5px; text-align: center; padding: 5px;">Arquivo CSV enviado com sucesso para o servidor!</div>';
                            } catch (PDOException $e) {
                                $errors[] = 'Erro: ' . $e->getMessage();
                            }
                        }
                    }
                }/*elseif($_FILES['arquivo']['type'] == 'application/pdf'){
                    // Processar arquivo PDF
                    $conteudo = file_get_contents($arquivo);
                    $formato = $_FILES['arquivo']['type'];

                    try {
                        // Prepara e executa a inserção dos dados para PDF
                        $stmt = $conn->prepare("INSERT INTO tabelas VALUES (0, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
                        $stmt->bindParam(1, $codigo);
                        $stmt->bindParam(2, $nome_tabela);
                        $stmt->bindParam(3, $descricao);
                        $stmt->bindParam(4, $tipo);
                        $stmt->bindParam(5, $visibilidade);
                        $stmt->bindParam(6, $autor);
                        $stmt->bindParam(7, $dataAtual);
                        $stmt->bindParam(8, $formato);
                        $stmt->bindParam(9, $tamanho, PDO::PARAM_INT);
                        $stmt->bindValue(10, $conteudo, PDO::PARAM_LOB);
                        $stmt->execute();
                
                        $sucesso[] = '<br><div style="background: #bbffb1;color: green; font-size: 15px; border-radius: 5px; text-align: center; padding: 5px;">Arquivo PDF enviado com sucesso para o servidor!</div>';
                    } catch (PDOException $e) {
                        $errors[] = 'Erro: ' . $e->getMessage();
                    }
                }*/ else {
                    $errors[] = 'Arquivo não suportado! Somente JPEG, PNG ou CSV são aceitos.';
                }
            }
        }
    } else {
        $errors[] = 'Erro na geração do código, por favor tente novamente.';
    }

    // Limpar a variável $conn após a execução
    $conn = null;
}
?>



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
                <h1 class="heading">Anexar nova matriz</h1>
                    
                <i class="fi fi-rr-info" id="botao-modal"></i>

                <div id="modal" class="modal">
                    <div class="modal-conteudo">
                        <span class="fechar">&times;</span>
                        <h3 class = 'validacoes'>Validações</h3>
                        <ul>
                            <li>Todos os campos devem ser preenchidos.</li>
                            <li>O nome da tabela deve ter no mínimo 3 caracteres.</li>
                            <li>A descrição deve conter no máximo 30 caracteres.</li>
                            <li>Só são aceitos arquivos em formato JPEG, PNG ou CSV.</li>
                            <li>As planilhas devem seguir o modelo padrão localizado na <a href="index.php">página inicial</a>.</li>
                        </ul>
                    </div>
                </div>
            </div>
            <form action="anexar.php" method="post" enctype="multipart/form-data">
                
                <div class="inputBox <?php if (!empty($errors) && isset($errors['nome'])) echo 'invalid'; ?>" >
                    <input type="text" id="nome" name="nome"  class="inputUser" title="Nome da matriz" required>
                    <label for="nome" class="labelInput">Nome:</label>
                </div>

                <div class="inputBox <?php if (!empty($errors) && isset($errors['descricao'])) echo 'invalid'; ?>">
                    <label for="descricao">Descrição:</label>
                    <textarea id="descricao" cols="62" name="descricao" class="inputTextarea" title="Descrição abreviada da matriz (limite de XX caracteres)"></textarea><br>
                </div>
                <br><br>
                <div class="inputBox">
                    <label for="tipo">Tipo de dado:</label>
                    <input type="radio" id="tipo" name="tipo" value="biologico" required checked> Biológico
                    <input type="radio" id="tipo" name="tipo" value="ambiental" required > Ambiental
                    <input type="radio" id="tipo" name="tipo" value="etnobiologico" required> Etnobiológico
                </div>

                <div class="inputBox">
                    <label for="visibilidade">Tipo de visualização:</label>
                    <input type="radio" id="publico" name="visibilidade" value="1" required checked> Pública
                    <input type="radio" id="privado" name="visibilidade" value="0" required> Privada
                </div>    
                
                <label for="arquivo" >Anexar Matriz:</label>
                <input type="file" id="arquivo" name="arquivo"><br>
                <span class="descricaoArquivo"><strong>Arquivo não deve ser maior que 200MB.</strong></span><br><br>

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
                <input type='submit' name='submit' value='Anexar Matriz' class='btn'>
            </form>
            <a href='tabelas.php'><button class="btn reset">Voltar</button></a>
        </div>
        
        <br>
        <script src="modal.js"></script>
    </body>
</html>