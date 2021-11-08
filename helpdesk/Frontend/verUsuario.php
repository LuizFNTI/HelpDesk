<?php
    include '../Backend/conexao.php';

    $resultado = array();

    $matricula = $_GET['matricula_up'];
        
    $query = $conn->prepare("SELECT * FROM usuarios WHERE matricula = :m");
    $query->bindValue(":m",$matricula);
    $query->execute();
    $resultado = $query->fetch(PDO::FETCH_ASSOC);
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
        <form method="POST" action="../Backend/atualizarDadosUsuarios.php">
        <h2>Editar Usuário</h2>
        <div id="df1">
            <div class="form-group">
                <label for="mat">Número Matricula:</label>
                <input type="text" class="form-control" placeholder="Matricula" name="mat" id="matr" required value="<?php if(isset($resultado)) {echo $resultado['matricula'];} ?>">
            </div>
            <div class="form-group">
                <label for="email">Endereço de E-mail:</label>
                <input type="text" class="form-control" placeholder="Seu E-mail:" name="email" id="e-mail" required value="<?php if(isset($resultado)) {echo $resultado['email'];} ?>">
            </div>
        </div>
        <div id="df1">
        <div class="form-group">
                <label for="nome">Nome Completo::</label>
                <input type="text" class="form-control" placeholder="Seu Nome:" name="nome" id="nme" required value="<?php if(isset($resultado)) {echo $resultado['nome'];} ?>">
            </div>
            <div class="form-group">
                <label for="telefone">Telefone:</label>
                <input type="text" class="form-control" placeholder="Seu Telefone:" name="telefone" id="fone" required value="<?php if(isset($resultado)) {echo $resultado['telefone'];} ?>">
            </div>
        </div>
            <div class="form-group">
                <label for="departamento">Departamento:</label>
                <input type="text" class="form-control" placeholder="Seu Departamento:" name="departamento" id="dept" required value="<?php if(isset($resultado)) {echo $resultado['departamento'];} ?>">
            </div>
            <div class="form-group">
                <label for="Nivelac">Nivel Acesso:</label><br>
                <select class="form-control" id="nv" name="nivel">
                    <option value="0" <?php if($resultado['nivel'] == 0) {echo "selected";}?>>Usuário</option>
                    <option value="1" <?php if($resultado['nivel'] == 1) {echo "selected";}?>>Analista</option>
                    <option value="2" <?php if($resultado['nivel'] == 2) {echo "selected";}?>>Administrador</option>
                </select>
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
    </div>
</body>
</html>