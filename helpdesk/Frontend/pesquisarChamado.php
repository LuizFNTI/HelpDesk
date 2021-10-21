<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pesquisar Chamados</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="CSS/pesquisarChamado.css">
</head>
<body>
    <main class="row justify-content-center align-items-center">
    <div class="row justify-content-center align-items-center" id="dpc">
        <div id="form1">
        <form action="Backend/validar_login.php" method="POST">
        <h2>Pesquisar Chamado</h2>
            <div class="form-group">
                <label for="pchamado">Numero do Chamado</label>
                <input type="text" class="form-control" placeholder="Numero Chamado:" name="numCha" id="nch" required>
            </div>
            <div class="form-group">
                <label for="datafinal">Data Inicial</label>
                <input type="date" class="form-control" name="datain" id="din" required>
            </div>
            <div class="form-group">
                <label for="datainicial">Data Final</label>
                <input type="date" class="form-control" name="datafim" id="dfim" required>
            </div>
            <button type="button" class="btn btn-success">Buscar</button>
        </form>
    </div> <!--form1-->
    </div> <!--dpc-->
    </main>
</body>
</html>