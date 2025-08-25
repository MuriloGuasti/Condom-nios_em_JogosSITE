<?php
    $dbHost = 'localhost';
    $dbUsername = 'root';
    $dbPassword = '';
    $dbName = 'cadastro-usuarios';

    $conn = new mysqli($dbHost, $dbUsername, $dbPassword, $dbName);

    /*if($conn->connect_error)
    {
        echo "Erro na conexão: " . $conn->connect_error;
    }
    else
    {
        echo "Conexão efetuada com sucesso!";
    }*/
?>
