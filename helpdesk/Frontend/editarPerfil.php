<?php
    session_start();

    if(isset($_SESSION['usuario']) && is_array($_SESSION['usuario'])) {
        $matricula_session = $_SESSION['usuario'][0];
        $nivel = $_SESSION['usuario'][1];
        $nome_usuario = $_SESSION['usuario'][2];
    } else {
        header("location: ../index.php");
    }

    include '../Backend/conexao.php';

    $resultado = array();

    //pega o codigo passado pela outra página via URL e atribui a uma variavel
    $matricula_up = $matricula_session;
        
    //Faz a consulta no banco de acordo com o codigo passado via URL
    $query = $conn->prepare("SELECT * FROM usuarios WHERE matricula = :m");
    $query->bindValue(":m",$matricula_up);
    $query->execute();
    $resultado = $query->fetch(PDO::FETCH_ASSOC);

    //Verifica se existe POST
    if(isset($_POST['nome'])) {

        //Pega os POSTs do formularios e atribue a variaveis
        $matricula = $_POST['mat'];
        $email = $_POST['email'];
        $telefone = $_POST['telefone'];
        $departamento = $_POST['departamento'];
        $novasenha = password_hash($_POST['senha'], PASSWORD_DEFAULT);
        
        //Faz o update no banco de acordo com o codigo passado via URL
        $query = $conn->prepare("UPDATE usuarios SET telefone = :t, email = :e, departamento = :d, senha = :ns WHERE matricula = :m");
        $query->bindValue(":t",$telefone);
        $query->bindValue(":e",$email);
        $query->bindValue(":d",$departamento);
        $query->bindValue(":m",$matricula);
        $query->execute();
    }
    if(isset($_POST['senhaatual'])) {
        if(password_verify($_POST['senhaatual'], $resultado['senha'])) {
            $query = $conn->prepare("UPDATE usuarios SET senha = :ns WHERE matricula = :m");
            $query->bindValue(":ns",$novasenha);
            $query->bindValue(":m",$matricula);
            $query->execute();
        } else {
            echo "<script>window.alert('Senha incorreta!')</script>";
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
    <title>Editar Perfil</title>

    <!-- Custom fonts for this template -->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">

    <!-- Custom styles for this page -->
    <link href="vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">

</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <?php include 'navbar.php'; ?>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Begin Page Content -->
                <div class="container-fluid" style="margin-top: 2%;">

                    <!-- Page Heading -->
                    <h1 class="h3 mb-2 text-gray-800">Editar Perfil</h1>

                    <div class="row justify-content-center align-items-center" style="margin-top: 100px;">
                        <form method="POST" action="" class="user">
                        <input type="hidden" name="mat" value="<?php echo $resultado['matricula']; ?>">
                            <div class="form-group row">
                                <div class="col-sm-6 mb-3 mb-sm-0">
                                    <div class="form-group">
                                        <label for="email">E-mail</label>
                                        <input type="text" class="form-control" placeholder="Seu E-mail:" name="email" id="ema" readonly value="<?php echo $resultado['email']; ?>">
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="Telefone">Telefone</label>
                                        <input type="text" class="form-control" placeholder="Seu Telefone:" name="telefone" id="fone" value="<?php echo $resultado['telefone']; ?>">
                                    </div>
                                </div>
                                <div class="col-sm-12 mb-3 mb-sm-0">
                                    <div class="form-group">
                                        <label for="dep">Departamento</label>
                                        <select class="form-control" id="cdd" name="departamento">
                                            <option>Selecione seu Departamento</option>
                                            <?php
                                                include '../Backend/conexao.php';

                                                $dados = array();        
                                    
                                                //Faz a consulta no banco
                                                $query = $conn->query("SELECT * FROM departamento ORDER BY nome_departamento");
                                    
                                                //Joga os dados do banco num array e faz a leitura do array jogando as informações no opition
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
                                </div>
                                <div class="col-sm-4 mb-3 mb-sm-0">
                                    <div class="form-group">
                                        <label for="senha">Senha Atual</label>
                                        <input type="text" class="form-control" placeholder="Digite sua senha atual:" name="senhaatual" id="pass">
                                    </div>
                                </div>
                                <div class="col-sm-4 mb-3 mb-sm-0">
                                    <div class="form-group">
                                        <label for="ns">Nova Senha</label>
                                        <input type="text" class="form-control" placeholder="Digite sua nova senha:" name="senha" id="password">
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label for="rns">Repita Nova Senha</label>
                                        <input type="text" class="form-control" placeholder="Confirme sua nova senha:" name="csenha" id="confirm_password">
                                    </div> 
                                </div>
                            </div>
                            <input type="submit" value="Enviar" class="btn btn-primary btn-block">
                        </form>
                    </div>
                </div>
                <!-- /.container-fluid -->
            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <?php include 'footer.php'; ?>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <?php include 'telaLogout.php'; ?>

    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>

    <!-- Validação de Confirmação de Senha -->
    <script src="js/confirmarSenha.js"></script>
    
</body>

</html>