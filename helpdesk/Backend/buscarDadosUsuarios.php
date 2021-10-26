<?php
    include 'conexao.php';

    $dados = array();        

    $query = $conn->query("SELECT * FROM usuarios ORDER BY nome");

    $dados = $query->fetchAll(PDO::FETCH_ASSOC);

?>