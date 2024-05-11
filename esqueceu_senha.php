<?php
	
   	/*if(isset($_POST['submit']))
    {

		$email = $_POST['email'];

        include_once('config.php');

		$con = mysqli_connect("localhost", "root", "", "projeto");

		$query ="SELECT cpf FROM `cadastro` WHERE email like '$email'";

        $result = mysqli_query($con, $query);

		if ($result->num_rows > 0) {
			while($row = $result->fetch_assoc()) {
				$cpfBanco =  $row['cpf'];
				$cpfSemFormatacao= str_replace(".","",$cpfBanco);
                $novaSenha=  substr("$cpfSemFormatacao",0,6);

				$sql = "update `cadastro` set senha = '$novaSenha' where email ='$email'";
				if ($con->query($sql) === TRUE) {
					// AQUI!!!
					// msg de alterado com sucesso! pede pra usuario fazer login.
					// redireciona pra tela de login.
					$errors[] = "Senha alterada com sucesso!";
				}
			}
        }
        else{
			// AQUI!!!
            // informa que o email nao esta cadastrado | pede pra usuario fazer cadastro
			// redireciona para tela de cadastro
			$errors[] = "Email não registrado!";

        }

	//pagina pedindo o email (123@gmail.com)
	//==> SELECT cpf FROM `cadastro` WHERE email like '123@gmail.com';

	//pega o cpf retornado pelo BD, faz um corte dos 6 digitos iniciais e manda uma alteracao p banco
	//=> UPDATE `cadastro` SET `senha`='xxxx' WHERE email = '123@gmail.com';


		
	
	}*/

?>
<!doctype html>
<html lang="pt-br">
	<head>
		<title>Esqueci a senha</title>
		<meta charset="utf-8"/>
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
		<div class="container">
            <form method="post" action="esqueceu_senha.php">
					<h1 class="heading">Recupere a sua senha</h1>
					<br>

                    <p class="descricao">Insira seu email para procurar a sua conta.</p>
                    <br><br>

					<div class="inputBox">
                        <input type="email" name="email" id="email" class="inputUser" required>
                        <label for="email" class="labelInput">Email</label>
                    </div>
                    <br><br>

					<?php
						use PHPMailer\PHPMailer\PHPMailer;
						use PHPMailer\PHPMailer\Exception;

						require 'PHPMailer/src/Exception.php';
						require 'PHPMailer/src/PHPMailer.php';
						require 'PHPMailer/src/SMTP.php';

						if(isset($_POST['submit'])) {
							$email = $_POST['email'];
							include_once('config.php');
							echo '<script>document.getElementById("loading").style.display = "block";</script>';

							$query = "SELECT * FROM `cadastro` WHERE email = '$email'";
							$result = mysqli_query($conn, $query);

							if ($result->num_rows > 0) {
								$row = $result->fetch_assoc();
								$cadastro_id = $row['id'];
								$reset_token = $row['reset_token'];
								$nome = $row['nome'];

								if (empty($reset_token)) {
									// Gerar novo token
									$reset_token = uniqid();

									$token_query = "UPDATE `cadastro` SET reset_token = '$reset_token' WHERE id = '$cadastro_id'";
									if (!$conn->query($token_query)) {
										echo '<script>document.getElementById("loading").style.display = "none";</script>';
										echo "<div style='background: #ffbbbb; color: red; font-size: 15px; border-radius: 5px; text-align: center; padding: 5px;'>";
										echo "<p>Ocorreu um erro ao atualizar o token de redefinição. Por favor, tente novamente mais tarde.</p>";
										echo "</div>";
										exit;
									}
								}

								$reset_url = "<a href='http://localhost/projeto/redefinir_senha.php?token=$reset_token'>Clique aqui!</a>";
								$subject = "Solicitação de redefinição de senha";
								$message = "Olá $nome,<br>Você solicitou a redefinição de senha para a sua conta. Para continuar com o processo de redefinição, clique no link abaixo:<br>$reset_url<br>Se você não solicitou essa redefinição, ignore este email. Nenhuma alteração será feita na sua conta.
								<br>Atenciosamente,<br>
								Equipe de Suporte.
								";

								$mail = new PHPMailer(true);
								try {
									$mail->Host = 'smtp.gmail.com';
									$mail->Port = 587;
									$mail->SMTPAuth = true;
									$mail->Username = 'sabrina.ferraz@aluno.ifsertao-pe.edu.br';
									$mail->Password = 'bvhhyfyrlkxyjhvw';

									$mail->CharSet = 'UTF-8'; // Configura o conjunto de caracteres para UTF-8

									$mail->setFrom('sabrina.ferraz@aluno.ifsertao-pe.edu.br', 'Sabrina Ferraz');
									$mail->addAddress($email);
									$mail->isHTML(true);
									$mail->Subject = $subject;
									$mail->Body = $message;

									$mail->send();

									echo "<div style='background: #bbffb1;color: green; font-size: 15px; border-radius: 5px; text-align: center; padding: 5px;'>";
									echo "<p>Um e-mail foi enviado para $email com instruções adicionais.</p>";
									echo "</div>";
								} catch (Exception $e) {
									echo '<script>document.getElementById("loading").style.display = "none";</script>';
									echo "<div style='background: #ffbbbb; color: red; font-size: 15px; border-radius: 5px; text-align: center; padding: 5px;'>";
									echo "<p>Falha ao enviar o e-mail. Por favor, tente novamente mais tarde.</p>";
									echo "</div>";
								}
							} else {
								echo '<script>document.getElementById("loading").style.display = "none";</script>';
								echo "<div style='background: #ffbbbb; color: red; font-size: 15px; border-radius: 5px; text-align: center; padding: 5px;'>";
								echo "<p>Nenhum usuário encontrado com o endereço de e-mail fornecido.</p>";
								echo "</div>";
							}
						}
					?>
					<div id="loading" style="display: none;">
						<div class="spinner"></div>
					</div>
					<input type="submit" name="submit" class="btn" id="submitBtn" onclick="showLoadingAnimation()">
                    <br>
                    
            </form>
			<a href='login.php'><button class="btn reset">Cancelar</button></a>
			<br>
			
		</div>

		<script>
			function showLoadingAnimation() {
				var submitBtn = document.getElementById("submitBtn");
				var loadingDiv = document.getElementById("loading");
				
				// Oculta o botão de enviar e exibe a animação de carregamento
				submitBtn.style.display = "none";
				loadingDiv.style.display = "block";
				
				// Simula um atraso de 2 segundos para demonstração
				setTimeout(function() {
					// Exibe novamente o botão de enviar e oculta a animação de carregamento
					submitBtn.style.display = "block";
					loadingDiv.style.display = "none";
				}, 10000);
			}
        </script>
    </body>
</html>