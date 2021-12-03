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

    include '../Backend/conexao.php';

    $resultado = array();

    //Pega o codigo tipo pela URL
    $cod_tipo_up = $_GET['tipo_up'];
        
    //Faz o select para passar os valores para o form
    $query = $conn->prepare("SELECT * FROM tipo WHERE cod_tipo = :ct");
    $query->bindValue(":ct",$cod_tipo_up);
    $query->execute();
    $resultado = $query->fetch(PDO::FETCH_ASSOC);

    //Verifica se existe POST
    if(isset($_POST['vert'])) {

        //Pega os POSTs do formularios e atribue a variaveis
        $cod_tipo = $_POST['verct'];
        $nome_tipo = $_POST['vert'];
        $ativo = $_POST['ativo'];
        
        //Faz o update 
        $query = $conn->prepare("UPDATE tipo SET nome_tipo = :nt, ativo = :a WHERE cod_tipo = :ct");
        $query->bindValue(":nt",$nome_tipo);
        $query->bindValue(":a",$ativo);
        $query->bindValue(":ct",$cod_tipo);
        $query->execute();
    }
    //caso a variavel seja nula, volta para a tela de gerenciamento
    if($cod_tipo_up == null) {
        header("location: gerenciarAberturaChamados.php");
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
    <link rel="stylesheet" href="CSS/adicionarTipo.css">
</head>
<body>
    <main class="row justify-content-center align-items-center">
    <div class="row justify-content-center align-items-center" id="dpc">
        <div id="form1">
        <form action="verTipo.php" method="POST">
        <h2>Ver Tipo</h2>
            <!--form para passar o cod-tipo via POST para fazer o updadate-->
            <div class="form-group">
                <label for="vctipo">Codigo Tipo</label>
                <input type="hidden" class="form-control" name="verct" id="vct" required value="<?php if(isset($resultado)) {echo $resultado['cod_tipo'];} ?>">
            </div>
            <div class="form-group">
                <label for="vtipo">Tipo</label>
                <input type="text" class="form-control" name="vert" id="vt" required value="<?php if(isset($resultado)) {echo $resultado['nome_tipo'];} ?>"><!--passa as informações do banco para exibir no formulario-->
            </div>
            <div class="form-group">
                <label for="ativo">Ativo:</label><br>
                <select class="form-control" id="atv" name="ativo">
                    <option value="0" <?php if($resultado['ativo'] == 0) {echo "selected";}?>>Inativo</option>
                    <option value="1" <?php if($resultado['ativo'] == 1) {echo "selected";}?>>Ativo</option>
                </select><!--puxa do banco o 'ativo' e faz a verificação para ver qual sera selecionado-->
            </div>
            <input type="submit" value="Guardar">
        </form>
    </div> <!--form1-->
    </div> <!--dpc-->
    </main>
</body>
</html>