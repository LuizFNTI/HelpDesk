<?php

    session_start();

    if(isset($_SESSION['usuario']) && is_array($_SESSION['usuario'])) {
        if($_SESSION['usuario'][1] == 2) {
            $matricula = $_SESSION['usuario'][0];
            $nivel = $_SESSION['usuario'][1];
            $nome_usuario = $_SESSION['usuario'][2];
        } else {
            header("location: ../index.php");
        }
    } else {
        header("location: ../index.php");
    }

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
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Editar Usuário</title>

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
                    <form method="POST" action="verUsuario.php" class="user">
                    <h2>Editar Usuário</h2>
                    <div class="form-group row">
                        <div class="col-sm-6 mb-3 mb-sm-0">
                            <div class="form-group">
                                <label for="mat">Número Matricula:</label>
                                <input type="text" class="form-control" placeholder="Matricula" name="mat" id="matr" required value="<?php if(isset($resultado)) {echo $resultado['matricula'];}//passa o valor para o formulario ?>">
                            </div>
                        </div>
                        <div class="col-sm-6 mb-3 mb-sm-0">
                            <div class="form-group">
                                <label for="email">Endereço de E-mail:</label>
                                <input type="text" class="form-control" placeholder="Seu E-mail:" name="email" id="e-mail" required value="<?php if(isset($resultado)) {echo $resultado['email'];} ?>">
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-6 mb-3 mb-sm-0">
                            <div class="form-group">
                                <label for="nome">Nome Completo::</label>
                                <input type="text" class="form-control" placeholder="Seu Nome:" name="nome" id="nme" required value="<?php if(isset($resultado)) {echo $resultado['nome'];} ?>">
                            </div>
                        </div>
                        <div class="col-sm-6 mb-3 mb-sm-0">
                            <div class="form-group">
                                <label for="telefone">Telefone:</label>
                                <input type="text" class="form-control" placeholder="Seu Telefone:" name="telefone" id="fone" required value="<?php if(isset($resultado)) {echo $resultado['telefone'];} ?>">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="status">Selrcione o Departamento</label>
                        <select class="form-control" id="cds" name="departamento">
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
                    <div class="form-group row">
                        <div class="col-sm-6 mb-3 mb-sm-0">
                            <div class="form-group">
                                <label for="Nivelac">Nivel Acesso:</label><br>
                                <select class="form-control" id="nv" name="nivel">
                                    <option value="0" <?php if($resultado['nivel'] == 0) {echo "selected";}?>>Usuário</option>
                                    <option value="1" <?php if($resultado['nivel'] == 1) {echo "selected";}?>>Analista</option>
                                    <option value="2" <?php if($resultado['nivel'] == 2) {echo "selected";}?>>Administrador</option><!--Verifica qual a situação no banco para fazer a seleção no opition-->
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-6 mb-3 mb-sm-0">
                            <div class="form-group">
                                <label for="ativo">Ativo:</label><br>
                                <select class="form-control" id="atv" name="ativo">
                                    <option value="0" <?php if($resultado['ativo'] == 0) {echo "selected";}?>>Inativo</option>
                                    <option value="1" <?php if($resultado['ativo'] == 1) {echo "selected";}?>>Ativo</option><!--Verifica qual a situação no banco para fazer a seleção no opition-->
                                </select>
                            </div>
                        </div>
                    </div>
                    <input type="submit" value="Enviar" class="btn btn-primary btn-block">
                    </form>
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

</body>

</html>