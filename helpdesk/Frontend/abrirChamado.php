<?php
include_once '../Backend/conexao.php';

    session_start();

    if(isset($_SESSION['usuario']) && is_array($_SESSION['usuario'])) {
        $matricula = $_SESSION['usuario'][0];
    } else {
        header("location: ../index.php");
    }

//Verifica se existe POST
if(isset($_POST['descricao'])) {

    //Pega os POSTs do form e atribui a variaveis
    $tipo = $_POST['ctipo'];
    $categoria = $_POST['ccat'];
    $subcategoria = $_POST['cscat'];
    $item = $_POST['item']; 
    $descricao = $_POST['descricao'];
    $status = $_POST['status'];
    $prioridade = $_POST['prioridade'];
    $tipo_atendimento = $_POST['tipoa'];
    $fila_geral = $_POST['fgeral'];

    //faz a consulta no banco
    $query = $conn->prepare("INSERT INTO chamados (descricao, data_hora_abertura, usuarios_matricula, status_chamado_cod_status, prioridade_chamado_cod_prioridade, tipo_atendimento_cod_tipo_atendimento, tipo_cod_tipo, categoria_cod_categoria, subcategoria_cod_subcategoria, item_cod_item, fila_geral) VALUES (:descr, NOW(), :mat, :sts, :pri, :tpa, :tipo, :categoria, :subcat, :item, :fgeral)");
    $query->bindValue(":descr",$descricao);
    $query->bindValue("mat",$matricula);
    $query->bindValue(":sts",$status);
    $query->bindValue(":pri",$prioridade);
    $query->bindValue(":tpa",$tipo_atendimento);
    $query->bindValue(":tipo",$tipo);
    $query->bindValue(":categoria",$categoria);
    $query->bindValue(":subcat",$subcategoria);
    $query->bindValue(":item",$item);
    $query->bindValue(":fgeral",$fila_geral);
    $query->execute();
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $data_abertura; ?></title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="CSS/abrirChamado.css">                         
</head>
<body>
    <nav class="navbar navbar-expand-sm bg-dark navbar-dark">
    <ul class="navbar-nav">
        <li class="nav-item" id="sizefont">
        <a class="nav-link" href="listaChamadoUsuario.php">Meus Chamados</a>
        </li>
        <li class="nav-item active" id="sizefont">
        <a class="nav-link" href="abrirChamado.php">Abrir Chamado</a>
        </li>
        <li class="nav-item" id="sizefont">
        <a class="nav-link" href="pesquisarChamadoUsuario.php">Pesquisar Chamados</a>
        </li>
        <li class="nav-item" id="btconfg">
            <button type="button" class="btn btn-primary">Configurações</button>
        </li>
        <li class="nav-item" id="btsair">
            <button type="button" class="btn btn-danger">Sair</button>
        </li>
    </ul>
    </nav>
    <main class="row justify-content-center align-items-center">
    <div class="row justify-content-center align-items-center" id="dpc">
        <div id="form1">
        <form action="abrirChamado.php" method="POST">
        <h2>Abrir Novo Chamado</h2>
        <input type="hidden" name="status" value="1">
        <input type="hidden" name="prioridade" value="1">
        <input type="hidden" name="tipoa" value="1">
        <input type="hidden" name="fgeral" value="1">
    <div class="row">
        <div class="col">
            <?php include_once 'carregarTipo.php'; ?>
        </div> <!--col1-->
        <div class="col">
            <?php include_once 'carregarCategoria.php'; ?>
        </div> <!--col2-->
        </div> <!--row 1-->
        <div class="row">
            <div class="col">
                <?php include_once 'carregarSubCat.php'; ?>
            </div> <!--col3-->
            <div class="col">
                <?php include_once 'carregarItem.php'; ?>
            </div> <!--col4-->
            </div> <!--row 2-->
            <div class="form-group">
                <label for="descricao">Faça uma breve descrição da sua solicitação:</label>
                <textarea class="form-control" rows="5" placeholder="Descrição:" id="descr" name="descricao"></textarea>
            </div>
            <input type="submit" value="Enviar">
        </form>
    </div> <!--form1-->
    </div> <!--dpc-->
    </main>
    <script src="JS/JQuery/jquery-3.6.0.min.js"></script>
    <script src="JS/ajaxCategoria.js"></script>
    <script src="JS/ajaxSubCat.js"></script>
    <script src="JS/ajaxItem.js"></script>
</body>
</html>