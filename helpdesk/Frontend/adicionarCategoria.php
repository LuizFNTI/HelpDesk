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
        <form action="Backend/validar_login.php" method="POST">
        <h2>Cadastrar Nova Categoria</h2>
        <div class="form-group">
                <label for="tipodemanda">Selrcione o Tipo de Demanda que Deseja Vincular a Esta Categoria</label>
                <select class="form-control" placeholder="Tipo" id="tipod" name="tipo">
                    <option>Nenhum</option>
                    <option>1</option>
                    <option>2</option>
                    <option>3</option>
                </select>
            </div>
            <div class="form-group">
                <label for="ncat">Digite a Nova Categoria</label>
                <input type="text" class="form-control" placeholder="Nova Categoria:" name="novacat" id="nc" required>
            </div>
            <p>Ativo: </p>
            <div class="form-check-inline">  
                <label class="form-check-label">
                <input type="radio" class="form-check-input" name="optradio">Sim
            </label>
            </div>
            <div class="form-check-inline">
                <label class="form-check-label">
                <input type="radio" class="form-check-input" name="optradio">Não
            </label>
            </div><br><br>
            <button type="button" class="btn btn-success">Guardar</button>
        </form>
    </div> <!--form1-->
    </div> <!--dpc-->
    </main>
</body>
</html>