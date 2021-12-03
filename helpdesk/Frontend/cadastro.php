<?php
include_once '../Backend/conexao.php';

//Verifica se existe POST
if(isset($_POST['nome'])) {

    //Pega os POSTs do form e atribui a variaveis
    $matricula = $_POST['mat'];
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $telefone = $_POST['telefone'];
    $departamento = $_POST['cdepartamento'];
    $senha = $_POST['senha'];

    //Criptografa a senha usando om password_hash
    $senha_hash = password_hash($senha, PASSWORD_DEFAULT);

    //Pega os POSTs das variaveis e insere os dados no banco
    $query = $conn->prepare("INSERT INTO usuarios (matricula, nome, telefone, email, departamento, senha) VALUES (:matricula, :nome, :telefone, :email, :departamento, :senha)");
    $query->bindValue(":matricula", $matricula);
    $query->bindValue(":nome",$nome);
    $query->bindValue(":telefone",$telefone);
    $query->bindValue(":email",$email);
    $query->bindValue(":departamento",$departamento);
    $query->bindValue(":senha",$senha_hash);
    $query->execute();
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
    <link rel="stylesheet" href="CSS/cadastro.css">
</head>
<body>
    <div class="row justify-content-center align-items-center" id="dp">
        <form action="cadastro.php" method="POST">
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
            <label for="tipodemanda">Selrcione o Seu Departamento</label>
            <select class="form-control" id="cdd" name="cdepartamento">
                <option>Selecione</option>
        <?php
            include '../Backend/conexao.php';

            $dados = array();        
                    
            //Faz a consulta no banco
            $query = $conn->query("SELECT * FROM departamento ORDER BY nome_departamento");
                    
            //Joga os dados do banco num array e faz a leitura do array jogando as informações no opition
            foreach($query->fetchAll(PDO::FETCH_ASSOC) as $dados) {
                echo "<option value=".$dados['cod_departamento'].">".$dados['nome_departamento']."</option>";
            }
        ?>
            </select>
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