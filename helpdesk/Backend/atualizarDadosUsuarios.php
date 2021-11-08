<?php
include 'conexao.php';

if(isset($_POST['nome'])) {

    $matricula = $_POST['mat'];
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $telefone = $_POST['telefone'];
    $departamento = $_POST['departamento'];
    $nivel = $_POST['nivel'];
    $ativo = $_POST['ativo'];
    
    $query = $conn->prepare("UPDATE usuarios SET nome = :n, telefone = :t, email = :e, departamento = :d, nivel = :nv, ativo = :a WHERE matricula = :m");

    $query->bindValue(":n",$nome);
    $query->bindValue(":t",$telefone);
    $query->bindValue(":e",$email);
    $query->bindValue(":d",$departamento);
    $query->bindValue(":m",$matricula);
    $query->bindValue(":nv",$nivel);
    $query->bindValue(":a",$ativo);
    $query->execute();
}

header("location: ../Frontend/gerenciarUsuarios.php");

?>