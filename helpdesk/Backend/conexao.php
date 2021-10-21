<?php
    $hostname = "localhost";
    $dbname = "db_teste";
    $username = "root";
    $pw = "";

    try {
        $conn = new PDO("mysql:host=$hostname;dbname=$dbname", $username, $pw);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);  
    } catch(PDOexception $erro) {
        echo "Erro de conexão com o banco de dados: {$erro->getMessage()}";
        $conn = null;
    }
?>