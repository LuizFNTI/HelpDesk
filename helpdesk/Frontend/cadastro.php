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
    $confsenha = $_POST['csenha'];

    if($senha == $confsenha) {
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
    } else if($senha != $confsenha){
        echo "<script>window.alert('As senhas não coferem')</script>";
    }
}
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>SB Admin 2 - Register</title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">

</head>

<body class="bg-gradient-primary">

    <div class="container">

        <div class="card o-hidden border-0 shadow-lg my-5">
            <div class="card-body p-0">
                <!-- Nested Row within Card Body -->
                <div class="row">
                    <div class="col-lg-5 d-none d-lg-block"></div>
                    <div class="col-lg-7">
                        <div class="p-5">
                            <div class="text-center">
                                <h1 class="h4 text-gray-900 mb-4">Crie Sua Conta!</h1>
                            </div>
                            <form class="user" action="cadastro.php" method="POST">
                                <div class="form-group row">
                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                        <div class="form-group">
                                            <input type="text" class="form-control form-control-user" placeholder="Matricula" name="mat" id="matr" required>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                        <div class="form-group">
                                            <input type="text" class="form-control form-control-user" placeholder="Seu E-mail:" name="email" id="e-mail" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                        <div class="form-group">
                                            <input type="text" class="form-control form-control-user" placeholder="Seu Nome:" name="nome" id="nme" required>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                        <div class="form-group">
                                            <input type="text" class="form-control form-control-user" placeholder="Seu Telefone:" name="telefone" id="fone" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <select class="form-control" id="cdd" name="cdepartamento">
                                        <option>Selecione seu Departamento</option>
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
                                <div class="form-group row">
                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                        <div class="form-group">
                                            <input type="text" class="form-control form-control-user" placeholder="Digite su senha:" name="senha" id="pass" required>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                        <div class="form-group">
                                            <input type="text" class="form-control form-control-user" placeholder="Confirme sua senha:" name="csenha" id="cpass" required>
                                        </div>
                                    </div>
                                </div>
                                <input type="submit" value="Cadastrar" class="btn btn-primary btn-user btn-block">
                            </form>
                            <hr>
                            <div class="text-center">
                                <a class="small" href="recuperarSenha.php">Esqueceu a Senha?</a>
                            </div>
                            <div class="text-center">
                                <a class="small" href="index.php">Já Tem Uma Conta? Login!</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>

</body>

</html>