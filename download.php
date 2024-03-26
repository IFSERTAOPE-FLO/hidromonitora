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

if (isset($_GET['id'])) {
  include_once('config.php');

  $id = mysqli_real_escape_string($conn, $_GET['id']);

  $sql = "SELECT * FROM tabelas WHERE id = $id";

  $result = mysqli_query($conn, $sql);

  if (mysqli_num_rows($result) > 0) {
      $row = mysqli_fetch_assoc($result);

      // Verificar se o arquivo é visível para download
      if ($row['visibilidade'] == 1 || ($row['visibilidade'] == 0 && $row['autor'] == $email)) {
          if ($row['formato'] == 'image/jpeg') {
              header("Content-type: image/jpeg");
              header("Content-Length: " . $row['tamanho']);
              header("Content-Disposition: attachment; filename=matriz.jpg");
              
              // Converte o conteúdo binário para o arquivo original e envia ao navegador
              echo $row['conteudo'];
          } elseif ($row['formato'] == 'image/png') {
              header("Content-type: image/png");
              header("Content-Length: " . $row['tamanho']);
              header("Content-Disposition: attachment; filename=matriz.png");

              // Converte o conteúdo binário para o arquivo original e envia ao navegador
              echo $row['conteudo'];
          } else {

              // Define o tipo de conteúdo que será enviado ao navegador
              header('Content-Type: ' . $row['formato']);

              // Converte o conteúdo binário para o arquivo original e envia ao navegador
              echo $row['conteudo'];
          }
      } else {
          echo "Você não tem permissão para baixar este arquivo.";
      }
  } else {
      echo "Arquivo não encontrado.";
  }
}


?>