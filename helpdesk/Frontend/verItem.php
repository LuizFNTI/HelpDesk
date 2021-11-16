<?php
    include '../Backend/conexao.php';

    $resultado = array();

    $cod_item_up = $_GET['item_up'];
        
    $query = $conn->prepare("SELECT item.cod_item, item.nome_item, subcategoria.nome_subcategoria, categoria.nome_categoria, tipo.nome_tipo, item.ativo FROM item INNER JOIN subcategoria ON subcategoria.cod_subcategoria = item.subcategoria_cod_subcategoria INNER JOIN categoria ON categoria.cod_categoria = subcategoria.categoria_cod_categoria INNER JOIN tipo ON tipo.cod_tipo = categoria.tipo_cod_tipo WHERE cod_item = :ci");
    $query->bindValue(":ci",$cod_item_up);
    $query->execute();
    $resultado = $query->fetch(PDO::FETCH_ASSOC);

    if(isset($_POST['veritem'])) {

        $cod_item = $_POST['verci'];
        $nome_categoria = $_POST['veritem'];
        $ativo = $_POST['ativo'];
        
        $query = $conn->prepare("UPDATE item SET nome_item = :ni, ativo = :a WHERE cod_item = :ci");
    
        $query->bindValue(":ni",$nome_item);
        $query->bindValue(":a",$ativo);
        $query->bindValue(":ci",$cod_item);
        $query->execute();
    }
    if($cod_item_up == null) {
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
        <form action="verItem.php" method="POST">
        <h2>Ver Item</h2>
        <?php echo "Tipo Associado: ".$resultado['nome_tipo']."<br>";?>
        <?php echo "Categoria Associado: ".$resultado['nome_categoria']."<br>";?>
        <?php echo "Subcategoria Associado: ".$resultado['nome_subcategoria'];?>
            <div class="form-group">
                <input type="hidden" class="form-control" name="verci" id="vci" required value="<?php if(isset($resultado)) {echo $resultado['cod_item'];} ?>">
            </div>
            <div class="form-group">
                <label for="vcat">Categoria</label>
                <input type="text" class="form-control" name="veritem" id="vitem" required value="<?php if(isset($resultado)) {echo $resultado['nome_item'];} ?>">
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