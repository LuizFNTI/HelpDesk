<?php
    include 'conexão.php';

    $resultado = array();
        
    $query = $conn->prepare("SELECT * FROM usuarios WHERE matricula = :m");
    $query->bindValue(":m",$matricula);
    $query->execute();
    $query = $cmd->fetch(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="CSS/verUsuario.css">
    
</head>
<body>
    <div class="row justify-content-center align-items-center" id="dp">
        <form action="Backend/validar_login.php" method="POST">
        <h2>Cadastro</h2>
        <div id="df1">
            <div class="form-group">
                <label for="mat">Número Matricula:</label>
                <input type="text" class="form-control" placeholder="Matricula" name="mat" id="matr" required value="<?php if(isset($dados)) {echo $dados['matricula'];} ?>">
            </div>
            <div class="form-group">
                <label for="email">Endereço de E-mail:</label>
                <input type="text" class="form-control" placeholder="Seu E-mail:" name="email" id="e-mail" required value="<?php if(isset($dados)) {echo $dados['email'];} ?>">
            </div>
        </div>
        <div id="df1">
        <div class="form-group">
                <label for="nome">Nome Completo::</label>
                <input type="text" class="form-control" placeholder="Seu Nome:" name="nome" id="nme" required value="<?php if(isset($dados)) {echo $dados['nome'];} ?>">
            </div>
            <div class="form-group">
                <label for="telefone">Telefone:</label>
                <input type="text" class="form-control" placeholder="Seu Telefone:" name="telefone" id="fone" required value="<?php if(isset($dados)) {echo $dados['telefone'];} ?>">
            </div>
        </div>
            <div class="form-group">
                <label for="departamento">Departamento:</label>
                <input type="text" class="form-control" placeholder="Seu Departamento:" name="departamento" id="dept" required value="<?php if(isset($dados)) {echo $dados['departamento'];} ?>">
            </div>
            <p>Nivel de Acesso:</p>
            <div class="form-check-inline">  
                <label class="form-check-label">
                <input type="radio" class="form-check-input" name="user">Usuário
            </label>
            </div>
            <div class="form-check-inline">
                <label class="form-check-label">
                <input type="radio" class="form-check-input" name="analista">Analista
            </label>
            </div>
            <div class="form-check-inline">
                <label class="form-check-label">
                <input type="radio" class="form-check-input" name="adm">Administrador
            </label>
            </div><br><br>
            <p>Ativo: </p>
            <div class="form-check-inline">  
                <label class="form-check-label">
                <input type="radio" class="form-check-input" name="ativo">Sim
            </label>
            </div>
            <div class="form-check-inline">
                <label class="form-check-label">
                <input type="radio" class="form-check-input" name="nativo">Não
            </label>
            </div><br><br>
            <button type="button" class="btn btn-success">Guardar</button><br>
        </form>
    </div>
</body>
</html>