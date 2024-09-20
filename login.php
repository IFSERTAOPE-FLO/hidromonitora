<?php
    /*session_start();
    // print_r($_REQUEST);
    if(isset($_POST['submit']) && !empty($_POST['email']) && !empty($_POST['senha']))
    {
        // Acessa
        include_once('config.php');
        $email = $_POST['email'];
        $senha = $_POST['senha'];

        // print_r('Email: ' . $email);
        // print_r('<br>');
        // print_r('Senha: ' . $senha);

        $sql = "SELECT * FROM cadastro WHERE email = '$email' and senha = '$senha'";

        $result = $conexao->query($sql);

        // print_r($sql);
        // print_r($result);

        if(mysqli_num_rows($result) < 1)
        {
            echo"<script language='javascript' type='text/javascript'>
          alert('Dados invalidos!');window.location
          .href='login.php'</script>";
            unset($_SESSION['email']);
            unset($_SESSION['senha']);
            //header('Location: login.php');
        }
        else
        {
            $_SESSION['email'] = $email;
            $_SESSION['senha'] = $senha;
            header('Location: index.php');
        }
    }
    else
    {
        // Não acessa
        /*echo"<script language='javascript' type='text/javascript'>
          alert('Preencha os campos!');window.location
          .href='login.php'</script>";*/
        //header('Location: login.php');
    //}
?>
<!doctype html>
<html lang="pt-br">
	<head>
		<title>Login</title>
		<meta charset="utf-8"/>
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0" />
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

        <div class="box">
            <div class="banner">
                <img src="src/img/06.png" class="logo" style="width: 260.5px; height: 250.7px;"></img>
            </div>
            <div class="container">
                <form method="post" action="login.php">
                        <p class="heading">Entrar</p>
                        
                        <div class="inputBox">
                            <input type="email" name="email" id="email" class="inputUser" required>
                            <label for="email" class="labelInput"><i class="fi fi-rr-envelope"></i> &nbsp; Email</label>
                        </div>
                        
                        <div class="inputBox">
                            <input type="password" name="senha" id="senha" class="inputUser" required>
                            <label for="senha" class="labelInput"><i class="fi fi-rr-lock"></i> &nbsp; Senha</label>
                        </div>
                        
                        
                        <?php
                            session_start();

                            // Verifica se o formulário foi submetido e se os campos de email e senha não estão vazios
                            if (isset($_POST['submit']) && !empty($_POST['email']) && !empty($_POST['senha'])) {
                                include_once('config.php');

                                $email = $_POST['email'];
                                $senha = $_POST['senha'];

                                include_once("controller/UserController.php");

                                $userController = new UserController();

                                // Verifica se o email existe no banco de dados                              
                                if (!$userController->verifiedEmailAndCPF($email)) {
                                    // Exibe mensagem de erro
                                    echo "<div style='background: #ffa5ae;color: red; font-size: 15px; border-radius: 5px; text-align: center; padding: 5px;'>";
                                    echo "<p>Email não encontrado!</p>";
                                    echo "</div>";
                                } else {

                                    if ($userController->verifiedEmailAndPassword($email, $senha)) {
                                        // Define variáveis de sessão e redireciona para index.php
                                        $_SESSION['email'] = $email;
                                        $_SESSION['senha'] = $senha;
                                        header('Location: index.php');
                                        exit;
                                    } else {
                                        // Exibe mensagem de erro
                                        echo "<div style='background: #ffa5ae;color: red; font-size: 15px; border-radius: 5px; text-align: center; padding: 5px;'>";
                                        echo "<p>Senha incorreta!</p>";
                                        echo "</div>";
                                    }
                                }
                            }
                        ?>

                        <input type="submit" name="submit" class="btn">
                </form>
                                                    
                
                <p class="text">
                    <a href="esqueceu_senha.php">Esqueceu a sua senha?</a>
                </p>
                <p class="text">
                    Não possui uma conta?
                    <a href="cadastro.php">Cadastre-se</a>
                </p>
            </div>
        </div>
    </body>
</html>