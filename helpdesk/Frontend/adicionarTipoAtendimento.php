<!DOCTYPE html>
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
        <form action="Backend/validar_login.php" method="POST">
        <h2>Cadastrar Novo Tipo Atendimento</h2>
            <div class="form-group">
                <label for="ntipoa">Digite o Novo Tipo Atendimento</label>
                <input type="text" class="form-control" placeholder="Novo Tipo Atendimento:" name="novota" id="nta" required>
            </div>
            <button type="button" class="btn btn-success">Guardar</button>
        </form>
    </div> <!--form1-->
    </div> <!--dpc-->
    </main>
</body>
</html>