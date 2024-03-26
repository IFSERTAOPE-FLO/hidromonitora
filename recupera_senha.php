<?php
    
?>
<!doctype html>
<html lang="pt-br">
	<head>
		<title>Esqueci a senha</title>
		<meta charset="utf-8"/>
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0" />
		<link rel="stylesheet" type="text/css" href="formulario.css"/>							
	</head>
	<body>
		<div class="container">
            <form method="post" action="esqueceu_senha.php">
					<p class="heading">Recupere a sua senha</p>
					<br>

                    <p>Insira seu CPF. Sua nova senha será os seis primeiros números do seu CPF!</p>
                    <br><br>

					<div class="inputBox">
                        <input type="text" name="cpf" id="cpf" class="inputUser" required>
                        <label for="cpf" class="labelInput">CPF</label>
                    </div>
                    <br><br>
				
					<input type="submit" name="submit" class="btn">
                    <br><br>
                    
            </form>
			<a href='login.php'><button class="btn reset">Cancelar</button></a>
			<br>

		</div>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.11/jquery.mask.min.js"></script>
        <script type="text/javascript">
            $("#cpf").mask("000.000.000-00");
        </script>
    </body>
</html>