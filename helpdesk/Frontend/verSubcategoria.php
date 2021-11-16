<?php
    include '../Backend/conexao.php';

    $resultado = array();

    $cod_subcategoria_up = $_GET['subcategoria_up'];
        
    $query = $conn->prepare("SELECT tipo.nome_tipo, categoria.nome_categoria, subcategoria.cod_subcategoria subcategoria.nome_subcategoria, subcategoria.ativo FROM subcategoria INNER JOIN categoria ON categoria.cod_categoria = subcategoria.categoria_cod_categoria INNER JOIN tipo ON tipo.cod_tipo = categoria.tipo_cod_tipo WHERE cod_subcategoria = :csc");
    $query->bindValue(":csc",$cod_subcategoria_up);
    $query->execute();
    $resultado = $query->fetch(PDO::FETCH_ASSOC);

    if(isset($_POST['vercat'])) {

        $cod_categoria = $_POST['vercc'];
        $nome_categoria = $_POST['vercat'];
        $ativo = $_POST['ativo'];
        
        $query = $conn->prepare("UPDATE categoria SET nome_categoria = :nc, ativo = :a WHERE cod_categoria = :cc");
    
        $query->bindValue(":nc",$nome_categoria);
        $query->bindValue(":a",$ativo);
        $query->bindValue(":cc",$cod_categoria);
        $query->execute();
    }
    if($cod_categoria_up == null) {
        header("location: gerenciarAberturaChamados.php");
    }
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ver Categoria</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="CSS/adicionarTipo.css">
</head>
<body>
    <main class="row justify-content-center align-items-center">
    <div class="row justify-content-center align-items-center" id="dpc">
        <div id="form1">
        <form action="verCategoria.php" method="POST">
        <h2>Cadastrar Novo Tipo</h2>
        <?php echo "Tipo Associado: ".$resultado['nome_tipo'];?>
            <div class="form-group">
                <input type="hidden" class="form-control" name="vercc" id="vcc" required value="<?php if(isset($resultado)) {echo $resultado['cod_categoria'];} ?>">
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