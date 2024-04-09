<?php
    session_start();
    include_once('config.php');
    //print_r($_SESSION);
    if((!isset($_SESSION['email']) == true) and (!isset($_SESSION['senha']) == true)){
        $log = false;
        unset($_SESSION['email']);
        unset($_SESSION['senha']);
        //header('Location: login.php');
    }
    else{
        $log = true;
    }
    //$logado = $_SESSION['email'];

    //$result = $conexao->query($sql);
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
		<meta charset="UTF-8">
		<title>Página Inicial</title>
		<style>
      @import url('https://fonts.googleapis.com/css2?family=Roboto&display=swap');
    </style>
    <link rel='stylesheet' href='https://cdn-uicons.flaticon.com/uicons-regular-rounded/css/uicons-regular-rounded.css'>
		<link rel="stylesheet" href="css/index.css">
    <link rel="stylesheet" type="text/css" href="css/centralizar.css"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0" />
</head>
<body>
    <header>
        <nav>
            <!-- Menu de navegação -->
            <ul class="nav-list">
                <?php
                if ($log == true){
                    echo "<li><a href='index.php'  style='border-bottom: 2px #ffffff solid;'>Inicio</a></li>";
                    echo "<li><a href='sobre.php'>Sobre</a></li>";
                    echo "<li>
                    <div class='dropdown'>
                      <button class='dropbtn'>Portal de acesso a dados <i class='fi fi-rr-caret-down' style='color: #ffffff'></i></button>
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

      
      <article id="idea">
        <video autoplay muted loop>
          <source src="img/pexels-kapaw-3586035-1280x720-25fps.mp4" type="video/mp4">
        </video>
        <div>
          <img src="img/05.png" width=500px></img>
        </div>
        <a href="#sectionimg1"><span style="cursor: pointer;">&#10095;</span></a>
      </article>

      <div class="sectionimg" id="sectionimg1" style="background-image: url('https://cdn.pixabay.com/photo/2017/05/04/08/08/raze-dam-2283277_640.jpg');">
        <div class="overlay"></div>
        <div class="text">
          <h1>Texto sobre a imagem Hello World</h1>
          <p>Seu texto aqui</p>
        </div>
      </div>

      <div class="sectionimg" style="background-image: url('https://cdn.pixabay.com/photo/2023/05/16/16/46/dam-7998102_640.jpg');">
        <div class="overlay"></div>
        <div class="text">
          <h1>Texto sobre a imagem</h1>
          <p>Seu texto aqui</p>
        </div>
      </div>
      
      <section id="info-1" class="infos">
        <div class="caroussel">
          <div class="caroussel-images">
            <img src="img/water-921067_640.jpg">
            <img src="img/water-1018808_640.jpg">
            <img src="img/wave-1913559_640.jpg">
          </div>
          <div class="caroussel-buttons">
            <button class="active"></button>
            <button></button>
            <button></button>
          </div>
        </div>
      </section>

      <section style="background: #00b3f6;">
        <br><br>
        <div style="width: 100%; color: #ffffff;">
          <br>
          <h2 class = 'planilhas'>Planilhas Modelos</h2>
          <br>
        </div>
        <br>
        <div class="box-container">
            <div class="carousel">
              <img src="img/animal-21668_640.jpg">
              <img src="img/birds-7398763_640.jpg">
              <img src="img/underwater-5310424_640.jpg">
            </div>
            <?php
            echo '<div class="box-text">';
            echo '<br><br><h2>Dados etnobiológicos</h2>';
            echo '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus condimentum vel augue in ullamcorper. Sed eget velit a est volutpat finibus. Phasellus aliquet euismod velit, eu consequat risus suscipit nec. Fusce non pulvinar dolor, a luctus libero. Vivamus iaculis nisi eget felis fermentum ultricies. Donec viverra velit justo, in hendrerit.</p>';
            if ($log == true) {
              echo '<br><br><a href="#" class="button">Download da planilha modelo  &nbsp;<i class="fa-solid fa-download"></i></a>';
            } else {
              echo '<br><br><a href="login.php" class="button">Faça login para ter acesso</a>';
            }
            echo '</div>';
            ?>
        </div>

        <!--<div class="box-container">
          <div class="box-text">
            <h2>Sobre nós</h2>
            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus condimentum vel augue in ullamcorper. Sed eget velit a est volutpat finibus. Phasellus aliquet euismod velit, eu consequat risus suscipit nec. Fusce non pulvinar dolor, a luctus libero. Vivamus iaculis nisi eget felis fermentum ultricies. Donec viverra velit justo, in hendrerit.</p>
          </div>
          <div class="box-image">
            <video autoplay muted loop>
              <source src="1784888415.mp4" type="video/mp4">
            </video>
          </div>
          
        </div>-->

        <div class="box-container">
            <?php
            echo '<div class="box-text">';
            echo '<br><br><h2>Dados ambientais</h2>';
            echo '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus condimentum vel augue in ullamcorper. Sed eget velit a est volutpat finibus. Phasellus aliquet euismod velit, eu consequat risus suscipit nec. Fusce non pulvinar dolor, a luctus libero. Vivamus iaculis nisi eget felis fermentum ultricies. Donec viverra velit justo, in hendrerit.</p>';
            if ($log == true) {
              echo '<br><br><a href="#" class="button">Download da planilha modelo  &nbsp;<i class="fa-solid fa-download"></i></a>';
            } else {
              echo '<br><br><a href="login.php" class="button">Faça login para ter acesso</a>';
            }
            echo '</div>';
            ?>
            <div class="carousel">
                <img src="img/zyro-image.png">
                <img src="img/zyro-image (1).png">
                <img src="img/zyro-image (2).png">
            </div>
        </div>

        <div class="box-container">
            <div class="carousel">
                <img src="img/WhatsApp Image 2023-03-06 at 17.58.49 (1).jpeg">
                <img src="img/WhatsApp Image 2023-03-06 at 17.58.49.jpeg">
                <img src="img/asia-1793406_640.jpg">
            </div>
            <?php
            echo '<div class="box-text">';
            echo '<br><br><h2>Dados etnobiológicos</h2>';
            echo '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus condimentum vel augue in ullamcorper. Sed eget velit a est volutpat finibus. Phasellus aliquet euismod velit, eu consequat risus suscipit nec. Fusce non pulvinar dolor, a luctus libero. Vivamus iaculis nisi eget felis fermentum ultricies. Donec viverra velit justo, in hendrerit.</p>';
            if ($log == true) {
              echo '<br><br><a href="#" class="button">Download da planilha modelo  &nbsp;<i class="fa-solid fa-download"></i></a>';
            } else {
              echo '<br><br><a href="login.php" class="button">Faça login para ter acesso</a>';
            }
            echo '</div>';
            ?>
        </div>

        <!--<div class="box-container">
          <div class="box-image">
            <img src="img/sunset-1373171_640.jpg" alt="Descrição da imagem">
          </div>
          <div class="box-text">
            <h2>Sobre nós</h2>
            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus condimentum vel augue in ullamcorper. Sed eget velit a est volutpat finibus. Phasellus aliquet euismod velit, eu consequat risus suscipit nec. Fusce non pulvinar dolor, a luctus libero. Vivamus iaculis nisi eget felis fermentum ultricies. Donec viverra velit justo, in hendrerit.</p>
          </div>
        </div>

        <div class="img-container">
          <img class="image-top" src="img/drop-1759703_640.jpg" alt="Imagem 1">
          <img class="image-bottom" src="img/drop-3698073_640.jpg" alt="Imagem 2">
          <div class="text-overlay">
            <p>Texto</p>
          </div>
        </div>-->
        <br><br>
      </section>


		 	<section>
			  <div class="box">
			    <img src="https://cdn-icons-png.flaticon.com/512/3135/3135789.png" alt="Feito com flaticon" class="icon">
          
			    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec eu leo tortor. Nunc mauris velit, lobortis a nulla sit amet, rutrum consequat purus. Nullam egestas consectetur neque, ac bibendum sapien aliquam nec.</p>
			  </div>
			  <div class="box conteudo animar" >
			    <img src="https://cdn-icons-png.flaticon.com/512/3135/3135715.png" alt="Feito com flaticon" class="icon">
			    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec eu leo tortor. Nunc mauris velit, lobortis a nulla sit amet, rutrum consequat purus. Nullam egestas consectetur neque, ac bibendum sapien aliquam nec.</p>
			  </div>
			  <div class="box conteudo animar" >
			    <img src="https://cdn-icons-png.flaticon.com/512/476/476761.png" alt="Feito com flaticon" class="icon">
			    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec eu leo tortor. Nunc mauris velit, lobortis a nulla sit amet, rutrum consequat purus. Nullam egestas consectetur neque, ac bibendum sapien aliquam nec.</p>
			  </div>
			  <div class="box conteudo animar" >
			    <img src="https://cdn-icons-png.flaticon.com/512/3135/3135789.png" alt="Feito com flaticon" class="icon">
          
			    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec eu leo tortor. Nunc mauris velit, lobortis a nulla sit amet, rutrum consequat purus. Nullam egestas consectetur neque, ac bibendum sapien aliquam nec.</p>
			  </div>
			  <div class="box conteudo animar" >
			    <img src="https://cdn-icons-png.flaticon.com/512/3135/3135715.png" alt="Feito com flaticon" class="icon">
			    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec eu leo tortor. Nunc mauris velit, lobortis a nulla sit amet, rutrum consequat purus. Nullam egestas consectetur neque, ac bibendum sapien aliquam nec.</p>
			  </div>
			  <div class="box conteudo animar" >
			    <img src="https://cdn-icons-png.flaticon.com/512/476/476761.png" alt="Feito com flaticon" class="icon">
			    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec eu leo tortor. Nunc mauris velit, lobortis a nulla sit amet, rutrum consequat purus. Nullam egestas consectetur neque, ac bibendum sapien aliquam nec.</p>
			  </div>
      </section>

      <section id="mapa">
        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3944.9281208750435!2d-38.583788685299396!3d-8.602899993817145!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x709f4972e3cf11b%3A0x3448f9a9fa3c6b37!2sIFSert%C3%A3oPE%20Campus%20Floresta!5e0!3m2!1spt-BR!2sbr!4v1679950120125!5m2!1spt-BR!2sbr" width="100%" height="350" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
      </section>

      <!-- rodapé -->
      <?php
        include "rodape.php";
      ?>


      <script>
        var buttons = document.querySelectorAll('.caroussel-buttons button');
        var images = document.querySelectorAll('.caroussel-images img');
        var currentIndex = 0;

        for (var i = 0; i < buttons.length; i++) {
          buttons[i].addEventListener('click', function() {
            buttons[currentIndex].classList.remove('active');
            images[currentIndex].style.display = 'none';
            currentIndex = Array.from(buttons).indexOf(this);
            buttons[currentIndex].classList.add('active');
            images[currentIndex].style.display = 'block';
          });
        }
      </script>

      <script>
        function setupCarousel(carousel) {
          let carouselImages = carousel.querySelectorAll('img');
          let currentImageIndex = 0;
          let maxImageIndex = carouselImages.length - 1;

          function nextImage() {
            carouselImages[currentImageIndex].classList.remove('active');
            currentImageIndex++;
            if (currentImageIndex > maxImageIndex) {
              currentImageIndex = 0;
            }
            carouselImages[currentImageIndex].classList.add('active');
          }

          setInterval(nextImage, 3000);
        }

        let carousels = document.querySelectorAll('.carousel');
        carousels.forEach(function(carousel) {
          setupCarousel(carousel);
        });

      </script>

</body>
</html>
