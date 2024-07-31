<?php
include 'config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'];
    $texto = $_POST['texto'];

    $sql = "UPDATE dados SET texto = ? WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("si", $texto, $id);
    $stmt->execute();

    header("Location: tabela.php");
    exit;
}

$id = $_GET['id'];
$sql = "SELECT nome, texto FROM dados WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);
$stmt->execute();
$stmt->bind_result($nome, $texto);
$stmt->fetch();

$stmt->close();
$conn->close();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Editar Texto</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }
        label, textarea, input {
            display: block;
            margin-bottom: 10px;
        }
        textarea {
            width: 85%;
            padding: 10px;
        }
        input[type="submit"] {
            background-color: #007BFF;
            color: white;
            border: none;
            padding: 10px 20px;
            cursor: pointer;
        }
        input[type="submit"]:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>

<h1>Editar Texto para <?php echo $nome; ?></h1>
<form method="post" action="editar_texto.php">
    <input type="hidden" name="id" value="<?php echo $id; ?>">
    <label for="texto">Texto:</label>
    <textarea name="texto" rows="4"><?php echo $texto; ?></textarea>
    <input type="submit" value="Salvar">
</form>

<a href="tabela.php">Voltar para a Tabela</a>

</body>
</html>
