<?php

    $dbHost = 'localhost';
    $dbUsername = 'root';
    $dbPassword = '';
    $dbName = 'projeto';
    
    $conexao = new mysqli($dbHost,$dbUsername,$dbPassword,$dbName);

     /*if($conexao->connect_errno)
     {
         echo "Erro";
     }
     else
     {
         echo "Conexão efetuada com sucesso";
     }*/

     $conn = mysqli_connect("localhost", "root", "", "projeto");

?>