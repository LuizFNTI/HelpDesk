<?php
    include_once 'conexao.php';
    //Verifica se existe POST
    if(isset($_POST['mat']) && isset($_POST['senha']) && $conn != null) {
        //Faz o select no banco para comparar a matricula
        $query = $conn->prepare("SELECT * FROM usuarios WHERE matricula = ?");
        $query->execute(array($_POST['mat']));
        //Joga os dados num array
        $usuario = $query->fetch(PDO::FETCH_ASSOC);
        //Verifica a senha criptografada usando a função password_verify
        if(password_verify($_POST['senha'], $usuario['senha']) && $usuario) {
            //Inicia seção e recebe os valores num array
            session_start();
            $_SESSION['usuario'] = array($usuario['matricula'], $usuario['nivel'], $usuario['nome']);
            header("location: acesso.php");
        } else {
            echo "<script>window.alert('Numero de matricula ou senha incorreta!')</script>";
            echo "<script>window.location.href = '../index.php';</script>";
        }
    } 
?>