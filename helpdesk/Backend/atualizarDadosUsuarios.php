<?php
include_once 'conexao.php';

if(isset($_POST['mat']) && isset($_POST['nome']) && isset($_POST['email']) && isset($_POST['telefone']) && isset($_POST['departamento']) && isset($_POST['senha'])) {

    $matricula = $_POST['mat'];
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $telefone = $_POST['telefone'];
    $departamento = $_POST['departamento'];
    $senha = $_POST['senha'];

    $query = $conn->prepare("UPDATE usuarios SET nome = :n, telefone = :t, email = :e, :departamento = :d, senha = :s WHERE matricula = m:");

    $query->bindValue(":nome",$nome);
    $query->bindValue(":telefone",$telefone);
    $query->bindValue(":email",$email);
    $query->bindValue(":departamento",$departamento);
    $query->bindValue(":senha",$senha);
    $query->bindValue(":matricula", $matricula);
    $query->execute();
}
    header("location: ../Frontend/gerenciarUsuarios.php");

?>