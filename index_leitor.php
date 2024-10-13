<?php
session_start();
include_once('config.php');

if ((!isset($_SESSION['email']) == true) and (!isset($_SESSION['senha']) == true)) {
    $log = false;
    unset($_SESSION['email']);
    unset($_SESSION['senha']);
} else {
    $log = true;

}

// Verificar se as sessões de imagens e textos foram inicializadas
if (!isset($_SESSION['imagens'])) {
    $_SESSION['imagens'] = array_fill(0, 11, '');  // Preenche com 11 índices vazios
}

if (!isset($_SESSION['textos'])) {
    $_SESSION['textos'] = array_fill(0, 5, '');  // Preenche com 5 índices vazios
}

// Exemplo de como acessar os valores:
$texto1 = $_SESSION['textos'][0] ?? '';  // Texto 1
$texto2 = $_SESSION['textos'][1] ?? '';  // Texto 2
$texto_bio = $_SESSION['textos'][2] ?? '';  // Texto biológico
$texto_amb = $_SESSION['textos'][3] ?? '';  // Texto ambiental
$texto_etn = $_SESSION['textos'][4] ?? '';  // Texto etnobiológico

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
    <link rel="stylesheet" href="css/sobre.css">
    <link rel="stylesheet" type="text/css" href="css/centralizar.css"/>
    <link rel="stylesheet" href="https://unpkg.com/aos@2.3.1/dist/aos.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0" />
    
    <style>
        html, 
        body {
            position: relative;
            height: 100%;
        }

        body {
            background: #eee;
            font-family: Helvetica Neue, Helvetica, Arial, sans-serif;
            font-size: 14px;
            text-align: center;
            color: #00b3f6;
            margin: 0;
            padding: 0;
        }

        .swiper {
            width: 100%;
            padding-top: 50px;
            padding-bottom: 200px;
        }

        .swiper-slide {
            background-position: center;
            background-size: cover;
            width: 650px;
            height: 200px;
        }

        .swiper-slide img {
            display: block;
            width: 100%;
        }
    </style>
</head>
<body>
    <header>
        <nav>
            <ul class="nav-list">
                <?php
                if ($log == true) {
                    echo "<li><a href='index.php' style='border-bottom: 2px #ffffff solid;'>Início</a></li>";
                    echo "<li>
                        <div class='dropdown'>
                            <button class='dropbtn'>Portal de acesso a dados <i class='fi fi-rr-caret-down' style='color: #ffffff'></i></button>
                            <div class='dropdown-content'>
                                <a href='tabelas.php'>Todas as Matrizes</a>
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
    </header>

    <article id="idea">
        <video autoplay muted loop>
            <source src="src/video/pexels-kapaw-3586035-1280x720-25fps.mp4" type="video/mp4">
        </video>
        <div>
            <img src="src/img/05.png" width=500px></img>
        </div>
        <a href="#sectionimg1"><span style="cursor: pointer;">&#10095;</span></a>
    </article>

    <div class="sectionimg" >
    <?php
    if (!empty($_SESSION['imagens'][0])) {
    echo '<img src="uploads/' . htmlspecialchars($_SESSION['imagens'][0]) . '" alt="" width="100%" height="600px">';
    }else{
        echo '<img src="src/img/raze-dam-2283277_640.jpg" alt="" width="100%" height="600px">';
    }
    ?>
        <div class="overlay"></div>
        <div class="text">
            <h1>HIDROMONITORA</h1>
            <p><?php echo nl2br(htmlspecialchars($texto1)); ?></p>
        </div>
    </div>


    <section id="equipe">
        <h2>Sobre</h2>
        <div class="container_box">
            <input type="radio" name="dot" id="one">
            <input type="radio" name="dot" id="two">
            <div class="main-card">
                <div class="cards">
                <div class="card">
                        <div class="content">
                            <div class="details">
                                <div class="name">bla bla bla</div>
                                <div class="job">bla bla bla</div>
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="content">
                            <div class="details">
                                <div class="name">bla bla bla</div>
                                <div class="job">bla bla bla</div>
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="content">
                            <div class="details">
                                <div class="name">bla bla bla</div>
                                <div class="job">bla bla bla</div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="cards">
                    <div class="card">
                        <div class="content">
                            <div class="details">
                                <div class="name">bla bla bla</div>
                                <div class="job">bla bla bla</div>
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="content">
                            <div class="details">
                                <div class="name">bla bla bla</div>
                                <div class="job">bla bla bla</div>
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="content">
                            <div class="details">
                                <div class="name">bla bla bla</div>
                                <div class="job">bla bla bla</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="click-area">
                <label for="one" class="active one"></label>
                <label for="two" class="two"></label>
            </div>
        </div>
    </section>

    <div class="sectionimg" >
    <?php
    if (!empty($_SESSION['imagens'][1])) {
    echo '<img src="uploads/' . htmlspecialchars($_SESSION['imagens'][1]) . '" alt="" width="100%" height="600px">';
    }
    ?>
        <div class="overlay"></div>
        <div class="text">
            <h1>HIDROMONITORA</h1>
            <p><?php echo htmlspecialchars($texto2); ?></p>
        </div>
    </div>
    <section style="background: #00b3f6">
        <br><br>
        <div style="width: 100%; color: #ffffff;">
            <br>
            <h2 class='planilhas'>Planilhas Modelos</h2>
            <br>
        </div>
        <br>
        <div class="box-container">
            <div class="carousel">
            <?php
            if (!empty($_SESSION['imagens'][2])) {
             echo '<img src="uploads/' . htmlspecialchars($_SESSION['imagens'][2]) . '" alt="Imagem Biológica 1" width="100%" height="600px">';
            }else{
                echo '<img src="src/img/birds-7398763_640.jpg" alt="" width="100%" height="600px">';
            }
            if (!empty($_SESSION['imagens'][3])) {
              echo '<img src="uploads/' . htmlspecialchars($_SESSION['imagens'][3]) . '" alt="Imagem Biológica 2" width="100%" height="600px">';
            }else{
                echo '<img src="src/img/underwater-5310424_640.jpg" alt="" width="100%" height="600px">';
            }
            if (!empty($_SESSION['imagens'][4])) {
              echo '<img src="uploads/' . htmlspecialchars($_SESSION['imagens'][4]) . '" alt="Imagem Biológica 3" width="100%" height="600px">';
            }else{
                echo '<img src="src/img/animal-21668_640.jpg" alt="" width="100%" height="600px">';
            }
            ?>
            </div>
            <div class="box-text">
                <br><br>
                <h2>Dados biológicos</h2> 
                <?php 
                     echo htmlspecialchars($texto_bio); 
                ?>
                <?php if ($log == true): ?>
                    <br><br><a href="#" class="button">Download da planilha modelo  &nbsp;<i class="fa-solid fa-download"></i></a>
                <?php else: ?>
                    <br><br><a href="login.php" class="button">Faça login para ter acesso!</a>
                <?php endif; ?>
            </div>
        </div>

        <div class="box-container">
            <div class="box-text">
                <br><br>
                <h2>Dados ambientais</h2>
                <?php 
                    echo htmlspecialchars($texto_amb);
                 ?>
                <?php if ($log == true): ?>
                    <br><br><a href="#" class="button">Download da planilha modelo  &nbsp;<i class="fa-solid fa-download"></i></a>
                <?php else: ?>
                    <br><br><a href="login.php" class="button">Faça login para ter acesso!</a>
                <?php endif; ?>
            </div>
            <div class="carousel">
            <?php
            if (!empty($_SESSION['imagens'][5])) {
             echo '<img src="uploads/' . htmlspecialchars($_SESSION['imagens'][5]) . '" alt="Imagem Biológica 1" width="100%" height="600px">';
            }else{
                echo '<img src="src/img/zyro-image (1).png" alt="" width="100%" height="600px">';
            }
            if (!empty($_SESSION['imagens'][6])) {
              echo '<img src="uploads/' . htmlspecialchars($_SESSION['imagens'][6]) . '" alt="Imagem Biológica 2" width="100%" height="600px">';
            }else{
                echo '<img src="src/img/zyro-image (2).png" alt="" width="100%" height="600px">';
            }
            if (!empty($_SESSION['imagens'][7])) {
              echo '<img src="uploads/' . htmlspecialchars($_SESSION['imagens'][7]) . '" alt="Imagem Biológica 3" width="100%" height="600px">';
            }else{
                echo '<img src="src/img/zyro-image.png" alt="" width="100%" height="600px">';
            }
            ?>
            </div>
        </div>

        <div class="box-container">
            <div class="carousel">
            <?php
        if (!empty($_SESSION['imagens'][8])) {
            echo '<img src="uploads/' . htmlspecialchars($_SESSION['imagens'][8]) . '" alt="Imagem Biológica 1" width="100%" height="600px">';
           }else{
                echo '<img src="src/img/asia-1793406_640.jpg" alt="" width="100%" height="600px">';
           }
           if (!empty($_SESSION['imagens'][9])) {
             echo '<img src="uploads/' . htmlspecialchars($_SESSION['imagens'][9]) . '" alt="Imagem Biológica 2" width="100%" height="600px">';
           }else{
                echo '<img src="src/img/dois-homens-no-barco_72229-1355.avif" alt="" width="100%" height="600px">';
           }
           if (!empty($_SESSION['imagens'][10])) {
             echo '<img src="uploads/' . htmlspecialchars($_SESSION['imagens'][10]) . '" alt="Imagem Biológica 3" width="100%" height="600px">';
           }else{
                echo '<img src="src/img/WhatsApp Image 2023-03-06 at 17.58.49 (1).jpeg" alt="" width="100%" height="600px">';
           }
        ?>
            </div>
            <div class="box-text">
                <br><br>
                <h2>Dados etnobiológicos</h2>
                <?php 
                    echo htmlspecialchars($texto_etn);
                 ?>
                <?php if ($log == true): ?>
                    <br><br><a href="#" class="button">Download da planilha modelo  &nbsp;<i class="fa-solid fa-download"></i></a>
                <?php else: ?>
                    <br><br><a href="login.php" class="button">Faça login para ter acesso!</a>
                <?php endif; ?>
            </div>
        </div>
    </section>

    <h2>Trabalhos pioneiros</h2>
    <div class="swiper mySwiper">
        <div class="swiper-wrapper">
            <div class="swiper-slide">
                <?php
                if (!empty($_SESSION['imagens'][11])) {
                    echo '<img src="uploads/' . htmlspecialchars($_SESSION['imagens'][11]) . '" alt="Imagem Biológica 1" width="100%" height="350px">';
                }else{
                    echo '<img src="src/img/exemplo.png" alt="" width="100%" height="350px">';
                }
            ?>
            </div>
            <div class="swiper-slide">
                <?php
                if (!empty($_SESSION['imagens'][11])) {
                    echo '<img src="uploads/' . htmlspecialchars($_SESSION['imagens'][11]) . '" alt="Imagem Biológica 1" width="100%" height="350px">';
                }else{
                    echo '<img src="src/img/exemplo.png" alt="" width="100%" height="350px">';
                }
            ?>
            </div>
            <div class="swiper-slide">
                <?php
                if (!empty($_SESSION['imagens'][11])) {
                    echo '<img src="uploads/' . htmlspecialchars($_SESSION['imagens'][11]) . '" alt="Imagem Biológica 1" width="100%" height="350px">';
                }else{
                    echo '<img src="src/img/exemplo.png" alt="" width="100%" height="350px">';
                }
            ?>
            </div>
            <div class="swiper-slide">
                <?php
                if (!empty($_SESSION['imagens'][11])) {
                    echo '<img src="uploads/' . htmlspecialchars($_SESSION['imagens'][11]) . '" alt="Imagem Biológica 1" width="100%" height="350px">';
                }else{
                    echo '<img src="src/img/exemplo.png" alt="" width="100%" height="350px">';
                }
            ?>
            </div>
            
        </div>
        <div class="swiper-pagination"></div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    <script>
        var swiper = new Swiper(".mySwiper", {
            effect: "coverflow",
            grabCursor: true,
            centeredSlides: false,
            slidesPerView: "auto",
            coverflowEffect: {
                rotate: 30,
                stretch: 60,
                depth: 100,
                modifier: 1,
                slideShadows: true,
            },
            pagination: {
                el: ".swiper-pagination",
            },
        });
    </script>

    <section id="mapa">
        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3944.9281208750435!2d-38.583788685299396!3d-8.602899993817145!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x709f4972e3cf11b%3A0x3448f9a9fa3c6b37!2sIFSert%C3%A3oPE%20Campus%20Floresta!5e0!3m2!1spt-BR!2sbr!4v1679950120125!5m2!1spt-BR!2sbr" width="100%" height="350" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
    </section>

    <?php include "rodape.php"; ?>

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
