<?php
    include '../Backend/conexao.php';

    $resultado = array();

    //pega o codigo passado pela outra página via URL e atribui a uma variavel
    $cod_departamento_up = $_GET['departamento_up'];
        
    //Faz a consulta no banco de acordo com o codigo passado via URL
    $query = $conn->prepare("SELECT * FROM departamento WHERE cod_departamento = :cd");
    $query->bindValue(":cd",$cod_departamento_up);
    $query->execute();
    $resultado = $query->fetch(PDO::FETCH_ASSOC);

    //Verifica se existe POST
    if(isset($_POST['verdep'])) {

        //Pega os POSTs do formularios e atribue a variaveis
        $cod_departamento = $_POST['vercd'];
        $nome_departamento = $_POST['verdep'];
        $ativo = $_POST['ativo'];
        
        //Faz o update no banco de acordo com o codigo passado via URL
        $query = $conn->prepare("UPDATE departamento SET nome_departamento = :nd,  ativo = :a WHERE cod_departamento = :cd");
        $query->bindValue(":nd",$nome_departamento);
        $query->bindValue(":a",$ativo);
        $query->bindValue(":cd",$cod_departamento);
        $query->execute();
    }
    //Após o update a variavel passada pela URL fica nula, por isso é feita a verificação para voltar a página
    if($cod_departamento_up == null) {
        header("location: gerenciarSistemaChamado.php");
    }
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Atualizar Departamento</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="CSS/adicionarStatus.css">
</head>
<body>
    <main class="row justify-content-center align-items-center">
    <div class="row justify-content-center align-items-center" id="dpc">
        <div id="form1">
        <form action="verDepartamento.php" method="POST">
        <h2>Editar Departamento</h2>
            <input type="hidden" name="vercd" value="<?php if(isset($resultado)) {echo $resultado['cod_departamento'];} ?>">
            <div class="form-group">
                <label for="ndepartamento">Departamento</label>
                <input type="text" class="form-control" placeholder="Departamento:" name="verdep" id="vd" value="<?php if(isset($resultado)) {echo $resultado['nome_departamento'];} ?>" required>
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