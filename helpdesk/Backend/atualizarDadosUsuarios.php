<?php
include 'conexao.php';

if(isset($_POST['nome'])) {

    $matricula = $_POST['mat'];
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $telefone = $_POST['telefone'];
    $departamento = $_POST['departamento'];

    $query = $conn->prepare("UPDATE usuarios SET nome = ?, telefone = ?, email = ?, departamento = ? WHERE matricula = ?");
    $query->execute(array($nome, $email, $telefone, $departamento, $matricula));

    //$query->bindValue(":n",$nome);
    //$query->bindValue(":t",$telefone);
    //$query->bindValue(":e",$email);
    //$query->bindValue(":d",$departamento);
    //$query->bindValue(":m", $matricula);
    //$query->execute();
    //$query->execute(array(':n' => $nome, ':e' => $email, ':t' => $telefone, ':d' => $departamento, ':m' => $matricula));
}


//header("location: ../Frontend/gerenciarUsuarios.php");

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo "$matricula"?></title>
</head>
<body>
    <?php echo $nome; ?>
</body>
</html>