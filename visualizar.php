<!DOCTYPE html>
<html>
<head>
    <title>Visualização</title>
    <link rel="stylesheet" type="text/css" href="css/tabelas.css"/>
    <link rel="stylesheet" type="text/css" href="css/visualizar.css"/>
    <link rel='stylesheet' href='https://cdn-uicons.flaticon.com/uicons-regular-rounded/css/uicons-regular-rounded.css'>
</head>
<body>
    <?php
        if (isset($_GET['id'])) {
            include_once('config.php');
            
            // Obtém o formato e conteúdo da tabela com base no ID fornecido
            $sql = "SELECT id,formato,conteudo FROM tabelas WHERE id = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("i", $_GET['id']);
            $stmt->execute();
            $result = $stmt->get_result();
            $row = $result->fetch_array();

            // Verifica se o formato da tabela é uma imagem JPEG ou PNG
            if ($row['formato'] == 'image/jpeg' || $row['formato'] == 'image/png') {
                // Se for uma imagem, exibe-a
                $base64 = base64_encode($row['conteudo']);
                $src = "data:{$row['formato']};base64,{$base64}";
                echo "<img src='{$src}' />";
            } else {
                // Se for um arquivo CSV, exibe como uma tabela HTML
                $rowCounter = 0;
                if (($handle = fopen('data:text/csv;base64,' . base64_encode($row['conteudo']), 'r')) !== FALSE) {
                    // Cria um seletor de colunas para filtrar a tabela
                    echo '<label for="column-select">Mostrar colunas:</label>';
                    echo '<div class="custom-select" style="width:200px;">';
                        echo '<button id="column-button" onclick="toggleColumnSelect()">Selecionar colunas</button>';
                        echo '<div id="column-options" style="display: none;">';
                            
                        echo '</div>';
                    echo '</div>';

                    // Inicia a exibição da tabela HTML
                    echo '<div class="table-container">';
                        echo '<table id="csv-table">';

                        // Lê as linhas do arquivo CSV
                        while (($data = fgetcsv($handle, 1000, ";")) !== FALSE) {
                            echo '<tr>';
                            $num = count($data);
                            for ($c = 0; $c < $num; $c++) {
                                if ($rowCounter == 0) {
                                    // Exibe o cabeçalho da coluna
                                    echo "<th>" . htmlspecialchars($data[$c]) . "</th>";
                                    //echo '<option value="' . $c . '">' . htmlspecialchars($data[$c]) . '</option>';
                                } else {
                                    // Exibe os dados da célula
                                    echo "<td>" . htmlspecialchars($data[$c]) . "</td>";
                                }
                            }
                            echo '</tr>';
                            $rowCounter++;
                        }

                        // Fecha a tabela HTML
                        echo '</table>';
                    echo '</div>';
                    fclose($handle);
                }
            }
        }
        mysqli_close($conn);

        if ($row['formato'] == 'text/csv') {
            // Exibe o botão para download da tabela filtrada como CSV
            echo '<div class="buttons">';
            echo '<button>Botão 1</button>';
            echo '<button id="download-button">Baixar Tabela Filtrada como CSV</button>';
            echo '</div>';
        } /*else {
            // Exibe um botão de download normal
            echo '<div class="buttons">';
            echo '<button>Botão 1</button>';
            echo '<a href="download.php?id='.$row['id'].'"><button id="download-button">Baixar Arquivo</button></a>';
            echo '</div>';
        }*/
    ?>


    <!--<div class="buttons">
        <button>Botão 1</button>
         Botão para fazer o download da tabela filtrada 
        <button id="download-button">Baixar Tabela Filtrada como CSV</button>
    </div>-->

    <script>
        function toggleColumnSelect() {
            var optionsDiv = document.getElementById("column-options");
            if (optionsDiv.style.display === "none") {
                optionsDiv.style.display = "block";
                document.getElementById("column-button").textContent = "Confirmar";
            } else {
                optionsDiv.style.display = "none";
                document.getElementById("column-button").textContent = "Selecionar colunas";
                updateTable();
            }
        }

        function updateTable() {
            var table = document.getElementById("csv-table");
            var checkboxes = document.querySelectorAll("#column-options input[type='checkbox']");
            var selectedColumns = [];
            for (var i = 0; i < checkboxes.length; i++) {
                if (checkboxes[i].checked) {
                    selectedColumns.push(i);
                }
            }
            for (var i = 0, row; row = table.rows[i]; i++) {
                for (var j = 0, col; col = row.cells[j]; j++) {
                    if (selectedColumns.includes(j)) {
                        col.style.display = "";
                    } else {
                        col.style.display = "none";
                    }
                }
            }
        }

        window.addEventListener("load", function () {
            var table = document.getElementById("csv-table");
            var optionsDiv = document.getElementById("column-options");
            var headerRow = table.rows[0];
            for (var i = 0; i < headerRow.cells.length; i++) {
                var columnName = headerRow.cells[i].textContent;
                var checkbox = document.createElement("input");
                checkbox.type = "checkbox";
                checkbox.checked = true;
                checkbox.onchange = updateTable;
                optionsDiv.appendChild(checkbox);
                optionsDiv.appendChild(document.createTextNode(" " + columnName));
                optionsDiv.appendChild(document.createElement("br"));
            }

            var downloadButton = document.getElementById("download-button");
            downloadButton.addEventListener("click", downloadCSV);
        });
        
        function downloadCSV() {
            var table = document.getElementById("csv-table");
            var selectedColumns = [];
            var checkboxes = document.querySelectorAll("#column-options input[type='checkbox']");
            for (var i = 0; i < checkboxes.length; i++) {
                if (checkboxes[i].checked) {
                    selectedColumns.push(i);
                }
            }

            var csvContent = "data:text/csv;charset=utf-8,";
            for (var i = 0; i < table.rows.length; i++) {
                var rowData = [];
                for (var j = 0; j < table.rows[i].cells.length; j++) {
                    if (selectedColumns.includes(j)) {
                        rowData.push(table.rows[i].cells[j].textContent);
                    }
                }
                csvContent += rowData.join(";") + "\n";
            }

            var encodedUri = encodeURI(csvContent);
            var link = document.createElement("a");
            link.setAttribute("href", encodedUri);
            link.setAttribute("download", "tabela.csv");
            document.body.appendChild(link);
            link.click();
        }
    </script>

    


</body>
</html>
