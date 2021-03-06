<?php 

    include '../Backend/conexao.php';

    $query = $conn->prepare("SELECT * FROM usuarios WHERE chave = ?");
    $query->execute(array($_GET['key']));
        
    $resultado = $query->fetch(PDO::FETCH_ASSOC); 

    if($resultado['chave'] == $_GET['key']) {

        if(isset($_POST['senha'])) {

            $matricula = $_POST['matricula'];
            $senha = password_hash($_POST['senha'], PASSWORD_DEFAULT);

            $query = $conn->prepare("UPDATE usuarios SET senha = :s WHERE matricula = :m");
            $query->bindValue(":s",$senha);
            $query->bindValue(":m",$matricula);
            $query->execute();

            $query = $conn->prepare("UPDATE usuarios SET chave = :c WHERE matricula = :m");
            $query->bindValue(":c",$chave_vazia);
            $query->bindValue(":m",$matricula);
            $query->execute();
            header("location: ../index.php");
        }
    } else {
        header("location: ../index.php");
    }
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Enviar Nova Senha</title>

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

        <!-- Outer Row -->
        <div class="row justify-content-center">

            <div class="col-xl-10 col-lg-12 col-md-9">

                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row">
                            <div class="col-lg-6 d-none d-lg-block bg-password-image"></div>
                            <div class="col-lg-6">
                                <div class="p-5">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-2">Redifina Sua Senha</h1>
                                        <p class="mb-4"></p>
                                    </div>
                                    <form action="" method="POST" class="user">
                                        <input type="hidden" name="matricula" value="<?php echo $resultado['matricula'] ?>">
                                        <div class="form-group">
                                            <input type="password" class="form-control form-control-user" id="password" name="senha" placeholder="Digite Sua Nova Senha">
                                        </div>
                                        <div class="form-group">
                                            <input type="password" class="form-control form-control-user" id="confirm_password" name="csenha" placeholder="Confirme Sua Nova Senha">
                                        </div>
                                        <input type="submit" value="Alterar Senha" class="btn btn-primary btn-user btn-block">
                                    </form>
                                    <hr>
                                    <div class="text-center">
                                        <a class="small" href="cadastro.php">Cadastra-se!</a>
                                    </div>
                                    <div class="text-center">
                                        <a class="small" href="../index.php">J?? poss??i uma conta? Login!</a>
                                    </div>
                                </div>
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

    <!-- Valida????o de Confirma????o de Senha -->
    <script src="js/confirmarSenha.js"></script>
</body>

</html>