<?php
//Usar dessa forma
//require_once 'controller/UserController.php';
//require_once 'model/User.php';

//$userController = new UserController();

//Criar um novo usuário
//$user = new User("John Doe", "123.456.789-00", "joho@gmail.com", "123456", "123456789", "Rua das Flores, 123", "Universidade XYZ", "Professor");
//$novoObj = $userController->createUser($user);
session_start();

$errors = array();

if (isset($_POST['submit'])) {
    include_once('config.php');

    $nome = trim($_POST['nome']);
    $cpf = trim($_POST['cpf']);
    $email = trim($_POST['email']);
    $senha = trim($_POST['senha']);
    $senhaC = trim($_POST['senhaC']);
    $telefone = trim($_POST['telefone']);
    $endereco = trim($_POST['endereco']);
    $instituicao = trim($_POST['instituicao']);
    $funcao = trim($_POST['funcao']);

    // Validação do nome
    if (empty($nome)) {
        $errors['nome'] = "O campo nome é obrigatório.";
    } elseif (strlen($nome) < 3) {
        $errors['nome'] = "O nome deve ter no mínimo 3 caracteres.";
    }

    // Validação do CPF
    if (empty($cpf)) {
        $errors['cpf'] = "O campo CPF é obrigatório.";
    } elseif (!validarCPF($cpf)) {
        $errors['cpf'] = "CPF inválido.";
    }

    // Validação do e-mail
    if (empty($email)) {
        $errors['email'] = "O campo e-mail é obrigatório.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors['email'] = "E-mail inválido.";
    }

    // Validação do telefone
    if (empty($telefone)) {
        $errors['telefone'] = "O campo telefone é obrigatório.";
    } elseif (!validarTelefone($telefone)) {
        $errors['telefone'] = "Telefone inválido.";
    }

    // Validação do endereço
    if (empty($endereco)) {
        $errors['endereco'] = "O campo endereço é obrigatório.";
    } elseif (strlen($endereco) < 3) {
        $errors['endereco'] = "O endereço deve ter no mínimo 3 caracteres.";
    }

    // Validação da instituição
    if (empty($instituicao)) {
        $errors['instituicao'] = "O campo instituição é obrigatório.";
    } elseif (strlen($instituicao) < 3) {
        $errors['instituicao'] = "A instituição deve ter no mínimo 3 caracteres.";
    }

    // Validação da senha
    if (empty($senha)) {
        $errors['senha'] = "O campo senha é obrigatório.";
    } elseif (strlen($senha) < 6) {
        $errors['senha'] = "A senha deve ter no mínimo 6 caracteres.";
    }

    // Verificar se as senhas são iguais
    if ($senha !== $senhaC) {
        $errors['senhaC'] = "As senhas devem ser iguais.";
    }

    // Verificar se houve erros de validação
    if (empty($errors)) {
        // Realizar a inserção no banco de dados
        $stmt = $conn->prepare("SELECT * FROM cadastro WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $resultEmail = $stmt->get_result();

        $stmt = $conn->prepare("SELECT * FROM cadastro WHERE cpf = ?");
        $stmt->bind_param("s", $cpf);
        $stmt->execute();
        $resultCpf = $stmt->get_result();

        if ($resultEmail->num_rows > 0) {
            $errors['email'] = "Email já registrado.";
        } elseif ($resultCpf->num_rows > 0) {
            $errors['cpf'] = "CPF já registrado.";
        } else {
            // Realizar a inserção no banco de dados
            $hashedSenha = password_hash($senha, PASSWORD_DEFAULT);
            $stmt = $conn->prepare("INSERT INTO cadastro (nome, cpf, senha, email, telefone, endereco, instituicao, funcao) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
            $stmt->bind_param("ssssssss", $nome, $cpf, $hashedSenha, $email, $telefone, $endereco, $instituicao, $funcao);
            $result = $stmt->execute();

            if ($result) {
                $sucesso[] = '<br><div style="background: #bbffb1;color: green; font-size: 15px; border-radius: 5px; text-align: center; padding: 5px;">Cadastro efetuado com sucesso! Vá para a tela de <a href="login.php">login<a> e entre na sua conta.</div>';
            } else {
                $errors['cadastro'] = "Ocorreu um erro ao cadastrar o usuário.";
            }
        }
    }
} elseif (isset($_POST['reset'])) {
    $errors = array();
    unset($_SESSION['errors']);
    session_destroy();
}


function validarCPF($cpf) {
    // Remover pontos e traço
    $cpf = preg_replace('/[^0-9]/', '', $cpf);

    // Verificar se possui 11 dígitos
    if (strlen($cpf) !== 11) {
        return false;
    }

    // Verificar se todos os dígitos são iguais
    if (preg_match('/^([0-9])\1*$/', $cpf)) {
        return false;
    }

    // Calcular o primeiro dígito verificador
    $soma = 0;
    for ($i = 0; $i < 9; $i++) {
        $soma += (int)$cpf[$i] * (10 - $i);
    }
    $digito1 = ($soma % 11 < 2) ? 0 : 11 - ($soma % 11);

    // Calcular o segundo dígito verificador
    $soma = 0;
    for ($i = 0; $i < 10; $i++) {
        $soma += (int)$cpf[$i] * (11 - $i);
    }
    $digito2 = ($soma % 11 < 2) ? 0 : 11 - ($soma % 11);

    // Verificar se os dígitos calculados são iguais aos dígitos informados
    if ($cpf[9] != $digito1 || $cpf[10] != $digito2) {
        return false;
    }

    return true;
}

function validarTelefone($telefone) {
    return preg_match('/^\([0-9]{2}\) [0-9]{5}-[0-9]{4}$/', $telefone);
}

?>



<!DOCTYPE html>
<html lang="pt-br">
    <head>
		<meta charset="UTF-8">
		<title>Cadastro</title>
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0" />
        <link rel="stylesheet" type="text/css" href="css/centralizar.css"/>
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
                <img src="img/06.png" class="logo"  style="width: 247.5px; height: 237.7px; left: 20%;"></img>
            </div>
            <div class="container2">
                <div class="titulo">
                    <h1 class="heading">Cadastre-se</h1>
                    
                    <i class="fi fi-rr-info" id="botao-modal"></i>

                    <div id="modal" class="modal">
                        <div class="modal-conteudo">
                            <span class="fechar">&times;</span>
                            <h3 class = 'validacoesCadastro'>Validações</h3>
                            <ul>
                                <li>Todos os campos devem ser preenchidos.</li>
                                <li>O nome deve ter no mínimo 3 caracteres.</li>
                                <li>O CPF deve conter 11 números.</li>
                                <li>O número de telefone deve estar no formato: (99) 99999-9999.</li>
                                <li>A senha deve ter no mínimo 6 caracteres.</li>
                                <li>O endereço deve ter no mínimo 3 caracteres.</li>
                                <li>A instituição deve ter no mínimo 3 caracteres.</li>
                            </ul>
                        </div>
                    </div>
                </div>
                
                <form name="form" id="form" method="post" action="cadastro.php">
                    <div class="inputs">     			  
                        <div class="inputBox <?php if (!empty($errors) && isset($errors['nome'])) echo 'invalid'; ?>">
                            <input type="text" name="nome" id="nome" class="inputUser" value="<?php echo isset($_POST['nome']) ? htmlspecialchars($_POST['nome']) : ''; ?>" required>
                            <label for="nome" class="labelInput"><i class="fi fi-rr-user"></i> &nbsp;Nome completo</label>   
                        </div>

                        <div class="inputBox <?php if (!empty($errors) && isset($errors['email'])) echo 'invalid'; ?>">
                            <input type="email" name="email" id="email" class="inputUser" value="<?php echo isset($_POST['email']) ? htmlspecialchars($_POST['email']) : ''; ?>" required>
                            <label for="email" class="labelInput"><i class="fi fi-rr-envelope"></i> &nbsp;Email</label>
                        </div>
                        
                        <div class="inputBox <?php if (!empty($errors) && isset($errors['cpf'])) echo 'invalid'; ?>">
                            <input type="text" maxlength="14" name="cpf" id="cpf" class="inputUser" value="<?php echo isset($_POST['cpf']) ? htmlspecialchars($_POST['cpf']) : ''; ?>" required>
                            <label for="cpf" class="labelInput"><i class="fi fi-rr-id-card-clip-alt"></i> &nbsp;CPF</label>
                        </div>

                        <div class="inputBox <?php if (!empty($errors) && isset($errors['endereco'])) echo 'invalid'; ?>">
                            <input type="text" name="endereco" id="endereco" class="inputUser" value="<?php echo isset($_POST['endereco']) ? htmlspecialchars($_POST['endereco']) : ''; ?>" required>
                            <label for="endereco" class="labelInput"><i class="fi fi-rr-map-marker-home"></i> &nbsp;Endereço</label>
                        </div>

                        <div class="inputBox <?php if (!empty($errors) && isset($errors['instituicao'])) echo 'invalid'; ?>">
                            <input type="text" name="instituicao" id="instituicao" class="inputUser" value="<?php echo isset($_POST['instituicao']) ? htmlspecialchars($_POST['instituicao']) : ''; ?>" required>
                            <label for="instituicao" class="labelInput"><i class="fi fi-rr-school"></i> &nbsp;Instituição</label>
                        </div>

                        <div class="inputBox <?php if (!empty($errors) && isset($errors['telefone'])) echo 'invalid'; ?>">
                            <input type="tel" maxlength="15" name="telefone" id="telefone" class="inputUser" value="<?php echo isset($_POST['telefone']) ? htmlspecialchars($_POST['telefone']) : ''; ?>" required>
                            <label for="telefone" class="labelInput"><i class="fi fi-rr-phone-flip"></i> &nbsp;Celular</label>
                        </div>

                        <div class="inputBox <?php if (!empty($errors) && isset($errors['funcao'])) echo 'invalid'; ?>">
                            <label for="funcao" class="labelInput"><i class="fi fi-rr-graduation-cap"></i> &nbsp;Função</label>
                            <br>
                            <select name="funcao" id="funcao" >
                                <option <?php echo (isset($_POST['funcao']) && $_POST['funcao'] == 'Professor/Pesquisador') ? 'selected' : ''; ?>>Professor/Pesquisador</option>
                                <option <?php echo (isset($_POST['funcao']) && $_POST['funcao'] == 'Estudante de pós-graduação') ? 'selected' : ''; ?>>Estudante de pós-graduação</option>
                                <option <?php echo (isset($_POST['funcao']) && $_POST['funcao'] == 'Pesquisador de pós-doutorado/DCTR') ? 'selected' : ''; ?>>Pesquisador de pós-doutorado/DCTR</option>
                                <option <?php echo (isset($_POST['funcao']) && $_POST['funcao'] == 'Profissional de agências gestoras') ? 'selected' : ''; ?>>Profissional de agências gestoras</option>
                            </select>    
                        </div>
                        
                        <div class="inputBox <?php if (!empty($errors) && isset($errors['senha'])) echo 'invalid'; ?>">
                            <input type="password" name="senha" id="senha" class="inputUser" required>
                            <label for="senha" class="labelInput"><i class="fi fi-rr-lock"></i> &nbsp;Senha</label>
                        </div>

                        <div class="inputBox <?php if (!empty($errors) && isset($errors['senhaC'])) echo 'invalid'; ?>">
                            <input type="password" name="senhaC" id="senhaC" class="inputUser" required>
                            <label for="senhaC" class="labelInput"><i class="fi fi-rr-lock"></i> &nbsp;Confirmar senha</label>
                        </div>

                    </div>
                    
                    <br><br>

                    <?php
                        if (!empty($errors)) {
                            echo "<div style='background: #ffa5ae;color: red; font-size: 15px; border-radius: 5px; text-align: center; padding: 5px;'>";
                            echo "<ul style='list-style: none;'>";
                            echo "<li>" . reset($errors) . "</li>";
                            echo "</ul>";
                            echo "</div>";
                        } elseif (!empty($sucesso)) {
                            echo "<div>";
                            echo "<ul style='list-style: none;'>";
                            echo "<li>" . reset($sucesso) . "</li>";
                            echo "</ul>";
                            echo "</div>";
                        }
                    ?>
                    <div>
                        <input type="submit" name="submit" class="btn" value="Solicitar Acesso" onclick="ValidateEmail(document.form.email);">
                        <input type="submit" name="reset" class="btn reset" value="Limpar" onclick="resetForm()">
                    </div>

                    <p class="text">
                        Já possui uma conta? 
                        <a href="login.php">Entrar</a>
                    </p>  
                    
                </form>
            </div>
        </div>
        
      
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
        <script type="text/javascript">
            $(document).ready(function() {
                // Máscara de CPF
                $('#cpf').on('input', function() {
                var cpf = $(this).val();
                cpf = cpf.replace(/\D/g, ''); // Remove tudo que não é dígito
                cpf = cpf.replace(/(\d{3})(\d)/, '$1.$2'); // Coloca um ponto após os primeiros 3 dígitos
                cpf = cpf.replace(/(\d{3})(\d)/, '$1.$2'); // Coloca um ponto após os próximos 3 dígitos
                cpf = cpf.replace(/(\d{3})(\d{1,2})$/, '$1-$2'); // Coloca um traço após os últimos 2 dígitos
                $(this).val(cpf);
                });

                // Máscara de telefone
                $('#telefone').on('input', function() {
                var telefone = $(this).val();
                telefone = telefone.replace(/\D/g, ''); // Remove tudo que não é dígito
                telefone = telefone.replace(/^(\d{2})(\d)/g, '($1) $2'); // Coloca parênteses em volta dos primeiros 2 dígitos
                telefone = telefone.replace(/(\d)(\d{4})$/, '$1-$2'); // Coloca um traço após os últimos 4 dígitos
                $(this).val(telefone);
                });
            });
        </script>
        <script>
            function resetForm() {
                var form = $('#form');
                
                // Remove os valores dos inputs
                form.find('input[type=text], input[type=email], input[type=tel], input[type=password]').val('');
                
                // Remove a classe 'invalid' dos divs que a contêm
                form.find('.invalid').removeClass('invalid');
            }
        </script>
        <script src="modal.js"></script>
								
    </body>
</html>
