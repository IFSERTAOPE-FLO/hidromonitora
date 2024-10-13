<?php 
session_start();
include_once('config.php');

if (empty($_SESSION['email']) || empty($_SESSION['senha'])) {
    header('Location: login.php');
    exit;
}

$email = $_SESSION['email'];

// Inicializando os arrays de sessão para imagens e textos
if (!isset($_SESSION['imagens'])) {
    $_SESSION['imagens'] = array_fill(0, 11, []); // 11 posições para imagens
}
if (!isset($_SESSION['textos'])) {
    $_SESSION['textos'] = array_fill(0, 5, []); // 5 posições para textos
}

if (isset($_POST['submit'])) {
    // Validação do formulário
    $autor = $email;
    $tipo = $_POST['tipo'];
    $textContent = $_POST['textContent'] ?? '';

    // Inicializando a variável de imagem
    $img = '';

    // Manipulação do upload de imagem
    if (isset($_FILES['imgUploadInput']) && $_FILES['imgUploadInput']['error'] == 0) {
        $img = time() . '_' . $_FILES['imgUploadInput']['name'];
        $uploadDir = 'uploads/';
        
        // Verifica se o diretório existe
        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0755, true); // Cria o diretório se não existir
        }

        // Verifica se o arquivo é uma imagem
        $fileType = mime_content_type($_FILES['imgUploadInput']['tmp_name']);
        if (strpos($fileType, 'image') !== false) {
            move_uploaded_file($_FILES['imgUploadInput']['tmp_name'], $uploadDir . $img);
        } else {
            echo "O arquivo enviado não é uma imagem.";
            $img = ''; // A imagem não é válida, então setamos como string vazia
        }
    }
// Armazenar informações nas variáveis correspondentes
switch ($tipo) {
    case 'img1':
        $_SESSION['imagens'][0] = $img; // Posição 0
        break;
    case 'text1':
        $_SESSION['textos'][0] = $textContent; // Posição 0
        break;
    case 'img2':
        $_SESSION['imagens'][1] = $img; // Posição 1
        break;
    case 'text2':
        $_SESSION['textos'][1] = $textContent; // Posição 1
        break;
    case 'img_bio1':
        $_SESSION['imagens'][2] = $img; // Posição 2
        break;
    case 'img_bio2':
        $_SESSION['imagens'][3] = $img; // Posição 3
        break;
    case 'img_bio3':
        $_SESSION['imagens'][4] = $img; // Posição 4
        break;
    case 'text_bio':
        $_SESSION['textos'][2] = $textContent; // Posição 2
        break;
    case 'img_amb1':
        $_SESSION['imagens'][5] = $img; // Posição 5
        break;
    case 'img_amb2':
        $_SESSION['imagens'][6] = $img; // Posição 6
        break;
    case 'img_amb3':
        $_SESSION['imagens'][7] = $img; // Posição 7
        break;
    case 'text_amb':
        $_SESSION['textos'][3] = $textContent; // Posição 3
        break;
    case 'img_etn1':
        $_SESSION['imagens'][8] = $img; // Posição 8
        break;
    case 'img_etn2':
        $_SESSION['imagens'][9] = $img; // Posição 9
        break;
    case 'img_etn3':
        $_SESSION['imagens'][10] = $img; // Posição 10
        break;
    case 'text_etn':
        $_SESSION['textos'][4] = $textContent; // Posição 4
        break;
    case 'img_tp1':
        $_SESSION['imagens'][11] = $img; // Posição 11
        break;
    case 'img_tp2':
        $_SESSION['imagens'][12] = $img; // Posição 12
        break;
    case 'img_tp3':
        $_SESSION['imagens'][13] = $img; // Posição 13
        break;
    case 'img_tp4':
        $_SESSION['imagens'][14] = $img; // Posição 14
        break;
}

    // Montar a consulta SQL
    $sql = "INSERT INTO conteudos (autor, img, texto) VALUES (?, ?, ?)";
    
    // Prepare a consulta
    $stmt = $conn->prepare($sql);
    
    // Verifica se a preparação foi bem-sucedida
    if (!$stmt) {
        die("Erro na preparação da consulta: " . $conn->error);
    }

    // Bind os parâmetros
    if (in_array($tipo, ['text1', 'text2', 'text_bio', 'text_amb', 'text_etn'])) {
        $img = ''; // Para textos, a imagem é uma string vazia
        $textContent = $textContent; // O texto pode ser vazio
    } else {
        // Para imagens, o texto é uma string vazia
        $textContent = '';
    }

    $stmt->bind_param("sss", $autor, $img, $textContent);

    // Executa a consulta
    if (!$stmt->execute()) {
        echo "Erro na inserção: " . $stmt->error;
    } else {
        $sucesso[] = '<br><div style="background: #bbffb1;color: green; font-size: 15px; border-radius: 5px; text-align: center; padding: 5px;">Conteúdo adicionado com sucesso!</div>';
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Adicionar Conteúdo</title>
    <link rel="stylesheet" href="css/form.css"> <!-- Link para o CSS -->
    <script>
        function toggleInput() {
            const tipo = document.getElementById('tipo').value;
            const textArea = document.getElementById('textArea');
            const imgUpload = document.getElementById('imgUpload');
            const textClasses = ['text1', 'text2', 'text_bio', 'text_amb', 'text_etn'];

            if (textClasses.includes(tipo)) {
                textArea.style.display = 'block';
                imgUpload.style.display = 'none';
            } else {
                textArea.style.display = 'none';
                imgUpload.style.display = 'block';
            }
        }
    </script>
</head>
<body>
    <div class="container">
        <h1>Adicionar Conteúdo</h1>
        <form action="" method="post" enctype="multipart/form-data">
            <label for="tipo">Tipo:</label>
            <select name="tipo" id="tipo" required onchange="toggleInput()">
                <option value="">Selecionar</option>
                <option value="img1">Imagem 1</option>
                <option value="text1">Texto 1</option>
                <option value="img2">Imagem 2</option>
                <option value="text2">Texto 2</option>
                <option value="img_bio1">Imagem - dados biológicos 1</option>
                <option value="img_bio2">Imagem - dados biológicos 2</option>
                <option value="img_bio3">Imagem - dados biológicos 3</option>
                <option value="text_bio">Texto - dados biológicos</option>
                <option value="img_amb1">Imagem - dados ambientais 1</option>
                <option value="img_amb2">Imagem - dados ambientais 2</option>
                <option value="img_amb3">Imagem - dados ambientais 3</option>
                <option value="text_amb">Texto - dados ambientais</option>
                <option value="img_etn1">Imagem - dados etnobiológicos 1</option>
                <option value="img_etn2">Imagem - dados etnobiológicos 2</option>
                <option value="img_etn3">Imagem - dados etnobiológicos 3</option>
                <option value="text_etn">Texto - dados etnobiológicos</option>
                <option value="img_tp1">Imagem - Trabalhos pioneiros 1</option>
                <option value="img_tp2">Imagem - Trabalhos pioneiros 2</option>
                <option value="img_tp3">Imagem - Trabalhos pioneiros 3</option>
                <option value="img_tp4">Imagem - Trabalhos pioneiros 4</option>
            </select>

            <div id="textArea" style="display:none;">
             <label for="textContent">Conteúdo do Texto:</label>
            <textarea name="textContent" id="textContent" maxlength="110"></textarea>
            <p>Máximo de 110 caracteres.</p>
            </div>

            <div id="imgUpload" style="display:none;">
                <label for="imgUploadInput">Upload de Imagem:</label>
                <input type="file" name="imgUploadInput" id="imgUploadInput">
                <br><br>
            </div>

            <button type="submit" name="submit">Enviar</button>
        </form>
    </div>
</body>
</html>

