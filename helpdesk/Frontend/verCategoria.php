<?php

    session_start();

    if(isset($_SESSION['usuario']) && is_array($_SESSION['usuario'])) {
        if($_SESSION['usuario'][1] == 2) {
            $matricula = $_SESSION['usuario'][0];
            $nome_usuario = $_SESSION['usuario'][2];
        } else {
            header("location: ../index.php");
        }
    } else {
        header("location: ../index.php");
    }

    include '../Backend/conexao.php';

    $resultado = array();

    //pega o codigo passado pela outra página via URL e atribui a uma variavel
    $cod_categoria_up = $_GET['categoria_up'];
        
    //Faz a consulta no banco de acordo com o codigo passado via URL
    $query = $conn->prepare("SELECT tipo.nome_tipo, categoria.cod_categoria, categoria.nome_categoria, categoria.ativo FROM categoria INNER JOIN tipo ON tipo.cod_tipo = categoria.tipo_cod_tipo WHERE cod_categoria = :cc");
    $query->bindValue(":cc",$cod_categoria_up);
    $query->execute();
    $resultado = $query->fetch(PDO::FETCH_ASSOC);

    //Verifica se existe POST
    if(isset($_POST['vercat'])) {

        //Pega os POSTs do formularios e atribue a variaveis
        $cod_categoria = $_POST['vercc'];
        $nome_categoria = $_POST['vercat'];
        $ativo = $_POST['ativo'];
        
        //Faz o update no banco de acordo com o codigo passado via URL
        $query = $conn->prepare("UPDATE categoria SET nome_categoria = :nc, ativo = :a WHERE cod_categoria = :cc");
        $query->bindValue(":nc",$nome_categoria);
        $query->bindValue(":a",$ativo);
        $query->bindValue(":cc",$cod_categoria);
        $query->execute();
    }
    //Após o update a variavel passada pela URL fica nula, por isso é feita a verificação para voltar a página
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
        <h2>Ver Categoria</h2>
        <?php echo "Tipo Associado: ".$resultado['nome_tipo'];?><!--Informa o Tipo associado-->
            <!--Passa o codigo via POST para ser possivel realizar o update-->
            <input type="hidden" name="vercc" id="vcc" required value="<?php if(isset($resultado)) {echo $resultado['cod_categoria'];} ?>"><!--passa o valor para o formulario-->
            <div class="form-group">
                <label for="vcat">Categoria</label>
                <input type="text" class="form-control" name="vercat" id="vc" required value="<?php if(isset($resultado)) {echo $resultado['nome_categoria'];}//passa o valor para o formulario ?>">
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