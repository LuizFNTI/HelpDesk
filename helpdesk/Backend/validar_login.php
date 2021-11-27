<?php
include_once 'conexao.php';

if(isset($_POST['mat']) && isset($_POST['senha']) && $conn != null) {

    $pass_hash = password_hash($_POST['senha'], PASSWORD_DEFAULT);
    //$pass_verify = password_verify($_POST['senha'], $pass_hash);

    $query = $conn->prepare("SELECT * FROM usuarios WHERE matricula = ?");
    $query->execute(array($_POST['mat']));

    //Joga os daddos do banco num array
    if($query->rowCount()) {
        $usuario = $query->fetch(PDO::FETCH_ASSOC);
        if(password_verify($_POST['senha'], $usuario['senha'])) {
            echo "valido!";
        } else {
            echo "invalido";
        }
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