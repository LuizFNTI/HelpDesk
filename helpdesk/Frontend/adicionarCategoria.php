<?php
include_once '../Backend/conexao.php';

if(isset($_POST['novacat'])) {

    $categoria = $_POST['novacat'];
    $ativo = $_POST['ativo'];
    $cod_tipo = $_POST['ctipo']; 

    $query = $conn->prepare("INSERT INTO categoria (nome_categoria, ativo, tipo_cod_tipo) VALUES (:novac, :atv, :tcd)");
    $query->bindValue(":novac",$categoria);
    $query->bindValue(":atv",$ativo);
    $query->bindValue(":tcd",$cod_tipo);
    $query->execute();
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Adicionar Categoria</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="CSS/adicionarCategoria.css">
</head>
<body>
    <main class="row justify-content-center align-items-center">
    <div class="row justify-content-center align-items-center" id="dpc">
        <div id="form1">
        <form action="adicionarCategoria.php" method="POST">
        <h2>Cadastrar Nova Categoria</h2>
        <div class="form-group">
                <label for="tipodemanda">Selrcione o Tipo de Demanda que Deseja Vincular a Esta Categoria</label>
                <select class="form-control" id="cdt" name="ctipo">
                <?php
                    include '../Backend/conexao.php';

                    $dados = array();        
                    
                    $query = $conn->query("SELECT cod_tipo, nome_tipo FROM tipo ORDER BY nome_tipo");
                    
                    foreach($query->fetchAll(PDO::FETCH_ASSOC) as $dados) {
                        echo "<option value=".$dados['cod_tipo'].">".$dados['nome_tipo']."</option>";
                            }
                ?>
                </select>
            </div>
            <div class="form-group">
                <label for="ncat">Digite a Nova Categoria</label>
                <input type="text" class="form-control" placeholder="Nova Categoria:" name="novacat" id="nc" required>
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
</body>
</html>