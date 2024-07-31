<?php
include 'config.php';

$id = $_GET['id'];
$sql = "SELECT nome, texto, email FROM dados WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);
$stmt->execute();
$stmt->bind_result($nome, $texto, $email);
$stmt->fetch();

$stmt->close();
$conn->close();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Visualizar Texto</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }
        h1 {
            margin-bottom: 20px;
        }
        .info {
            margin-bottom: 20px;
        }
        .info label {
            font-weight: bold;
        }
        .info p {
            margin: 5px 0;
        }
        a {
            text-decoration: none;
            color: #007BFF;
        }
        a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>

<h1>Visualizar Texto para <?php echo htmlspecialchars($nome); ?></h1>

<div class="info">
    <label for="texto">Texto:</label>
    <p><?php echo nl2br(htmlspecialchars($texto)); ?></p>
</div>

<div class="info">
    <label for="email">Email:</label>
    <p><?php echo htmlspecialchars($email); ?></p>
</div>

<a href="tabela.php">Voltar para a Tabela</a>

</body>
</html>
