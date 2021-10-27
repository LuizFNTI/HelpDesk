<?php
include 'conexao.php';

if(isset($_POST['mat']) && isset($_POST['nome']) && isset($_POST['email']) && isset($_POST['telefone']) && isset($_POST['departamento']) && isset($_POST['senha'])) {

    $matricula = $_POST['mat'];
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $telefone = $_POST['telefone'];
    $departamento = $_POST['departamento'];


    $query = $conn->prepare("UPDATE usuarios SET nome = :n, telefone = :t, email = :e, departamento = :d, WHERE matricula = m:");

    $query->bindValue(":n",$nome);
    $query->bindValue(":t",$telefone);
    $query->bindValue(":e",$email);
    $query->bindValue(":d",$departamento);
    $query->bindValue(":m", $matricula);
    $query->execute();
}

//header("location: ../Frontend/gerenciarUsuarios.php");

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo "$nome"?></title>
</head>
<body>
    
</body>
</html>