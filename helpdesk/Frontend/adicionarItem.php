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
if(isset($_POST['novoi'])) {
    //Pega os POSTs do form e atribui a variaveis
    $item = $_POST['novoi'];
    $ativo = $_POST['ativo'];
    $cod_subcategoria = $_POST['cscat'];

    //faz a consulta no banco
    $query = $conn->prepare("INSERT INTO item (nome_item, ativo, subcategoria_cod_subcategoria) VALUES (:novoi, :atv, :cdsc)");
    $query->bindValue(":novoi",$item);
    $query->bindValue(":atv",$ativo);
    $query->bindValue(":cdsc",$cod_subcategoria);
    $query->execute();
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Adicionar Novo Item</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="CSS/adicionarItem.css">
</head>
<body>
    <main class="row justify-content-center align-items-center">
    <div class="row justify-content-center align-items-center" id="dpc">
        <div id="form1">
        <form action="adicionarItem.php" method="POST">
        <h2>Cadastrar Novo Item</h2>
        <div class="form-group">
                <label for="tipodemanda">Selecione o Tipo de Demanda</label>
                <select class="form-control" id="cdt" name="ctipo">
                <?php
                    include '../Backend/conexao.php';

                    $dados = array();        
                    
                    //Faz a consulta no banco
                    $query = $conn->query("SELECT * FROM tipo ORDER BY nome_tipo");
                    
                    //Joga os dados do banco num array e faz a leitura do array jogando as informações no opition
                    foreach($query->fetchAll(PDO::FETCH_ASSOC) as $dados) {
                        echo "<option value=".$dados['cod_tipo'].">".$dados['nome_tipo']."</option>";
                    }
                ?>
                </select>
            </div>
            <!--Inclui o select da categoria e subcategoria-->
            <?php 
            include_once 'carregarCategoria.php'; 
            include_once 'carregarSubCat.php';
            ?>
                <div class="form-group">
                <label for="nitem">Digite o Novo Item</label>
                <input type="text" class="form-control" placeholder="Novo Item:" name="novoi" id="ni" required>
            </div>
            <div class="form-group">
                <label for="ativo">Ativo:</label><br>
                <select class="form-control" id="atv" name="ativo">
                    <option value="0">Inativo</option>
                    <option value="1">Ativo</option>
                </select>
            </div>
            <input type="submit" value="Guardar">
        </form>
    </div> <!--form1-->
    </div> <!--dpc-->
    </main>
    <script src="JS/JQuery/jquery-3.6.0.min.js"></script>
    <script src="JS/ajaxCategoria.js"></script>
    <script src="JS/ajaxSubCat.js"></script>
</body>
</html>