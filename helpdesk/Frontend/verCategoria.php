<?php
    include '../Backend/conexao.php';

    $resultado = array();

    $cod_categoria_up = $_GET['categoria_up'];
        
    $query = $conn->prepare("SELECT * FROM categoria WHERE cod_categoria = :cc");
    $query->bindValue(":cc",$cod_categoria_up);
    $query->execute();
    $resultado = $query->fetch(PDO::FETCH_ASSOC);

    if(isset($_POST['vercat'])) {

        $cod_tipo = $_POST['verct'];
        $nome_categoria = $_POST['vercat'];
        $ativo = $_POST['ativo'];
        
        $query = $conn->prepare("UPDATE tipo SET nome_tipo = :nt, ativo = :a WHERE cod_tipo = :ct");
    
        $query->bindValue(":nt",$nome_tipo);
        $query->bindValue(":a",$ativo);
        $query->bindValue(":ct",$cod_tipo);
        $query->execute();
    }
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
        <h2>Cadastrar Novo Tipo</h2>
            <div class="form-group">
                <input type="hidden" class="form-control" name="vercc" id="vcc" required value="<?php if(isset($resultado)) {echo $resultado['cod_categoria'];} ?>">
            </div>
            <div class="form-group">
                <label for="vctipo">Tipo Associado</label>
                <input type="text" class="form-control" name="verct" id="vct" required value="<?php if(isset($resultado)) {echo $resultado['tipo_cod_tipo'];} ?>">
            </div>
            <div class="form-group">
                <label for="vcat">Categoria</label>
                <input type="text" class="form-control" name="vercat" id="vc" required value="<?php if(isset($resultado)) {echo $resultado['nome_categoria'];} ?>">
            </div>
            <div class="form-group">
                <label for="ativo">Ativo:</label><br>
                <select class="form-control" id="atv" name="ativo">
                    <option value="0" <?php if($resultado['ativo'] == 0) {echo "selected";}?>>Inativo</option>
                    <option value="1" <?php if($resultado['ativo'] == 1) {echo "selected";}?>>Ativo</option>
                </select>
            </div>
            <input type="submit" value="Guardar">
        </form>
    </div> <!--form1-->
    </div> <!--dpc-->
    </main>
</body>
</html>