<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recuperar Senha</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="CSS/recuperarSenha.css">
</head>
<body>
    <div class="row justify-content-center align-items-center" id="dpc">
        <div id="df1">
        <form action="Backend/validar_login.php" method="POST">
        <h2>Recuperar Senha</h2>
            <div class="form-group">
                <label for="novasenha">Digite Sua Nova Senha:</label>
                <input type="text" class="form-control" placeholder="Nova Senha:" name="ns" id="npass" required>
            </div>
            <div class="form-group">
                <label for="repsenha">Confirme Sua Nova Senha:</label>
                <input type="text" class="form-control" placeholder="Confirmar Senha:" name="cs" id="cpass" required>
            </div>
            <button type="button" class="btn btn-success">Atualizar Senha</button>
        </div>
        </form>
    </div>
</body>
</html>