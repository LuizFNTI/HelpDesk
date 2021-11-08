<?php
include 'conexao.php';

if(isset($_POST['nome'])) {

    $matricula = $_POST['mat'];
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $telefone = $_POST['telefone'];
    $departamento = $_POST['departamento'];

    $query = $conn->prepare("UPDATE usuarios SET nome = :n, telefone = :n, email = :e, departamento = :d WHERE matricula = :m");

    $query->bindValue(":n",$nome);
    $query->bindValue(":t",$telefone);
    $query->bindValue(":e",$email);
    $query->bindValue(":d",$departamento);
    $query->bindValue(":m", $matricula);
    $query->execute();
}

header("location: ../Frontend/gerenciarUsuarios.php");

?>