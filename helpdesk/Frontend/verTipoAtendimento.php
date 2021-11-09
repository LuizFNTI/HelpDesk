<?php
    include '../Backend/conexao.php';

    $resultado = array();

    $cod_tipoa_up = $_GET['tipoa_up'];
        
    $query = $conn->prepare("SELECT * FROM tipo_atendimento WHERE cod_tipo_atendimento = :cta");
    $query->bindValue(":cta",$cod_tipoa_up);
    $query->execute();
    $resultado = $query->fetch(PDO::FETCH_ASSOC);

    if(isset($_POST['verta'])) {

        $cod_tipo_atendimento = $_POST['vercta'];
        $nome_tipo_atendimento = $_POST['verta'];
        $ativo = $_POST['ativo'];
        
        $query = $conn->prepare("UPDATE tipo_atendimento SET nome_tipo_atendimento = :nta,  ativo = :a WHERE cod_tipo_atendimento = :cta");
    
        $query->bindValue(":nta",$nome_tipo_atendimento);
        $query->bindValue(":a",$ativo);
        $query->bindValue(":cta",$cod_tipo_atendimento);
        $query->execute();
    }
    if($cod_tipoa_up == null) {
        header("location: gerenciarSistemaChamado.php");
    }
?>
<DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Adicionar Tipo Demanda</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="CSS/adicionarTipoAtendimento.css">
</head>
<body>
    <main class="row justify-content-center align-items-center">
    <div class="row justify-content-center align-items-center" id="dpc">
        <div id="form1">
        <form action="verTipoAtendimento.php" method="POST">
        <h2>Ver Tipo Atendimento</h2>
            <div class="form-group">
                <input type="hidden" class="form-control" name="vercta" id="vcta" required value="<?php if(isset($resultado)) {echo $resultado['cod_tipo_atendimento'];} ?>">
            </div>
            <div class="form-group">
                <label for="vtipoa">Tipo Atendimento</label>
                <input type="text" class="form-control" placeholder="Tipo Atendimento:" name="verta" id="vta" required value="<?php if(isset($resultado)) {echo $resultado['nome_tipo_atendimento'];} ?>">
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