<?php
    include '../Backend/conexao.php';

    $resultado = array();

    //pega o codigo passado pela outra página via URL e atribui a uma variavel
    $cod_status_up = $_GET['status_up'];
        
    //Faz a consulta no banco de acordo com o codigo passado via URL
    $query = $conn->prepare("SELECT * FROM status_chamado WHERE cod_status = :cs");
    $query->bindValue(":cs",$cod_status_up);
    $query->execute();
    $resultado = $query->fetch(PDO::FETCH_ASSOC);

    //Verifica se existe POST
    if(isset($_POST['verst'])) {

        //Pega os POSTs do formularios e atribue a variaveis
        $cod_status = $_POST['vercs'];
        $nome_status = $_POST['verst'];
        $ativo = $_POST['ativo'];
        
        //Faz o update no banco de acordo com o codigo passado via URL
        $query = $conn->prepare("UPDATE status_chamado SET nome_status = :ns,  ativo = :a WHERE cod_status = :cs");
        $query->bindValue(":ns",$nome_status);
        $query->bindValue(":a",$ativo);
        $query->bindValue(":cs",$cod_status);
        $query->execute();
    }
    //Após o update a variavel passada pela URL fica nula, por isso é feita a verificação para voltar a página
    if($cod_status_up == null) {
        header("location: gerenciarSistemaChamado.php");
    }
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Adicionar Status Demanda</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="CSS/adicionarStatus.css">
</head>
<body>
    <main class="row justify-content-center align-items-center">
    <div class="row justify-content-center align-items-center" id="dpc">
        <div id="form1">
        <form action="verStatus.php" method="POST">
        <h2>Ver Status</h2>
            <div class="form-group">
                <!--Passa o codigo via POST para ser possivel realizar o update-->
                <input type="hidden" class="form-control" name="vercs" id="vcs" required value="<?php if(isset($resultado)) {echo $resultado['cod_status'];} ?>">
            </div>
            <div class="form-group">
                <label for="nstatus">Status</label>
                <input type="text" class="form-control" placeholder="Status:" name="verst" id="vst" required value="<?php if(isset($resultado)) {echo $resultado['nome_status'];}//passa o valor para o formulario ?>">
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