<?php
  session_start();
  $_SESSION['LOGGED'] = false;
  echo '<script>window.location.href = "/"</script>';
?>