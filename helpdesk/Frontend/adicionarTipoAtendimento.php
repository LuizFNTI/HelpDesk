<?php

    session_start();

    if(isset($_SESSION['usuario']) && is_array($_SESSION['usuario'])) {
        if($_SESSION['usuario'][1] == 2) {
            $matricula = $_SESSION['usuario'][0];
            $nome_analista = $_SESSION['usuario'][2];
        } else {
            header("location: ../index.php");
        }
    } else {
        header("location: ../index.php");
    }

include_once '../Backend/conexao.php';

//Verifica se existe POST
if(isset($_POST['novota'])) {

    //Pega os POSTs do form e atribui a variaveis
    $tipoa = $_POST['novota']; 

    //faz a consulta no banco
    $query = $conn->prepare("INSERT INTO tipo_atendimento (nome_tipo_atendimento) VALUES (:novota)");
    $query->bindValue(":novota",$tipoa);
    $query->execute();
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Adicionar Tipo Demanda</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="CSS/adicionarTipoAtendimento.css">
</head>
<body>
    <main class="row justify-content-center align-items-center">
    <div class="row justify-content-center align-items-center" id="dpc">
        <div id="form1">
        <form action="adicionarTipoAtendimento.php" method="POST">
        <h2>Cadastrar Novo Tipo Atendimento</h2>
            <div class="form-group">
                <label for="ntipoa">Digite o Novo Tipo Atendimento</label>
                <input type="text" class="form-control" placeholder="Novo Tipo Atendimento:" name="novota" id="nta" required>
            </div>
            <input type="submit" value="Guardar">
        </form>
    </div> <!--form1-->
    </div> <!--dpc-->
    </main>
</body>
</html>