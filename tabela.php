<?php
include 'config.php';

$sql = "SELECT id, nome, texto FROM dados";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Tabela de Informações</title>´
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            padding: 10px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }
        th {
            background-color: #f2f2f2;
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

<h1>Tabela de Informações</h1>

<table>
    <tr>
        <th>ID</th>
        <th>Nome</th>
        <th>Texto</th>
        <th>Ações</th>
    </tr>
    <?php
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>{$row['id']}</td>";
            echo "<td>{$row['nome']}</td>";
            echo "<td>{$row['texto']}</td>";
            echo "<td>";
            if (!empty($row['texto'])) {
                echo "<a href='editar_texto.php?id={$row['id']}'>Editar</a> | ";
                echo "<a href='visualizar_texto.php?id={$row['id']}'>Visualizar</a> | ";
                echo "<a href='apagar_texto.php?id={$row['id']}'>Apagar</a>";
            } else {
                echo "<a href='adicionar_texto.php?id={$row['id']}'>Adicionar Texto</a>";
            }
            echo "</td>";
            echo "</tr>";
        }
    } else {
        echo "<tr><td colspan='4'>Nenhum dado encontrado</td></tr>";
    }
    ?>
</table>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>

<?php
$conn->close();
?>
