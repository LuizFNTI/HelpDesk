<?php
    include '../Backend/conexao.php';

    $resultado = array();

    $cod_status = $_GET['status_up'];
        
    $query = $conn->prepare("SELECT * FROM status_chamado WHERE cod_status = :cs");
    $query->bindValue(":cs",$cod_status);
    $query->execute();
    $resultado = $query->fetch(PDO::FETCH_ASSOC);
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
        <form action="#" method="POST">
        <h2>Ver Status</h2>
            <div class="form-group">
                <label for="nstatus">Status</label>
                <input type="text" class="form-control" placeholder="Status:" name="novost" id="nst" required value="<?php if(isset($resultado)) {echo $resultado['nome_status'];} ?>">
            </div>
            <p>Ativo: </p>
            <div class="form-check-inline">  
                <label class="form-check-label">
                <input type="radio" class="form-check-input" name="optradio" value="<?php if(isset($resultado) && $resultado['ativo'] == 1)?>" <?php {echo "checked";}?>>Sim
            </label>
            </div>
            <div class="form-check-inline">
                <label class="form-check-label">
                <input type="radio" class="form-check-input" name="optradio">>Não
            </label>
            </div><br><br>
            <button type="button" class="btn btn-success">Guardar</button>
        </form>
    </div> <!--form1-->
    </div> <!--dpc-->
    </main>
</body>
</html>