<?php

    $emailRecuperacao = $_POST['email'];
    
    $con = mysqli_connect("localhost", "root", "", "projeto");

    $result = mysqli_query($con, "SELECT * FROM `cadastro` WHERE `Email` = '{$emailRecuperacao}'");
    
    if(mysqli_num_rows($result)>0){ 
        echo 'Email existe no banco de dados.'; 
        header('Location: enviar_email.php');
    }
    else{ 
        echo 'Email não existe no banco de dados.';
    }     
?>