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
    if(isset($_POST['descricao'])) {

        //Pega os POSTs do formularios e atribue a variaveis
        $numero_chamado = $_POST["vnc"];
        $descricao = $_POST['descricao'];
        $aberto = $_POST['aberto'];

        //Faz o update 
        $query = $conn->prepare("UPDATE chamados SET descricao = :du, status_chamado_cod_status = :stcancelado WHERE numero_chamado = :nc");
        $query->bindValue(":du",$descricao);
        $query->bindValue(":stcancelado",$aberto);
        $query->bindValue(":nc",$numero_chamado);
        $query->execute();
    }
    //caso a variavel seja nula, volta para a tela de gerenciamento
    if($numero_chamado_up == null) {
        header("location: listaChamadoAnalista.php");
    }
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ver Chamado</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="CSS/verChamadoAnalista.css">
</head>
<body>
    <main class="row justify-content-center align-items-center">
        <div id="dpc">
            <form action="" method="POST">
                <input type="hidden" name="vnc" value="<?php echo $resultado['numero_chamado']; ?>">
                <input type="hidden" name="aberto" value="4">
                <div class="form-group">
                    <label for="descricao">Faça uma breve descrição sobre o motivo do cancelamento:</label>
                    <textarea class="form-control" rows="5" placeholder="Descrição Analista:" id="descr" name="descricao"></textarea>
                </div>
                <input type="submit" value="Cancelar">
            </form>
        </div> <!--dpc-->
    </main>
</body>
</html>