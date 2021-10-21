<?php
include_once 'conexao.php';

if(isset($_POST['mat']) && isset($_POST['senha']) && $conn != null) {



    
    $query = $conn->prepare("SELECT * FROM usuarios WHERE matricula = ? AND senha = ?");
    $query->execute(array($_POST['mat'], $_POST['senha']));

    //Joga os daddos do banco num array
    if($query->rowCount()) {
        $usuario = $query->fetchAll(PDO::FETCH_ASSOC)[0];
        //Inicia seção e recebe os valores num array
        session_start();
        $_SESSION['usuario'] = array($usuario['matricula'], $usuario['nivel'], $usuario['nome']);
        header("location: acesso.php");
    } else {
        header("location: ../index.php");
    }
} else {
    header("location: ../index.php");
}
?>