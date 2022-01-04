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
    if(isset($_POST['nome']) && password_verify($_POST['senha'], $resultado['senha'])) {

        //Pega os POSTs do formularios e atribue a variaveis
        $matricula = $_POST['mat'];
        $email = $_POST['email'];
        $telefone = $_POST['telefone'];
        $departamento = $_POST['departamento'];
        
        //Faz o update no banco de acordo com o codigo passado via URL
        $query = $conn->prepare("UPDATE usuarios SET telefone = :t, email = :e, departamento = :d WHERE matricula = :m");
        $query->bindValue(":t",$telefone);
        $query->bindValue(":e",$email);
        $query->bindValue(":d",$departamento);
        $query->bindValue(":m",$matricula);
        $query->execute();
    } else {
        
    }
    //Após o update a variavel passada pela URL fica nula, por isso é feita a verificação para voltar a página
    if($matricula_up == null) {
        header("location: gerenciarUsuarios.php");
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
    <title>SB Admin 2 - Tables</title>

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

                <!-- Topbar -->
                <?php include 'topbar.php'; ?>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <h1 class="h3 mb-2 text-gray-800">Editar Perfil</h1>

                    <div class="row justify-content-center align-items-center" style="margin-top: 100px;">
                        <form action="editarPerfil.php" method="POST" class="user">
                            <div class="form-group row">
                                <div class="col-sm-6 mb-3 mb-sm-0">
                                    <div class="form-group">
                                        <label for="email">E-mail</label>
                                        <input type="text" class="form-control" placeholder="Seu E-mail:" name="email" id="ema" value="<?php echo $resultado['email']; ?>">
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
                                        <input type="text" class="form-control" placeholder="Digite sua senha atual:" name="senha" id="pass">
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
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy; Prefeitura Municipal de Telêmaco Borba</span>
                    </div>
                </div>
            </footer>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Sair?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Tem Certeza que deseja sair?</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancelar</button>
                    <a class="btn btn-primary" href="../Backend/logout.php">Logout</a>
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

    <!-- Validação de Confirmação de Senha -->
    <script src="JS/confirmarSenha.js"></script>
    
</body>

</html>