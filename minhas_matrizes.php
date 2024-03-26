<?php
session_start();
include_once('config.php');
$email = '';
//print_r($_SESSION);
if((!isset($_SESSION['email']) == true) and (!isset($_SESSION['senha']) == true)){
    $log = false;
    unset($_SESSION['email']);
    unset($_SESSION['senha']);
    header('Location: login.php');
}
else{
    $log = true;
    $email = $_SESSION['email'];
}
//$logado = $_SESSION['email'];

//$result = $conexao->query($sql);
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Minhas matrizes</title>
        <link rel="stylesheet" type="text/css" href="css/tabelas.css"/>
        <link rel='stylesheet' href='https://cdn-uicons.flaticon.com/uicons-regular-rounded/css/uicons-regular-rounded.css'>
    </head>
    <body style="background: #ffffff">

    <header>
				<nav>
					<!-- Menu de navegação --> 
					  
						<div class="mobile-menu">
							<div class="line1"></div>
							<div class="line2"></div>
              <div class="line3"></div>
			  		</div>
			  		<ul class="nav-list">
              <?php
              if ($log == true){
			  			  echo "<li><a href='index.php'>Inicio</a></li>";
				  		  echo "<li><a href='sobre.php'>Sobre</a></li>";
							  //echo "<li><a href='tabelas.php'>Matrizes</a></li>";
				  		  echo "<li>
                <div class='dropdown' style='border-bottom: 2px #ffffff solid;'>
                  <button class='dropbtn'>Portal de acesso a dados <i class='fi fi-rr-caret-down' style='color: #ffffff;'></i></button>
                  <div class='dropdown-content'>
                    <a href='tabelas.php'>Todas as Matrizes</a>
                    <a href='#'>Minhas Matrizes</a>
                    <a href='anexar.php'>Anexar Nova Matriz</a>
                  </div>
                </div>
              </li>";
				  		  echo "<li><a href='sair.php'>Sair</a></li>";
              } else {
                echo "<li><a href='login.php'>Entrar</a></li>";
              }
              ?>
					 	</ul>
			 		</nav>
		 	</header> <!-- Fim Menu de navegação -->
        <br><br><br><br>

        <center><h1>Minhas matrizes:</h1></center> <!-- Consertar. -->

        
        <!--<div class="button-container">
          <a href="#" class="button">Biológicos</a>
          <a href="#" class="button">Ambientais</a>
          <a href="#" class="button">Etnobiológicos</a>
        </div>-->
        

        <?php
            // Conexão com o banco de dados
            include_once("config.php");

            // Listagem das tabelas
            $sql = "SELECT * FROM tabelas ORDER BY dataAtual DESC";
            $result = mysqli_query($conn, $sql);
            
          


                //$hasTable = false; // Variável que armazena se a tabela já foi exibida
                if ($result) {
                  $hasTable = false; // Define a variável como false antes do loop while
                  
                  while ($row = mysqli_fetch_assoc($result)) {
                      if ($row["autor"] == $email) {
                          if (!$hasTable) { // Exibe a tabela apenas uma vez
                              echo "<table><tr><th class='opcoes'>Opções</th><th class='codigo'>Código</th><th class='nome'>Nome da Tabela</th><th class='descricao'>Descrição</th><th class='usuario'>Autor</th><th class='tipo'>Tipo</th><th class='data'>Data</th></tr>";
                              $hasTable = true;
                          }
                          
                          // Exibe as linhas da tabela
                          echo "<tr><td>";
                          if (isset($_SESSION['email'])) {
                            echo "<a href='visualizar.php?id=" . $row["id"] . "' class='icon' style='color: black;'><i class='fi fi-rr-eye' title='Visualizar'></i></a> ";
                        
                            if ($row["visibilidade"] == 1 || $row["visibilidade"] == 0) {
                              echo "<div class='icon'><a href='#' style='color: black;' onclick='exibirModal(" . $row["id"] . ", \"editar\")'><i class='fi fi-rr-edit' title='Editar'></i></a></div>";
                              echo "<div class='icon'><a href='#' style='color: black;' onclick='exibirModal(" . $row["id"] . ", \"excluir\")'><i class='fi fi-rr-trash' title='Excluir'></i></a></div>";
                            } else {
                                echo "<div class='icon'><a href='#' style='color: black;' onclick='exibirModal(" . $row["id"] . ", \"editar\")'><i class='fi fi-rr-edit' title='Editar'></i></a></div>";
                                echo "<div class='desativado'><i class='fi fi-rr-trash' title='Opção desabilitada'></i></div>";
                            }
                        } else {
                            echo "<div class='desativado'><i class='fi fi-rr-eye' title='Opção desabilitada'></i></div>";
                            echo "<div class='desativado'><i class='fi fi-rr-edit' title='Opção desabilitada'></i></div>";
                            echo "<div class='desativado'><i class='fi fi-rr-trash' title='Opção desabilitada'></i></div>";
                        }
                        
                          echo "</td>";
                          echo "<td>".$row["codigo"]."</td><td>".$row["nome_tabela"]."</td><td>".$row["descricao"]."</td><td>".$row["autor"]."</td><td>".$row["tipo"]."</td><td>".$row["data_anexo"]."</td></tr>";
                      }
                  }
                  
                  // Verifica se a variável $hasTable ainda é false e exibe a mensagem de acordo
                  if (!$hasTable) {
                      echo "<br><br><center><p>Você ainda não adicionou nenhuma matriz!</p></center><br><br><br><br>";
                  } else {
                      echo "</table>";
                  }
              }
              
            
        ?>
        
        <!-- Modal de confirmação -->
        <div id="modal-confirmacao" class="modal">
            <div class="modal-content">
                <p>Deseja continuar com a ação?</p>
                <div class="botoes">
                    <a id="confirmar-link" class="button" href="#">Confirmar</a>
                    <button id="cancelar-btn">Cancelar</button>
                </div>
            </div>
        </div>
        

        <br><br>
        <!-- rodapé -->
        <footer class="footer">
          <div class="footer__addr">
            <a href=""><img src="01.png" class="logoFooter" style="width: 80%"></img></a>        
          
            <h2>Contato</h2>
        
            <address>
              Instituto Federal<br>
              <a class="footer__btn" href="">Email</a>
            </address>
          </div>
      
          <ul class="footer__nav">
            <li class="nav__item">
              <h2 class="nav__title">Mídia</h2>

              <ul class="nav__ul">
                <li>
                  <a href="#">Link</a>
                </li>

                <li>
                  <a href="#">Link</a>
                </li>
                
                <li>
                  <a href="#">Link</a>
                </li>
              </ul>
            </li>
        
            <li class="nav__item nav__item--extra">
              <h2 class="nav__title">Tecnologias</h2>
          
              <ul class="nav__ul nav__ul--extra">
                <li>
                  <a href="#">Link</a>
                </li>
            
                <li>
                  <a href="#">Link</a>
                </li>
            
                <li>
                  <a href="#">Link</a>
                </li>
            
                <li>
                  <a href="#">Link</a>
                </li>
            
                <li>
                  <a href="#">Link</a>
                </li>
            
                <li>
                  <a href="#">Link</a>
                </li>
              </ul>
            </li>
        
            <li class="nav__item">
              <h2 class="nav__title">Legal</h2>
          
              <ul class="nav__ul">
                <li>
                  <a href="#">Política de Privacidade</a>
                </li>
            
                <li>
                  <a href="#">Termos de Uso</a>
                </li>
            
              </ul>
            </li>

          </ul>


          <ul class="footer__nav">
            <li class="nav__item nav__item--extra">
              <h2 class="nav__title">Parceiros e Apoio</h2>
          
              <ul class="nav__ul nav__ul--extra">
                <li>
                  <span>Agência financiadora:</span>
                  <a href=""><img src="img/facepe.png" alt="FACEPE" style="width: 80%"></img></a>
                </li>

                <br>
            
                <li>
                  <span>Instituição executora:</span>
                  <a href=""><img src="img/ifsertaope.png" alt="IFSERTAOPE" title="IFSERTAOPE" style="width: 80%"></img></a>
                </li>

                <br>

                <li>
                  <span>Instituições parceiras:</span>
                  <a href=""><img src="img/ifpe.png" alt="IFPE" style="width: 49%;"></img></a>
                  <a href=""><img src="img/uepb.png" alt="UEPB" style="width: 49%;"></img></a>
                </li>

                <li>
                  <span>Apoio logístico:</span><br>
                  <a href=""><img src="img/leaq.png" alt="LEAq" style="width: 50%;"></img></a>
                  <a href=""><img src="img/leb.png" alt="LEB" style="width: 30%;"></img></a>
                </li>
                
                <br>

                <li>
                  <span>PPG's envolvidos:</span>
                  <a href=""><img src="img/PPGEC.webp" alt="PPGEC" style="width: 80%"></img></a>
                </li>

              </ul>
            </li>
          </ul>
      
          <div class="legal">
            <p>&copy; 2023. Todos os Direitos Reservados.</p>
          </div>
        </footer>

        <script>
            // Função para exibir o modal de confirmação
            function exibirModal(id, acao) {
                var modal = document.getElementById('modal-confirmacao');
                var confirmarLink = document.getElementById('confirmar-link');
                var cancelarBtn = document.getElementById('cancelar-btn');

                // Configurar o link de confirmação com a ação apropriada (download ou exclusão)
                confirmarLink.href = acao + '.php?id=' + id;

                // Exibir o modal
                modal.style.display = 'block';

                // Fechar o modal ao clicar no botão "Cancelar"
                cancelarBtn.onclick = function () {
                    modal.style.display = 'none';
                };

                // Fechar o modal ao clicar em qualquer lugar fora dele
                window.onclick = function (event) {
                    if (event.target == modal) {
                        modal.style.display = 'none';
                    }
                };
            }
        </script>
      
      <script>
        class MobileNavbar {
          constructor(mobileMenu, navList, navLinks) {
            this.mobileMenu = document.querySelector(mobileMenu);
            this.navList = document.querySelector(navList);
            this.navLinks = document.querySelectorAll(navLinks);
            this.activeClass = "active";
              
            this.handleClick = this.handleClick.bind(this);
          }
            
          animateLinks() {
            this.navLinks.forEach((link, index) => {
              link.style.animation
              ? (link.style.animation = "")
              : (link.style.animation = `navLinkFade 0.5s ease forwards ${
                index / 7 + 0.3
              }s`);
            });
          }
            
          handleClick() {
            this.navList.classList.toggle(this.activeClass);
            this.mobileMenu.classList.toggle(this.activeClass);
            this.animateLinks();
          }

          addClickEvent() {
            this.mobileMenu.addEventListener("click", this.handleClick);
          }
              
          init() {
            if (this.mobileMenu) {
            this.addClickEvent();
          }
          return this;
          }
        }
        const mobileNavbar = new MobileNavbar(
          ".mobile-menu",
          ".nav-list",
          ".nav-list li",
        );
        mobileNavbar.init();
      </script>
      <script>
            var checkList = document.getElementById('list1');
            checkList.getElementsByClassName('anchor')[0].onclick = function(evt) {
            if (checkList.classList.contains('visible'))
                checkList.classList.remove('visible');
            else
                checkList.classList.add('visible');
            }
        </script>
      
  </body>
</html>