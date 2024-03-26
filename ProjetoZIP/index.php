<?php
  session_start();
?>

<!DOCTYPE html>
<html lang="pt-BR">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=JetBrains+Mono:wght@100;400;500;600;700&display=swap"
      rel="stylesheet"
    />
    <link rel="stylesheet" href="static/css/style.css" />
    <link rel="shortcut icon" href="static/img/icon.png" type="image/png" />
    <title>The Callisto Protocol</title>
  </head>
  <body>
    <button id="to-top">
      <img src="static/img/arrow.svg" id="arrow" />
    </button>
    <div id="header-container">
      <header>
        <img src="static/img/icon.png" alt="JD ícone" />
      </header>
      <nav>
      <div class="mobile-menu">
							<div class="line1"></div>
							<div class="line2"></div>
              <div class="line3"></div>
			  		</div>
			  		<ul class="nav-list">
			  			<li><a href="index.php">Inicio</a></li>
				  		<li><a href="">Sobre</a></li>
							<li><a href="tabelas.php">Matrizes</a></li>
				  		<li><a href="">Upload</a></li>
				  		<li><a href="sair.php">
                <?php
                  if($log == true){
                    echo "Sair";
                  }
                  else{
                    echo "Entrar";
                  }
                ?>
              </a></li>
					 	</ul>
      </nav>
    </div>
    <article id="idea">
    <video autoplay muted loop>
          <source src="Water_101___19s___4k_res.mp4" type="video/mp4">
        </video>
      <div>
        
        <h1>HIDROMONITORA</h1>
        
        <p>
        Plataforma de compilação de dados de ecossistemas aquáticos
        </p>
      </div>
      <span>&#10095;</span>
    </article>
    <article id="more">
      <img src="WhatsApp Image 2023-03-06 at 17.58.49 (1).jpeg" />
      <span>&#10095;</span>
      <p>
        Lute para sobreviver aos horrores confinados nas paredes da Prisão de
        Ferro Negro nesta proposta imersiva da nova geração para o terror e
        sobrevivência: The Callisto Protocol.
      </p>
    </article>
    <article id="gen">
      <img id="bg" src="WhatsApp Image 2023-03-06 at 17.58.49.jpeg" />
      <div class="container">
        <h1>Disponível agora</h1>
        <p>
          Vivencie a proposta aterrorizante e imersiva da nova geração para o
          terror e sobrevivência, concebida por Glen Schofield e o time na
          Striking Distance Studios. Prepare-se para sobreviver aos pesadelos
          que assombram os corredores da Prisão de Ferro Negro e descobrir os
          segredos ocultos desse local.
        </p>
        <h4>Escolha sua plataforma</h4>
        <div>
          <button class="btn-platform">
            <span>PC</span>
          </button>
          <button class="btn-platform">
            <span>PS5</span>
          </button>
          <button class="btn-platform">
            <span>PS4</span>
          </button>
          <button class="btn-platform">
            <span>X-Box Series X/S</span>
          </button>
          <button class="btn-platform">
            <span>X-Box One</span>
          </button>
        </div>
      </div>
    </article>
    <footer>
      <div>
        <span>
          &copy; 2022 Krafton, Inc. All Rights Reserved. STRIKING DISTANCE
          STUDIOS and THE CALLISTO PROTOCOL are trademarks or service marks of
          Striking Distance Studios, Inc. KRAFTON is a registered trademark or
          service mark of KRAFTON, Inc.
        </span>
      </div>
    </footer>
    <script src="static/script/main.js"></script>
  </body>
</html>
