<?php 
session_start();
require 'conexao.php'
?>
<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crud</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>
    <div class="container mt-4">
    <?php include('mensagem.php')?>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Textos
                        <a href="adicionar_texto.php" class="btn btn-primary float-end">Adicionar texto</a>
                        </h4>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Texto</th>
                                    <th>Ações</th>
                                </tr>
                            </thead>
                        <tbody>
                            <?php 
                            $sql = 'SELECT * FROM cruds';
                            $cruds = mysqli_query($conexao, $sql);
                            if(mysqli_num_rows($cruds) > 0){
                                foreach($cruds as $crud){
                            ?>
                            <tr>
                                <td><?=$crud['id']?></td>
                                <td><?=$crud['texto']?></td>
                               <td>
                               <a href="visualizar_texto.php?id=<?=$crud['id']?>" class="btn btn-secondary btn-sn">Visualizar</a>
                                <a href="editar_texto.php?id=<?=$crud['id']?>" class="btn btn-success btn-sn">Editar</a>
                                <form action="acoes.php" method="POST" class="d-inline">
                                <button onclick="return confirm('Tem certeza que deseja apagar o texto?')"  type="submit" name="apagar_texto" value="<?=$crud['id']?>" class="btn btn-danger btn-sn">Apagar Texto</button>
                                </form>
                                </td>
                            </tr>
                            <?php 
                                }
                            }else{
                                echo '<h5>Nenhum texto encontrado</h5';
                        }
                            ?>
                        </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>