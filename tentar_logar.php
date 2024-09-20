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
		<!--<style>
      @import url('https://fonts.googleapis.com/css2?family=Roboto&display=swap');

      *{
        margin: 0;
        padding: 0;
        font-family:'Poppins', sans-serif;
      }
      header{
        background: transparent;
        backdrop-filter: blur(6px);
        -webkit-backdrop-filter: blur(6px);
        transition: background-color 0.3s;
        position:fixed;
        top: 0;
        left: 0;
        right: 0;
        z-index: 9999;
      }
      header:hover{
        background-color: rgba(2, 116, 240, 1);
      }
      a{
        color: #ffffff;
        text-decoration: none;
        transition: 0.1s;
      }
      header a:hover{
        opacity: 0.7;
        border-bottom: #ffffff solid 2px;
      }
      nav{
        display: flex;
        justify-content: space-around;
        align-items: center;
        font-family: system-ui, -apple-system, Helvetica, Arial, sans-serif;
        height: 8vh;
      }
      .dropdown{
        position: relative;
        display: inline-block;
      }
      .dropbtn{
        background-color: transparent;
        color: #ffffff;
        font-size: 16px;
        border: none;
        cursor: pointer;
        padding: 0;
      }
      .dropdown-content{
        display: none;
        position: absolute;
        background-color: rgba(2, 116, 240, 1);
        width: 327px;
        z-index: 1;
        border-radius: 5px;
        padding: 16px 0 0 0;
        text-align: center;
      }
      .dropdown-content a{
        color: #ffffff;
        padding: 8px 16px;
        text-decoration: none;
        display: block;
      }
      .dropdown-content a:hover{
        background-color: #ffffff;
        color: rgba(2, 116, 240, 1);
      }
      .dropdown:hover .dropdown-content{
    display: block;
      }
      .nav-list{
        list-style: none;
        display: flex;
        align-items: center;
      }
      .nav-list li,
      .dropbtn{
        letter-spacing: 3px;
        margin-left: 32px;
        padding-right: 32px;
      }
      article#idea div *{
        color: #ffffff;
        letter-spacing: 15px;
      }
      article#idea div h3{
        font-size: 2.5em;
        font-weight: 100;
      }
      article#idea div h1{
        font-size: 4em;
        font-weight: 400;
      }
      article#idea div h2{
        font-size: 3em;
        font-weight: 100;
      }
      article#idea div p{
        letter-spacing: 1px;
        font-size: 13px;
        line-height: 1.55;
        max-width: 60%;
        display:block;
        margin: 2rem auto;
      }
      article video{
        width: 100%;
        height: 100%;
        position: absolute;
        top: 0;
        left: 0;
        object-fit: cover;
        z-index: -1;
        filter: brightness(40%);
      }
      article span{
        rotate: 90deg;
        color: #ffffff;
        cursor: default;
        user-select: none;
      }
      article#idea span{
        position: absolute;
        bottom: 3rem;
        left: 50%;
        transform: translateX(-50%);
      }
      .sectionimg{
        position: relative;
        background-size: cover;
        background-position: center;
        height: 600px;
      }
      .sectionimg .overlay{
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color:rgba(0, 0, 0, 0.6) ;
      }
      .sectionimg .text{
        position: absolute;
        top: 50%;
        left: 20px;
        transform: translateY(-50%);
        color: white;
        font-size: 24px;
      }
      .infos{
        margin: 0 0 60px 0;
      }
      .caroussel{
        position: relative;
        width: 80%;
        margin-left: 10%;
        height: 300px;
        overflow: hidden;
      }
      .caroussel-images {
      position: absolute;
      width: 300%;
      height: 100%;
      left: 0;
      top: 0;
      }
      .caroussel-images img {
        width: 33.333%;
        height: 100%;
      }
      .caroussel-images img:not(:first-child) {
        display: none;
      }
      .caroussel-buttons {
        position: absolute;
        bottom: 10px;
        left: 50%;
        transform: translateX(-50%);
      }
      .caroussel-buttons button {
        display: inline-block;
        width: 10px;
        height: 10px;
        border-radius: 50%;
        border: none;
        margin: 0 5px;
        background-color: #ccc;
        cursor: pointer;
      }
      .caroussel-buttons button.active {
        background-color: #000;
      }
      .carousel {
        width: 50%;
        height: 400px;
        overflow: hidden;
        position: relative;
      }
      .carousel img {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        opacity: 0;
        transition: opacity 1s ease-in-out;
      }
      .carousel img.active {
        opacity: 1;
      }
      .text-container h1{
        font-size: 4rem;
        margin: 0 0 1rem;
      }
      .text-container p{
        font-size: 2rem;
        margin: 0;
      }
      .box-container{
        display: flex;
        flex-direction: row;
        justify-content: center;
        align-items: center;
        margin: 0 25px 15px;
      }
      .box-image{
        width: 50%;
        height: 400px;
      }
      .box-image img{
        width: 100%;
        height: 400px;
      }
      .box-text, .box-text-erro{
        width: 50%;/*alterado*/
        height: 400px;
        background: #ffffff;
        color:rgb(73, 73, 73);
        font-size: 15px;
        text-align: center;
      }
      .box-text h2, p{
        margin: 20px;
      }
      .button{
        background-color:#0038d6d9;
        border: none;
        border-radius: 5px;
        color: #ffffff;
        cursor: pointer;
        font-size: 16px;
        padding: 8px 16px;
        margin-left: 5px;
      }
      .button:hover{
        background-color: #0038d6d9;
      }
      .img-container{
        position: relative;
        width: 100%;
        height: 500px;
        margin: 0 auto;
        background-color: #f5f5f5;
      }
      .image-top{
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 50%;
        object-fit: cover;
      }
      .image-bottom{
        position: absolute;
        bottom: 0;
        left: 0;
        width: 100%;
        height: 50%;
        object-fit: cover;
      }
      .text-overlay{
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        text-align: center;
        color: #fff;
        font-size: 2rem;
        font-weight: bold;
        text-shadow: 2px 2px #000;
      }
      section{
        display: flexbox; /*alterado*/
        flex-wrap: wrap;
      }
      .box{
        text-align: center;
        flex: 1 1 350px;
        margin: 5% 2%;
        padding: 15px;
        border-radius: 20px;
        background: #00b3f6;
        color: #fff;
        box-shadow: rgba(0, 0, 0, 0.471) 0px 5px 15px;
      }
      .icon{
        width: 5em;
        height: 5em;
      }
      .footer > *{
        flex:1 100%;
      }
      .footer__addr{
        margin-right: 1.2em;
        margin-bottom: 2em;
      }
      .footer__addr h2{
        margin-top: 1.3em;
        font-size: 15px;
        font-weight: 400;
      }
      .nav__item{
        align-items: center;
      }
      .nav__title{
        font-weight: 400;
        font-size: 15px;
      }
      .footer address{
        font-style: normal;
        color: #ffffff;
      }
      .footer__btn, .footer__btn2{
        display: flex;
        align-items: center;
        justify-content: center;
        height: 36px;
        max-width: max-content;
        background-color:rgb(255, 255, 255);
        border-radius: 20px;
        color: #000000;
        line-height: 0;
        margin: 0.6em auto;
        font-size: 1rem;
        padding: 0 2em;
      }
      .footer__btn2{
        background: linear-gradient(to right, #0038d6d9, #005bd6d9);
        color: #ffffff;
      }
      .footer__btn:hover{
        background: #1d5370;
        color: #ffffff;
        transition: 0.5s;
      }
      .footer ul{
        list-style: none;
        padding-left: 0;
      }
      .footer li{
        line-height: 2em;
      }
      .footer a{
        text-decoration: none;
      }
      .footer__nav{
        display: flex;
        flex-flow: row wrap;
      }
      .footer__nav > *{
        flex: 1 50%;
        margin-right: 1.25em;
      }
      .nav__ul a{
        color: #ffffff;
      }
      .nav__ul--extra{
        column-count: 2;
        column-gap: 1.25em;
      }
      .legal{
        display: flex;
        flex-wrap: wrap;
        color: #ffffff;
        padding: 0 auto;
      }
      .legal p{
        margin: 0 auto;
      }
      @media screen and (min-width: 24.375em){
        .legal .legal__links{
          margin-left: auto;
        }
      }
      @media screen and (min-width: 40.375em){
        .footer__nav > *{
          flex: 1;
        }
      
      .nav__item--extra{
        flex-grow: 2;
      }
      .footer__addr{
        flex: 1 0px;
      }
      .footer__nav{
        flex: 2 0px;
      }
    }
    </style>-->
    <!--<style>
      @import url('https://fonts.googleapis.com/css2?family=Poppins&display=swap');
* {
    margin: 0;
    padding: 0;
    font-family: 'Poppins', sans-serif;
}
header {
    background: transparent; /* Alterado para transparente */
    backdrop-filter: blur(6px);
    -webkit-backdrop-filter: blur(6px);
    transition: background-color 0.3s; /* Adicionado uma transição de cor de fundo */
    position: fixed;
    top: 0;
    left: 0;
    right: 0;
    z-index: 9999;
}

header:hover {
    background-color: rgba(2, 116, 240, 1); /* Mudança de cor para azul quando o mouse passa por cima */
}

a {
    color: #ffffff;
    text-decoration: none;
    transition: 0.1s;
}

header a:hover {
    opacity: 0.7;
    border-bottom: #ffffff solid 2px;
}

nav {
    display: flex;
    justify-content: space-around;
    align-items: center;
    font-family: system-ui, -apple-system, Helvetica, Arial, sans-serif;
    height: 8vh;
}

.dropdown {
    position: relative;
    display: inline-block;
}

.dropbtn {
    background-color: transparent;
    color: #ffffff;
    font-size: 16px;
    border: none;
    cursor: pointer;
    padding: 0;
}

.dropdown-content {
    display: none;
    position: absolute;
    background-color: rgba(2, 116, 240, 1);
    width: 327px;
    z-index: 1;
    border-radius: 5px;
    padding: 16px 0 0 0;
    text-align: center;
}

.dropdown-content a {
    color: #ffffff;
    padding: 8px 16px;
    text-decoration: none;
    display: block;
}

.dropdown-content a:hover {
    background-color: #ffffff;
    color: rgba(2, 116, 240, 1);
}

.dropdown:hover .dropdown-content {
    display: block;
}

.nav-list {
    list-style: none;
    display: flex;
    align-items: center;
}

.nav-list li,
.dropbtn {
    letter-spacing: 3px;
    margin-left: 32px;
    padding-right: 32px;
}

article#idea {
    display: flex;
    justify-content: center;
    align-items: center;
    min-height: 100vh;
    text-align: center;
}
  
article#idea div * {
    color: #ffffff;
    letter-spacing: 15px;
}
  
article#idea div h3 {
    font-size: 2.5em;
    font-weight: 100;
}
  
article#idea div h1 {
    font-size: 4em;
    font-weight: 400;
}
  
article#idea div h2 {
    font-size: 3em;
    font-weight: 100;
}
  
article#idea div p {
    letter-spacing: 1px;
    font-size: 13px;
    line-height: 1.55;
    max-width: 60%;
    display: block;
    margin: 2rem auto;
}
  
article video {
    width: 100%;
    height: 100%;
    position: absolute;
    top: 0;
    left: 0;
    object-fit: cover;
    z-index: -1;
    filter: brightness(40%);
}
article span {
    rotate: 90deg;
    color: #ffffff;
    cursor: default;
    user-select: none;
}
  
article#idea span {
    position: absolute;
    bottom: 3rem;
    left: 50%;
    transform: translateX(-50%);
}
.sectionimg {
    position: relative;
    background-size: cover;
    background-position: center;
    height: 600px;
}

.sectionimg .overlay {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0, 0, 0, 0.6); /* Adicione transparência à cor de fundo para escurecer a imagem */
}

.sectionimg .text {
    position: absolute;
    top: 50%;
    left: 20px;
    transform: translateY(-50%);
    color: white;
    font-size: 24px;
}

.infos{
    margin: 0 0 60px 0;
}

.caroussel {
    position: relative;
    width: 80%;
    margin-left: 10%;
    height: 300px;
    overflow: hidden;
}
.caroussel-images {
    position: absolute;
    width: 300%;
    height: 100%;
    left: 0;
    top: 0;
}
.caroussel-images img {
    
    width: 33.333%;
    height: 100%;
}
.caroussel-images img:not(:first-child) {
    display: none;
}
  .caroussel-buttons {
    position: absolute;
    bottom: 10px;
    left: 50%;
    transform: translateX(-50%);
  }
  .caroussel-buttons button {
    display: inline-block;
    width: 10px;
    height: 10px;
    border-radius: 50%;
    border: none;
    margin: 0 5px;
    background-color: #ccc;
    cursor: pointer;
  }
  .caroussel-buttons button.active {
    background-color: #000;
  }
  

.carousel {
    width: 50%;
    height: 400px;
    overflow: hidden;
    position: relative;
  }
  
  .carousel img {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    opacity: 0;
    transition: opacity 1s ease-in-out;
  }
  
  .carousel img.active {
    opacity: 1;
  }
  
  
.text-container h1 {
    font-size: 4rem;
    margin: 0 0 1rem;
}
  
.text-container p {
    font-size: 2rem;
    margin: 0;
}

.box-container {
    display: flex;
    flex-direction: row;
    justify-content: center;
    align-items: center;
    margin: 0 25px 15px;
    box-shadow: rgba(0, 0, 0, 0.471) 0px 5px 15px;
}

.box-image {
    width: 50%;
    height: 400px;
}
  
.box-image img{
    width: 100%;
    height: 400px;
}
.box-image video{
    width: 50%;
    height: 400px;
}
  
.box-text, .box-text-erro {
    width: 50%; /*alterado*/
    height: 400px;
    background: #ffffff;
    color: rgb(73, 73, 73);
    font-size: 15px;
    text-align: center;
}

  
.box-text h2, p {
    margin: 20px;
}

.button {
    background-color: #0038d6d9;
    border: none;
    border-radius: 5px;
    color: #ffffff;
    cursor: pointer;
    font-size: 16px;
    padding: 8px 16px;
    margin-left: 5px;
}
  
.button:hover {
    background-color: #0038d6d9;
}
  

.img-container {
    position: relative;
    width: 100%;
    height: 500px;
    margin: 0 auto;
    background-color: #f5f5f5;
}
.image-top {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 50%;
    object-fit: cover;
}
.image-bottom {
    position: absolute;
    bottom: 0;
    left: 0;
    width: 100%;
    height: 50%;
    object-fit: cover;
}
.text-overlay {
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    text-align: center;
    color: #fff;
    font-size: 2rem;
    font-weight: bold;
    text-shadow: 2px 2px #000;
}

/* Seção */
section{
    display: flexbox; /*alterado*/
    flex-wrap: wrap;
}
.box{
    text-align: center;
    flex: 1 1 350px;
    margin: 5% 2%;
    padding: 15px;
    border-radius: 20px;
    background: #00b3f6;
    color: #fff;
    box-shadow: rgba(0, 0, 0, 0.471) 0px 5px 15px;
}
.icon {  
    width: 5em;
    height: 5em;
}


/* Rodapé */
.footer {
    display: flex;
    flex-flow: row wrap;
    padding: 30px 50px 20px 50px;
    color: #fff;
    background-color: #0274f0;
    border-top: 1px solid #e5e5e5;
    text-align: center;
}

.footer > * {
    flex:  1 100%;
}
.footer__addr {
    margin-right: 1.2em;
    margin-bottom: 2em;
}

.footer__addr h2 {
    margin-top: 1.3em;
    font-size: 15px;
    font-weight: 400;
}
.nav__item{
    align-items: center;
}
.nav__title {
    font-weight: 400;
    font-size: 15px;
}

.footer address {
    font-style: normal;
    color: #ffffff;
}

.footer__btn, .footer__btn2 {
    display: flex;
    align-items: center;
    justify-content: center;
    height: 36px;
    max-width: max-content;
    background-color: rgb(255, 255, 255);
    border-radius: 20px;
    color: #000000;
    line-height: 0;
    margin: 0.6em auto;
    font-size: 1rem;
    padding: 0 2em;
}
.footer__btn2{
    background: linear-gradient(to right, #0038d6d9, #005bd6d9);
    color: #ffffff;
}
.footer__btn:hover{
    background: #1d5370;
    color: #ffffff;
    transition: 0.5s;
}
.footer ul {
    list-style: none;
    padding-left: 0;
}

.footer li {
    line-height: 2em;
}

.footer a {
    text-decoration: none;
}

.footer__nav {
    display: flex;
    flex-flow: row wrap;
}

.footer__nav > * {
    flex: 1 50%;
    margin-right: 1.25em;
    
}
.nav__ul a {
    color: #ffffff;
}

.nav__ul--extra {
    column-count: 2;
    column-gap: 1.25em;
}

.legal {
    display: flex;
    flex-wrap: wrap;
    color: #ffffff;
    padding: 0 auto;
}
.legal p{
    margin: 0 auto;
}

@media screen and (min-width: 24.375em) {
    .legal .legal__links {
        margin-left: auto;
    }
}

@media screen and (min-width: 40.375em) {
    .footer__nav > * {
        flex: 1;
    }

    .nav__item--extra {
        flex-grow: 2;
    }

    .footer__addr {
        flex: 1 0px;
    }

    .footer__nav {
        flex: 2 0px;
    }
}-->

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
                    echo "<li><a href='index.php'  style='border-bottom: 2px #ffffff solid;'>Início</a></li>";
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
          <source src="src/video/img/pexels-kapaw-3586035-1280x720-25fps.mp4" type="video/mp4">
        </video>
        <div>
          <img src="img/05.png" width=500px></img>
        </div>
        <a href="#sectionimg1"><span style="cursor: pointer;">&#10095;</span></a>
      </article>

      <div class="sectionimg" id="sectionimg1" style="background-image: url('https://cdn.pixabay.com/photo/2017/05/04/08/08/raze-dam-2283277_640.jpg');">
        <div class="overlay"></div>
        <div class="text">
          <h1>HIDROMONITORA</h1>
          <p>Uma plataforma inovadora desenvolvida para<br> integrar, uniformizar e compartilhar informações<br> essenciais sobre os recursos hídricos do estado de<br> Pernambuco. Com o HIDROMONITORA, você terá<br> acesso a uma vasta gama de dados de múltiplas<br> naturezas, incluindo: dados biológicos, etnobiológicos<br> e ambientais.</p>
        </div>
      </div>

      <div class="sectionimg" style="background-image: url('https://cdn.pixabay.com/photo/2023/05/16/16/46/dam-7998102_640.jpg');">
        <div class="overlay"></div>
        <div class="text">
          <h1>HIDROMONITORA</h1>
          <p>A HIDROMONITORA é uma ferramenta fundamental<br> para pesquisadores, gestores ambientais, comunidades<br> locais e todos os interessados na preservação e gestão<br> sustentável dos recursos hídricos. A plataforma visa<br> promover a transparência e facilitar o acesso a informações<br> para a tomada de decisões e a implementação de<br> políticas públicas eficazes.</p>
        </div>
      </div>
      
     <!-- <section id="info-1" class="infos">
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
      </section>-->

      <section style="background: #00b3f6">
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
            echo '<br><br><h2>Dados biológicos</h2>';
            echo '<br><p>Conheça a fauna e flora das bacias hidrográficas pernambucanas</p><br>';
            if ($log == true) {
              echo '<br><br><a href="#" class="button">Download da planilha modelo  &nbsp;<i class="fa-solid fa-download"></i></a>';
            } else {
              echo '<br><br><a href="login.php" class="button">Faça login para ter acesso!</a>';
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
            echo '<br><p> Conheça os parâmetros físicos e químicos das águas com precisão.</p><br>';
            if ($log == true) {
              echo '<br><br><a href="#" class="button">Download da planilha modelo  &nbsp;<i class="fa-solid fa-download"></i></a>';
            } else {
              echo '<br><br><a href="login.php" class="button">Faça login para ter acesso!</a>';
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
            echo '<br><p>Conhecimentos tradicionais e culturais das comunidades locais sobre o uso e conservação dos recursos hídricos.</p><br>';
            if ($log == true) {
              echo '<br><br><a href="#" class="button">Download da planilha modelo  &nbsp;<i class="fa-solid fa-download"></i></a>';
            } else {
              echo '<br><br><a href="login.php" class="button">Faça login para ter acesso!</a>';
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


		 	<!--<section>
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
      </section>-->

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
