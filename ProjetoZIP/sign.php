<?php 

  session_start();

  $method = $_POST["METHOD"];
  $_SESSION["LOGGED"] = false;

  if($method !== "SIGN_UP" && $method !== "SIGN_IN") {
    echo '<script>window.location.href = "/"</script>';
    return;
  }

  if($method === "SIGN_UP") {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    if($_SESSION['email'] === $email) {
      echo 'E-mail ' . $email . ' já cadastrado! <br /><br /> <a href="sign-up.html">Voltar</a>';
      return;
    }

    $_SESSION['name'] = $name;
    $_SESSION['email'] = $email;
    $_SESSION['password'] = $password;
    $_SESSION['LOGGED'] = true;
    echo '<script>window.location.href = "/"</script>';
  } else {
    $email = $_POST['email'];
    $password = $_POST['password'];

    if($_SESSION['email'] !== $email) {
      echo 'E-mail não cadastrado! <br /><br /> <a href="sign-in.html">Voltar</a>';
      return;
    }

    if($_SESSION['password'] !== $password) {
      echo 'Senha incorreta! <br /><br /> <a href="sign-in.html">Voltar</a>';
      return;
    }

    $_SESSION['LOGGED'] = true;
    echo '<script>window.location.href = "/"</script>';
  }
?>