<?php
include_once 'conexao.php';

if(isset($_POST['mat']) && isset($_POST['senha']) && $conn != null) {

    $pass_hash = password_hash($_POST['senha'], PASSWORD_DEFAULT);

    $query = $conn->prepare("SELECT * FROM usuarios WHERE matricula = ?");
    $query->execute(array($_POST['mat']));

    $usuario = $query->fetch(PDO::FETCH_ASSOC);
    if(password_verify($_POST['senha'], $usuario['senha'])) {
        //Inicia seção e recebe os valores num array
        session_start();
        $_SESSION['usuario'] = array($usuario['matricula'], $usuario['nivel'], $usuario['nome']);
        header("location: acesso.php");
    } else {
        echo "invalido";
    }
} 
?>