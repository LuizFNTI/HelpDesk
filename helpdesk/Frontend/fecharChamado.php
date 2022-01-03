<?php
    session_start();

    if(isset($_SESSION['usuario']) && is_array($_SESSION['usuario'])) {
        $matricula = $_SESSION['usuario'][0];
        $nome_analista = $_SESSION['usuario'][2];
    } else {
        header("location: ../index.php");
    }

    include '../Backend/conexao.php';

    $resultado = array();

    //Pega o codigo tipo pela URL
    $numero_chamado_up = $_GET['nc_up'];

    //Faz o select para passar os valores para o form
    $query = $conn->prepare("SELECT * FROM chamados WHERE numero_chamado = :nc");
    $query->bindValue(":nc",$numero_chamado_up);
    $query->execute();
    $resultado = $query->fetch(PDO::FETCH_ASSOC);

    //Verifica se existe POST
    if(isset($_POST['descanalista'])) {

        //Pega os POSTs do formularios e atribue a variaveis
        $numero_chamado = $_POST["vnc"];
        $descricao_analista = $_POST['descanalista'];
        $aberto = $_POST['aberto'];

        //Faz o update 
        $query = $conn->prepare("UPDATE chamados SET descricao_analista = :dn, data_hora_fechamento = NOW(), aberto = :stfinalizado WHERE numero_chamado = :nc");
        $query->bindValue(":dn",$descricao_analista);
        $query->bindValue(":stfinalizado",$aberto);
        $query->bindValue(":nc",$numero_chamado);
        $query->execute();
    }
    //caso a variavel seja nula, volta para a tela de gerenciamento
    if($numero_chamado_up == null) {
        header("location: listaChamadoAnalista.php");
    }
?>
