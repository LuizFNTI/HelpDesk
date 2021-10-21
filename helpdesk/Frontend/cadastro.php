<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="CSS/cadastro.css">
</head>
<body>
    <div class="row justify-content-center align-items-center" id="dp">
        <form action="../Backend/guardarCadastro.php" method="POST">
        <h2>Cadastro</h2>
        <div id="df1">
            <div class="form-group">
                <label for="mat">Número Matricula:</label>
                <input type="text" class="form-control" placeholder="Matricula" name="mat" id="matr" required>
            </div>
            <div class="form-group">
                <label for="email">Endereço de E-mail:</label>
                <input type="text" class="form-control" placeholder="Seu E-mail:" name="email" id="e-mail" required>
            </div>
        </div>
        <div id="df1">
        <div class="form-group">
                <label for="nome">Nome Completo::</label>
                <input type="text" class="form-control" placeholder="Seu Nome:" name="nome" id="nme" required>
            </div>
            <div class="form-group">
                <label for="telefone">Telefone:</label>
                <input type="text" class="form-control" placeholder="Seu Telefone:" name="telefone" id="fone" required>
            </div>
        </div>
            <div class="form-group">
                <label for="departamento">Departamento:</label>
                <input type="text" class="form-control" placeholder="Seu Departamento:" name="departamento" id="dept" required>
            </div>
            <div class="form-group">
                <label for="senha">Senha:</label>
                <input type="text" class="form-control" placeholder="Digite su senha:" name="senha" id="pass" required>
            </div>
            <div class="form-group">
                <label for="confsenha">Confirmar Senha:</label>
                <input type="text" class="form-control" placeholder="Confirme sua senha:" name="csenha" id="cpass" required>
            </div>
            <input type="submit" value="Finalizar Cadastro">
        </form>
    </div>
</body>
</html>