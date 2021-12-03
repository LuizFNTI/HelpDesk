<?php
    include '../Backend/conexao.php';

    $resultado = array();

    //pega o codigo passado pela outra página via URL e atribui a uma variavel
    $matricula_up = $_GET['matricula_up'];
        
    //Faz a consulta no banco de acordo com o codigo passado via URL
    $query = $conn->prepare("SELECT * FROM usuarios WHERE matricula = :m");
    $query->bindValue(":m",$matricula_up);
    $query->execute();
    $resultado = $query->fetch(PDO::FETCH_ASSOC);

    //Verifica se existe POST
    if(isset($_POST['nome'])) {

        //Pega os POSTs do formularios e atribue a variaveis
        $matricula = $_POST['mat'];
        $nome = $_POST['nome'];
        $email = $_POST['email'];
        $telefone = $_POST['telefone'];
        $departamento = $_POST['departamento'];
        $nivel = $_POST['nivel'];
        $ativo = $_POST['ativo'];
        
        //Faz o update no banco de acordo com o codigo passado via URL
        $query = $conn->prepare("UPDATE usuarios SET nome = :n, telefone = :t, email = :e, departamento = :d, nivel = :nv, ativo = :a WHERE matricula = :m");
        $query->bindValue(":n",$nome);
        $query->bindValue(":t",$telefone);
        $query->bindValue(":e",$email);
        $query->bindValue(":d",$departamento);
        $query->bindValue(":m",$matricula);
        $query->bindValue(":nv",$nivel);
        $query->bindValue(":a",$ativo);
        $query->execute();
    }
    //Após o update a variavel passada pela URL fica nula, por isso é feita a verificação para voltar a página
    if($matricula_up == null) {
        header("location: gerenciarUsuarios.php");
    }
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
        <form method="POST" action="verUsuario.php">
        <h2>Editar Usuário</h2>
        <div id="df1">
            <div class="form-group">
                <label for="mat">Número Matricula:</label>
                <input type="text" class="form-control" placeholder="Matricula" name="mat" id="matr" required value="<?php if(isset($resultado)) {echo $resultado['matricula'];}//passa o valor para o formulario ?>">
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
            <label for="status">Selrcione o status</label>
            <select class="form-control" id="cds" name="status">
        <?php
            include '../Backend/conexao.php';

            $dados = array();        
                    
            //Faz a consulta no banco
            $query = $conn->query("SELECT * FROM departamento");
                    
            //Joga os dados do banco num array e faz a leitura do array jogando as informações opition
            foreach($query->fetchAll(PDO::FETCH_ASSOC) as $dados) {
                if($dados['cod_departamento'] == $resultado['cod_departamento']) {
                    echo "<option selected value=".$dados['cod_departamento'].">".$dados['nome_departamento']."</option>";
                } else {
                    echo "<option value=".$dados['cod_departamento'].">".$dados['nome_departamento']."</option>";
                }
            }
        ?>
            </select>
        </div>
            <div class="form-group">
                <label for="Nivelac">Nivel Acesso:</label><br>
                <select class="form-control" id="nv" name="nivel">
                    <option value="0" <?php if($resultado['nivel'] == 0) {echo "selected";}?>>Usuário</option>
                    <option value="1" <?php if($resultado['nivel'] == 1) {echo "selected";}?>>Analista</option>
                    <option value="2" <?php if($resultado['nivel'] == 2) {echo "selected";}?>>Administrador</option><!--Verifica qual a situação no banco para fazer a seleção no opition-->
                </select>
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
    </div>
</body>
</html>