<?php
include 'conexao.php';

if(isset($_POST['mat']) && isset($_POST['nome']) && isset($_POST['email']) && isset($_POST['telefone']) && isset($_POST['departamento']) && isset($_POST['senha'])) {

    $mat_up = $_GET['matricula_up'];
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $telefone = $_POST['telefone'];
    $departamento = $_POST['departamento'];

    $query = $conn->prepare("UPDATE usuarios SET nome = :n, telefone = :t, email = :e, :departamento = :d, WHERE matricula = m:");

    $query->bindValue(":n",$nome);
    $query->bindValue(":t",$telefone);
    $query->bindValue(":e",$email);
    $query->bindValue(":d",$departamento);
    $query->bindValue(":m", $mat_up);
    $query->execute();
}

?>