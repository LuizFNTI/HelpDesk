<?php
    include_once 'validarLogin.php';
    session_start();
    //Verifica se existe seção
    if(isset($_SESSION['usuario']) && is_array($_SESSION['usuario'])) {
        //Atribui o nivel do usuario da seção
        $nivel = $_SESSION['usuario'][1];
    } else {
        header("location: ../index.php");
    }
    //Faz a verificação do nivel do usuario para fazer o redirecionamento correto
    if($nivel == 0) {
        header("location: ../Frontend/listaChamadoUsuario.php");
    } else if($nivel == 1) {
        header("location: ../Frontend/listaChamadoAnalista.php");
    } else if($nivel == 2) {
        header("location: ../Frontend/gerenciarUsuarios.php");
    }
?>
