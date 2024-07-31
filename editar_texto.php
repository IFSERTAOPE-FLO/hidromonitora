<?php 
session_start();
require 'conexao.php';
?>
<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editaar</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>
    <div class="container mt--5">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Editar texto <a href="crud.php" class="btn btn-danger float-end">Voltar</a></h4>
                    </div>
                    <div class="card-body">
                        <?php 
                        if(isset($_GET['id'])){
                            $crud_id = mysqli_real_escape_string($conexao, $_GET['id']);
                            $sql = "SELECT * FROM cruds WHERE id= '$crud_id'";
                            $query= mysqli_query($conexao, $sql);

                            if(mysqli_num_rows($query)>0){
                                $crud = mysqli_fetch_array($query);
                        ?>
                        <form action="acoes.php" method="POST">
                                <input type="hidden" name="crud_id" value="<?=$crud['id']?>">
                                <div class="mb-3">
                                    <label>Texto</label>
                                    <input type="text" name="texto" value="<?=$crud['texto']?>" class="form-control">
                                </div>
                                <div class="mb-3">
                                <label>Email</label>
                                <input type="text" name="email"  value="<?=$crud['email']?>"  class="form-control">
                            </div>
                            <div class="mb-3">
                                <button type="submit" name="editar" class="btn btn-primary">Salvar Alteração</button>
                            </div>
                        </form>
                        <?php 
                         }else{
                            echo "<h5>Texto não encontrado</h5>";
                        }
                    }
                        ?>    
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>