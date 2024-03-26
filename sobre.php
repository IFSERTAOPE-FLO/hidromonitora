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
	<title>Sobre</title>
	<style>
    @import url('https://fonts.googleapis.com/css2?family=Roboto&display=swap');
  </style>
	<link rel="stylesheet" href="css/index.css">
  <link rel="stylesheet" href="css/sobre.css">
  <link rel='stylesheet' href='https://cdn-uicons.flaticon.com/uicons-regular-rounded/css/uicons-regular-rounded.css'>
  <link rel="stylesheet" href="https://unpkg.com/aos@2.3.1/dist/aos.css">
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
                    echo "<li><a href='index.php'>Inicio</a></li>";
                    echo "<li><a href='sobre.php'  style='border-bottom: 2px #ffffff solid;'>Sobre</a></li>";
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
        <video autoplay muted loop class="dark-overlay">
          <source src="img/pexels-kapaw-3586035-1280x720-25fps.mp4" type="video/mp4">
          </video>
        <div>
          <h4>Bem Vindo a</h4>
          <h3>HIDROMONITORA</h3>
          <p>Descubra, compartilhe e monitore ecossistemas aquáticos - A plataforma de gestão de recursos hídricos.</p>
        </div>
        <a href="#info-1">
            <span style="cursor: pointer;">&#10095;</span>
        </a>
    </article>

    <div class="container" style="background-image: url(https://img.freepik.com/fotos-gratis/bela-paisagem-de-um-rio-cercado-por-muito-verde-em-uma-floresta_181624-40482.jpg?w=1060&t=st=1685023001~exp=1685023601~hmac=eda1ebe1e16a3493986f545234c1b8fce12be6ef9a95870ac10f04810d9cea79);">
        <h1>Mountain Star Zlatibor</h1>
        <p>Zlatibor is a mountain of exceptional beauty whose special geographical properties have made this mountain a real gem of western Serbia.</p>
        <a href="#">Learn more</a>
    </div>

    <div class="blank" style="background: linear-gradient(90deg, rgba(34,130,215,1) 48%, rgba(0,212,255,1) 100%);">
            <section class="card-section">
                <div class="cards" data-aos="fade-up" data-aos-anchor-placement="top-center">
                    <article class="information [ card ]">
                        <span class="tag">Feature</span>
                        <h2 class="title">Never miss your important meetings</h2>
                        <p class="info">Elemenatary tracks all the events for the day as you scheduled and you will never have to worry.</p>
                        <button class="button">
                            <span>Learn more</span>
                            <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 0 24 24" width="24px" fill="none">
                                <path d="M0 0h24v24H0V0z" fill="none" />
                                <path d="M16.01 11H4v2h12.01v3L20 12l-3.99-4v3z" fill="currentColor" />
                            </svg>
                        </button>
                    </article>
                </div>

                <div class="cards" data-aos="fade-up" data-aos-anchor-placement="top-center">
                    <article class="information [ card ]">
                        <span class="tag">Feature</span>
                        <h2 class="title">Never miss your important meetings</h2>
                        <p class="info">Elemenatary tracks all the events for the day as you scheduled and you will never have to worry.</p>
                        <button class="button">
                            <span>Learn more</span>
                            <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 0 24 24" width="24px" fill="none">
                                <path d="M0 0h24v24H0V0z" fill="none" />
                                <path d="M16.01 11H4v2h12.01v3L20 12l-3.99-4v3z" fill="currentColor" />
                            </svg>
                        </button>
                    </article>
                </div>

                <div class="cards" data-aos="fade-up" data-aos-anchor-placement="top-center">
                    <article class="information [ card ]">
                        <span class="tag">Feature</span>
                        <h2 class="title">Never miss your important meetings</h2>
                        <p class="info">Elemenatary tracks all the events for the day as you scheduled and you will never have to worry.</p>
                        <button class="button">
                            <span>Learn more</span>
                            <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 0 24 24" width="24px" fill="none">
                                <path d="M0 0h24v24H0V0z" fill="none" />
                                <path d="M16.01 11H4v2h12.01v3L20 12l-3.99-4v3z" fill="currentColor" />
                            </svg>
                        </button>
                    </article>
                </div>
            </section>
        </div>

        <div class="container second">
            <div class="item" data-aos="fade-up" data-aos-anchor-placement="top-center">
                <div class="img img-first"></div>
                <div class="card">
                <h3>Rock climbing</h3>
                <p>The goal is to reach the summit of a formation or the endpoint of a usually pre-defined route without falling</p>
                <a href="#">Learn more</a>
                </div>
            </div>
            <div class="item" data-aos="fade-up" data-aos-anchor-placement="top-center">
                <div class="img img-second"></div>
                <div class="card">
                <h3>Caving</h3>
                <p>Exploring underground through networks of tunnels and passageways, which can be natural or artificial.</p>
                <a href="#">Learn more</a>
                </div>
            </div>
            <div class="item" data-aos="fade-up" data-aos-anchor-placement="top-center">
                <div class="img img-third"></div>
                <div class="card">
                <h3>Parachuting</h3>
                <p>Jumping from an aeroplane and falling through the air before opening your parachute.</p>
                <a href="#">Learn more</a>
                </div>
            </div>
        </div>

    <div class="blank">
        <section>
            <h2 style="margin-left: 30px; margin-top: 30px;">Lorem ipsum</h2>
            <div class="section-content">
                <p class="text">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse dictum eros sit amet arcu venenatis, id laoreet lacus cursus. Quisque aliquam lacinia libero a feugiat. Maecenas consectetur et eros vel tincidunt. Duis feugiat lobortis est, vitae euismod nunc pellentesque vel. Integer ullamcorper ante lacus, vitae fermentum nulla fringilla quis. Praesent sit amet leo quis ex ultricies semper ut vitae tellus. Quisque purus massa, vestibulum ut enim eu, laoreet consectetur metus. Praesent augue nisl, semper eget vulputate vel, tempus eu est. In condimentum sapien at sollicitudin vulputate. Donec pretium dignissim metus, eget condimentum nibh euismod non. Nulla facilisi. Nullam quam elit, mattis id ultricies vitae, elementum ut risus. Donec finibus est in sem tempor ullamcorper.</p>
                <img class="image" src="img/menina-alegre-negocios-encaracolados-usando-oculos-removebg-preview.png" alt="Imagem">
            </div>
        </section>
    </div>

    <div class="container" style="background-image: url(https://img.freepik.com/fotos-gratis/vista-deslumbrante-sobre-o-oceano-e-as-falesias-cobertas-com-plantas-capturadas-em-lombok-indonesia_181624-8408.jpg?w=1060&t=st=1685044616~exp=1685045216~hmac=5f5c2c329bb872bf34442c98c219b57378aa170b92ad79268fe8d0d635d2c6d4);">
        <h1>Mountain Star Zlatibor</h1>
        <p>Zlatibor is a mountain of exceptional beauty whose special geographical properties have made this mountain a real gem of western Serbia.</p>
        <a href="#">Learn more</a>
    </div>

    <section id="equipe">
        <br><br>
        <h2>Nossa equipe</h2>
        <div class="container_box">
            <input type="radio" name="dot" id="one">
            <input type="radio" name="dot" id="two">
            <div class="main-card">
            <div class="cards">
                <div class="card">
                    <div class="content">
                        <div class="img">
                            <img src="img/60111.jpg" alt="">
                        </div>
                        <div class="details">
                            <div class="name">Lucas Ferreira</div>
                            <div class="job">Desenvolvedor</div>
                        </div>
                        <div class="media-icons">
                            <a href="#"><i class="fab fa-facebook-f"></i></a>
                            <a href="#"><i class="fab fa-twitter"></i></a>
                            <a href="#"><i class="fab fa-instagram"></i></a>
                            <a href="#"><i class="fab fa-youtube"></i></a>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="content">
                        <div class="img">
                            <img src="img/60111.jpg" alt="">
                        </div>
                        <div class="details">
                            <div class="name">Jasmine Carter</div>
                            <div class="job">UI Designer</div>
                        </div>
                        <div class="media-icons">
                            <a href="#"><i class="fab fa-facebook-f"></i></a>
                            <a href="#"><i class="fab fa-twitter"></i></a>
                            <a href="#"><i class="fab fa-instagram"></i></a>
                            <a href="#"><i class="fab fa-youtube"></i></a>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="content">
                    <div class="img">
                        <img src="img/60111.jpg" alt="">
                    </div>
                    <div class="details">
                        <div class="name">Justin Chung</div>
                        <div class="job">Web Devloper</div>
                    </div>
                    <div class="media-icons">
                        <a href="#"><i class="fab fa-facebook-f"></i></a>
                        <a href="#"><i class="fab fa-twitter"></i></a>
                        <a href="#"><i class="fab fa-instagram"></i></a>
                        <a href="#"><i class="fab fa-youtube"></i></a>
                    </div>
                    </div>
                </div>
            </div>
            <div class="cards">
                <div class="card">
                    <div class="content">
                        <div class="img">
                            <img src="img/60111.jpg" alt="">
                        </div>
                        <div class="details">
                            <div class="name">Appolo Reef</div>
                            <div class="job">Web Designer</div>
                        </div>
                        <div class="media-icons">
                            <a href="#"><i class="fab fa-facebook-f"></i></a>
                            <a href="#"><i class="fab fa-twitter"></i></a>
                            <a href="#"><i class="fab fa-instagram"></i></a>
                            <a href="#"><i class="fab fa-youtube"></i></a>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="content">
                        <div class="img">
                            <img src="img/60111.jpg" alt="">
                        </div>
                        <div class="details">
                            <div class="name">Adrina Calvo</div>
                            <div class="job">UI Designer</div>
                        </div>
                        <div class="media-icons">
                            <a href="#"><i class="fab fa-facebook-f"></i></a>
                            <a href="#"><i class="fab fa-twitter"></i></a>
                            <a href="#"><i class="fab fa-instagram"></i></a>
                            <a href="#"><i class="fab fa-youtube"></i></a>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="content">
                        <div class="img">
                            <img src="img/60111.jpg" alt="">
                        </div>
                        <div class="details">
                            <div class="name">Nicole Lewis</div>
                            <div class="job">Web Devloper</div>
                        </div>
                        <div class="media-icons">
                            <a href="#"><i class="fab fa-facebook-f"></i></a>
                            <a href="#"><i class="fab fa-twitter"></i></a>
                            <a href="#"><i class="fab fa-instagram"></i></a>
                            <a href="#"><i class="fab fa-youtube"></i></a>
                        </div>
                    </div>
                </div>
            </div>
            </div>
            <div class="click-area">
            <label for="one" class=" active one"></label>
            <label for="two" class="two"></label>
            </div>
        </div>
    </section>

    <div class="container" style="background-image: url(https://img.freepik.com/fotos-gratis/bela-paisagem-de-um-rio-cercado-por-muito-verde-em-uma-floresta_181624-40482.jpg?w=1060&t=st=1685023001~exp=1685023601~hmac=eda1ebe1e16a3493986f545234c1b8fce12be6ef9a95870ac10f04810d9cea79);">
        <h1>Mountain Star Zlatibor</h1>
        <p>Zlatibor is a mountain of exceptional beauty whose special geographical properties have made this mountain a real gem of western Serbia.</p>
        <a href="#">Learn more</a>
    </div>

    <div class="blank contato">
        <section id="mapa">
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3944.9281208750435!2d-38.583788685299396!3d-8.602899993817145!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x709f4972e3cf11b%3A0x3448f9a9fa3c6b37!2sIFSert%C3%A3oPE%20Campus%20Floresta!5e0!3m2!1spt-BR!2sbr!4v1679950120125!5m2!1spt-BR!2sbr" width="100%" height="450px" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
        </section>
        <section id="formcontato">
            <h2 class="heading">Fale Conosco</h2>
            <form action="sobre.php" method="POST">
              
                <div class="inputBox">
                    <label class="inputLabel" for="email">Email:</label>
                    <input class="inputUser" type="email" id="email" name="email" required>
                </div>

                <div class="inputBox">
                    <label class="inputLabel" for="assunto">Assunto:</label>
                    <input class="inputUser" type="text" id="assunto" name="assunto" required>
                </div>

                <div class="inputBox">
                    <label for="mensagem">Mensagem:</label><br>
                    <textarea id="mensagem" name="mensagem" rows="4" cols="50" required></textarea><br>
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
                        $assunto = $_POST['assunto'];
                        $mensagem = $_POST['mensagem'];

                        include_once('config.php');

                        $query = "SELECT * FROM `cadastro` WHERE email = '$email'";
                        $result = mysqli_query($conn, $query);

                        if ($result->num_rows > 0) {
                            $row = $result->fetch_assoc();
                            $nome = $row['nome'];

                            $subject = "Mensagem de contato - $assunto";
                            $message = "Olá $nome,<br>Você recebeu uma mensagem de contato:<br><br>$mensagem<br><br>Por favor, responda para o email $email.<br><br>Atenciosamente,<br>Equipe de Suporte.";

                            $mail = new PHPMailer(true);
                            try {
                                $mail->isSMTP();
                                $mail->Host = 'sandbox.smtp.mailtrap.io';
                                $mail->Port = 2525;
                                $mail->SMTPAuth = true;
                                $mail->Username = '7ff71ff4f879f9';
                                $mail->Password = 'db0611f7d1b6e7';

                                $mail->CharSet = 'UTF-8'; // Configura o conjunto de caracteres para UTF-8

                                $mail->setFrom($email);
                                $mail->addAddress('jlsflucas08@gmial.com'); // Insira o email de destino para onde a mensagem será enviada

                                $mail->isHTML(true);
                                $mail->Subject = $subject;
                                $mail->Body = $message;

                                $mail->send();

                                echo "<div style='background: #bbffb1;color: green; font-size: 15px; border-radius: 5px; text-align: center; padding: 3px;'>";
                                echo "<p>E-mail enviado com sucesso para a nossa equipe.</p>";
                                echo "</div>";
                            } catch (Exception $e) {
                                echo "<div style='background: #ffbbbb; color: red; font-size: 15px; border-radius: 5px; text-align: center; padding: 3px;'>";
                                echo "<p>Falha ao enviar o e-mail. Por favor, tente novamente mais tarde.</p>";
                                echo "</div>";
                            }
                        } else {
                            echo "<div style='background: #ffbbbb; color: red; font-size: 15px; border-radius: 5px; text-align: center; padding: 3px;'>";
                            echo "<p>Nenhum usuário encontrado com o endereço de e-mail fornecido.</p>";
                            echo "</div>";
                        }
                    }
                ?>
                
                <input class="btn" type="submit" name="submit" value="Enviar">
            </form>
        </section>
    </div> 

    <!-- rodapé -->
    <footer class="footer">
        <div class="footer__addr">
          <a href=""><img src="01.png" class="logoFooter" style="width: 80%"></img></a>        
        
          <h2>Contato</h2>
      
          <address>
            Instituto Federal<br>
            <a class="footer__btn" href="#formcontato">Email</a>
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
      <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
      <script>
        AOS.init();
      </script>

</body>
</html>
