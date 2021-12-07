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

    //pega o codigo passado pela outra página via URL e atribui a uma variavel
    $cod_subcategoria_up = $_GET['subcategoria_up'];
        
    //Faz a consulta no banco de acordo com o codigo passado via URL
    $query = $conn->prepare("SELECT tipo.nome_tipo, categoria.nome_categoria, subcategoria.cod_subcategoria, subcategoria.nome_subcategoria, subcategoria.ativo FROM subcategoria INNER JOIN categoria ON categoria.cod_categoria = subcategoria.categoria_cod_categoria INNER JOIN tipo ON tipo.cod_tipo = categoria.tipo_cod_tipo WHERE cod_subcategoria = :csc");
    $query->bindValue(":csc",$cod_subcategoria_up);
    $query->execute();
    $resultado = $query->fetch(PDO::FETCH_ASSOC);

    //Verifica se existe POST
    if(isset($_POST['verscat'])) {

        //Pega os POSTs do formularios e atribue a variaveis
        $cod_subcategoria = $_POST['vercsc'];
        $nome_subcategoria = $_POST['verscat'];
        $ativo = $_POST['ativo'];
        
        //Faz o update no banco de acordo com o codigo passado via URL
        $query = $conn->prepare("UPDATE subcategoria SET nome_subcategoria = :nsc, ativo = :a WHERE cod_categoria = :csc");
        $query->bindValue(":nsc",$nome_subcategoria);
        $query->bindValue(":a",$ativo);
        $query->bindValue(":csc",$cod_subcategoria);
        $query->execute();
    }
    //Após o update a variavel passada pela URL fica nula, por isso é feita a verificação para voltar a página
    if($cod_subcategoria_up == null) {
        header("location: gerenciarAberturaChamados.php");
    }
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ver SubCategoria</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="CSS/adicionarTipo.css">
</head>
<body>
    <main class="row justify-content-center align-items-center">
    <div class="row justify-content-center align-items-center" id="dpc">
        <div id="form1">
        <form action="verCategoria.php" method="POST">
        <h2>ver Subcategoria</h2>
        <?php echo "Tipo Associado: ".$resultado['nome_tipo']."<br>";?><!--Informa o Tipo associado-->
        <?php echo "Categoria Associado: ".$resultado['nome_categoria'];?><!--Informa o categoria associado-->
            <div class="form-group">
                <!--Passa o codigo via POST para ser possivel realizar o update-->
                <input type="hidden" class="form-control" name="vercsc" id="vcsc" required value="<?php if(isset($resultado)) {echo $resultado['cod_subcategoria'];} ?>">
            </div>
            <div class="form-group">
                <label for="vcat">Categoria</label>
                <input type="text" class="form-control" name="verscat" id="vsc" required value="<?php if(isset($resultado)) {echo $resultado['nome_subcategoria'];}//passa o valor para o formulario ?>">
            </div>
            <div class="form-group">
                <label for="ativo">Ativo:</label><br>
                <select class="form-control" id="atv" name="ativo">
                    <option value="0" <?php if($resultado['ativo'] == 0) {echo "selected";}?>>Inativo</option>
                    <option value="1" <?php if($resultado['ativo'] == 1) {echo "selected";}?>>Ativo</option><!--Verifica qual a situação no banco para fazer a seleção no opition-->
                </select>
            </div>
            <input type="submit" value="Guardar">
        </form>
    </div> <!--form1-->
    </div> <!--dpc-->
    </main>
</body>
</html>