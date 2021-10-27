<?php
include_once 'conexao.php';

if(isset($_POST['mat']) && isset($_POST['nome']) && isset($_POST['email']) && isset($_POST['telefone']) && isset($_POST['departamento']) && isset($_POST['senha'])) {

    $matricula = $_POST['mat'];
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $telefone = $_POST['telefone'];
    $departamento = $_POST['departamento'];
    $senha = $_POST['senha'];

    //$senha_hash = password_hash($senha, PASSWORD_DEFAULT);

    $query = $conn->prepare("INSERT INTO usuarios (matricula, nome, telefone, email, departamento, senha) VALUES (:matricula, :nome, :telefone, :email, :departamento, :senha)");
    $query->bindValue(":matricula", $matricula);
    $query->bindValue(":nome",$nome);
    $query->bindValue(":telefone",$telefone);
    $query->bindValue(":email",$email);
    $query->bindValue(":departamento",$departamento);
    $query->bindValue(":senha",$senha);
    $query->execute();
}
    header("location: ../index.php");
?>