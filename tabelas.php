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
        <title>Matrizes</title>
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
                    <a href='minhas_matrizes.php'>Minhas Matrizes</a>
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

        <center><h1>Matrizes:</h1></center>

        
        <!--<div class="button-container">
          <a href="#" class="button">Biológicos</a>
          <a href="#" class="button">Ambientais</a>
          <a href="#" class="button">Etnobiológicos</a>
        </div>-->       

        <?php
            // Conexão com o banco de dados
            include_once("config.php");

            if (!$conn) {
                die("Conexão falhou: " . mysqli_connect_error());
            }

            // Definir as opções de filtragem em um array associativo com as categorias como chave e as opções como valores
            $options = [
                'Tipo' => [
                    'todos' => 'Todos os dados',
                    'biologico' => 'Dados biológicos',
                    'ambiental' => 'Dados ambientais',
                    'etnobiologico' => 'Dados etnobiológicos'
                ],
                'Visibilidade' => [
                    'todos' => 'Todos',
                    '1' => 'Visíveis',
                    '0' => 'Desabilitados'
                ]
            ];

            echo "<br><br><form method='get'>";
            echo "<select name='filtro' id='filtro' style='text-align: center;'>";

            // Loop através do array associativo para criar as opções agrupadas
            foreach ($options as $category => $values) {
                echo "<optgroup label='$category'>";
                foreach ($values as $value => $label) {
                    $selected = isset($_GET['filtro']) && $_GET['filtro'] === $value ? 'selected' : '';
                    echo "<option value='$value' $selected>$label</option>";
                }
                echo "</optgroup>";
            }

            echo "</select>";
            echo "<button type='submit' class='button'>Filtrar</button>";
            echo "</form>";

            // Verifica se o formulário foi enviado
            if (isset($_GET['filtro'])) {
                $filtro = $_GET['filtro'];

                // Realizar a lógica de filtragem aqui com base no valor selecionado em $filtro
                if ($filtro === 'todos') {
                    $filtroSQL = '';
                } elseif ($filtro === 'biologico') {
                    $filtroSQL = "WHERE tipo = 'biologico'";
                } elseif ($filtro === 'ambiental') {
                    $filtroSQL = "WHERE tipo = 'ambiental'";
                } elseif ($filtro === 'etnobiologico') {
                    $filtroSQL = "WHERE tipo = 'etnobiologico'";
                } elseif ($filtro === '1') {
                    $filtroSQL = "WHERE visibilidade = 1";
                } elseif ($filtro === '0') {
                    $filtroSQL = "WHERE visibilidade = 0";
                } else {
                    // Opção inválida selecionada
                    $filtroSQL = '';
                }
            } else {
                $filtroSQL = '';
                $filtro = '';
            }

            // Definir o número de itens por página
            $itensPorPagina = 10;

            // Número máximo de páginas a serem exibidas antes de mostrar os "..."
            $maxPaginasVisiveis = 5; // Ajuste este valor conforme necessário

            // Obtenha o número total de registros
            $sqlContagem = "SELECT COUNT(*) as total FROM tabelas " . $filtroSQL;
            $resultContagem = mysqli_query($conn, $sqlContagem);
            $rowContagem = mysqli_fetch_assoc($resultContagem);
            $totalRegistros = $rowContagem['total'];

            // Calcule o número total de páginas
            $totalPaginas = ceil($totalRegistros / $itensPorPagina);

            // Obtenha o número da página atual
            $paginaAtual = isset($_GET['pagina']) ? $_GET['pagina'] : 1;
            if ($paginaAtual < 1) {
                $paginaAtual = 1;
            } elseif ($paginaAtual > $totalPaginas) {
                $paginaAtual = $totalPaginas;
            }

            // Calcule o deslocamento (offset) para a consulta SQL
            $offset = ($paginaAtual - 1) * $itensPorPagina;

            // Consulta SQL para buscar os registros, ordenados pela coluna "data_anexo" (mais antigos primeiro)
            $sql = "SELECT * FROM tabelas " . $filtroSQL; //. " ORDER BY data_anexo DESC LIMIT $itensPorPagina OFFSET $offset";
            $result = mysqli_query($conn, $sql);

            if (mysqli_num_rows($result) > 0) {
                // Código HTML para a tabela
                echo "<table><div class='tbl-header'><tr><th class='opcoes'>Opções</th><th class='codigo'>Código</th><th class='nome'>Nome da Tabela</th><th class='descricao'>Descrição</th><th class='usuario'>Autor</th><th class='tipo'>Tipo</th><th class='data'>Data</th></tr></div>";

                while ($row = mysqli_fetch_assoc($result)) {
                      echo "<tr><td>";
                      if (isset($_SESSION['email'])) {
                        echo "<a href='visualizar.php?id=".$row["id"]."' class='icon' style='color: black;'><i class='fi fi-rr-eye' title='Visualizar'></i></a>";
                        if ($row["autor"] == $email && ($row["visibilidade"] == 1 || $row["visibilidade"] == 0)) {
                          echo "<div class='icon'><a href='#' style='color: black;' onclick='exibirModal(" . $row["id"] . ", \"download\")'><i class='fi fi-rr-file-download' title='Download'></i></a></div>";
                          echo "<div class='icon'><a href='#' style='color: black;' onclick='exibirModal(" . $row["id"] . ", \"excluir\")'><i class='fi fi-rr-trash' title='Excluir'></i></a></div>";
                        } elseif ($row["autor"] != $email && $row["visibilidade"] == 1) {
                          echo "<div class='icon'><a href='#' style='color: black;' onclick='exibirModal(" . $row["id"] . ", \"download\")'><i class='fi fi-rr-file-download' title='Download'></i></a></div>";
                          echo "<div class='desativado'><i class='fi fi-rr-trash' title='Opção desabilitada'></i></div>";
                        } elseif ($row["autor"] != $email && $row["visibilidade"] == 0) {
                          echo "<div class='desativado'><i class='fi fi-rr-file-download' title='Opção desabilitada'></i></div>";
                          echo "<div class='desativado'><i class='fi fi-rr-trash' title='Opção desabilitada'></i></div>";
                        }
                      } else {
                        echo "<div class='desativado'><i class='fi fi-rr-eye' title='Opção desabilitada'></i></div>";
                        echo "<div class='desativado'><i class='fi fi-rr-file-download' title='Opção desabilitada'></i></div>";
                        echo "<div class='desativado'><i class='fi fi-rr-trash' title='Opção desabilitada'></i></div>";
                      }
                      
                      echo "</td>";
                    echo "<td>".$row["codigo"]."</td><td>".$row["nome_tabela"]."</td><td>".$row["descricao"]."</td><td>".$row["autor"]."</td><td>".$row["tipo"]."</td><td>".$row["dataAtual"]."</td></tr>";
                  }

                  echo "</table>";
              
                  
                  function exibirLinkPagina($pagina, $filtro)
                  {
                      global $filtro;
                      // Converta $_GET['pagina'] para um int porque os parâmetros $_GET são strings por padrão.
                      $current_pagina = intval($_GET['pagina'] ?? 1);

                      if ($current_pagina == $pagina) {
                          echo "<a href='?pagina=$pagina&filtro=$filtro' class='active'>$pagina</a>";
                      } else {
                          echo "<a href='?pagina=$pagina&filtro=$filtro'>$pagina</a>";
                      }
                      
                  }
              
                  // Código para mostrar os índices de página abaixo da lista
                  echo "<div class='pagination'>";
                  // Calcula o início e o fim das páginas a serem exibidas
                  $inicio = max(1, $paginaAtual - floor($maxPaginasVisiveis / 2));
                  $fim = min($totalPaginas, $inicio + $maxPaginasVisiveis - 1);
                  $inicio = max(1, $fim - $maxPaginasVisiveis + 1);
              
                  // Mostra o link para a primeira página
                  if ($inicio > 1) {
                      exibirLinkPagina(1, $filtro);
                      if ($inicio > 2) {
                          echo "<span>...</span>";
                      }
                  }
              
                  // Páginas no meio
                  for ($i = $inicio; $i <= $fim; $i++) {
                      exibirLinkPagina($i, $filtro);
                  }
              
                  // Mostra o link para a última página
                  if ($fim < $totalPaginas) {
                      if ($fim < $totalPaginas - 1) {
                          echo "<span>...</span>";
                      }
                      exibirLinkPagina($totalPaginas, $filtro);
                  }
                  echo "</div>";
              } else {
                  echo "<br><br><center><p>Nenhuma matriz encontrada</p></center>";
              }
              
              mysqli_close($conn);
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
        
        <!-- Código JavaScript -->
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
        $(window).on("load resize ", function() {
  var scrollWidth = $('.tbl-content').width() - $('.tbl-content table').width();
  $('.tbl-header').css({'padding-right':scrollWidth});
}).resize();
      </script>
      <script>
        $(".custom-select").each(function() {
          var classes = $(this).attr("class"),
              id      = $(this).attr("id"),
              name    = $(this).attr("name");
          var template =  '<div class="' + classes + '">';
              template += '<span class="custom-select-trigger">' + $(this).attr("placeholder") + '</span>';
              template += '<div class="custom-options">';
              $(this).find("option").each(function() {
                template += '<span class="custom-option ' + $(this).attr("class") + '" data-value="' + $(this).attr("value") + '">' + $(this).html() + '</span>';
              });
          template += '</div></div>';
          
          $(this).wrap('<div class="custom-select-wrapper"></div>');
          $(this).hide();
          $(this).after(template);
        });
        $(".custom-option:first-of-type").hover(function() {
          $(this).parents(".custom-options").addClass("option-hover");
        }, function() {
          $(this).parents(".custom-options").removeClass("option-hover");
        });
        $(".custom-select-trigger").on("click", function() {
          $('html').one('click',function() {
            $(".custom-select").removeClass("opened");
          });
          $(this).parents(".custom-select").toggleClass("opened");
          event.stopPropagation();
        });
        $(".custom-option").on("click", function() {
          $(this).parents(".custom-select-wrapper").find("select").val($(this).data("value"));
          $(this).parents(".custom-options").find(".custom-option").removeClass("selection");
          $(this).addClass("selection");
          $(this).parents(".custom-select").removeClass("opened");
          $(this).parents(".custom-select").find(".custom-select-trigger").text($(this).text());
        });
      </script>
  </body>
</html>