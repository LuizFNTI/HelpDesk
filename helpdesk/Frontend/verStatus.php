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
    $cod_status_up = $_GET['status_up'];
        
    //Faz a consulta no banco de acordo com o codigo passado via URL
    $query = $conn->prepare("SELECT * FROM status_chamado WHERE cod_status = :cs");
    $query->bindValue(":cs",$cod_status_up);
    $query->execute();
    $resultado = $query->fetch(PDO::FETCH_ASSOC);

    //Verifica se existe POST
    if(isset($_POST['verst'])) {

        //Pega os POSTs do formularios e atribue a variaveis
        $cod_status = $_POST['vercs'];
        $nome_status = $_POST['verst'];
        $ativo = $_POST['ativo'];
        
        //Faz o update no banco de acordo com o codigo passado via URL
        $query = $conn->prepare("UPDATE status_chamado SET nome_status = :ns,  ativo = :a WHERE cod_status = :cs");
        $query->bindValue(":ns",$nome_status);
        $query->bindValue(":a",$ativo);
        $query->bindValue(":cs",$cod_status);
        $query->execute();

        echo "<script>window.alert('Atualização realizada com sucesso')</script>";
        echo "<script>window.location.href = 'gerenciarStatus.php'</script>";
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
    <title>Editar Status</title>

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

                <div class="row justify-content-center align-items-center" style="margin-top: 120px;">
                    <div id="form1">
                        <form action="" method="POST">
                        <h2>Editar Status</h2>
                        <div class="form-group">
                        <!--Passa o codigo via POST para ser possivel realizar o update-->
                            <input type="hidden" class="form-control" name="vercs" id="vcs" required value="<?php if(isset($resultado)) {echo $resultado['cod_status'];} ?>">
                        </div>
                        <div class="form-group">
                            <label for="nstatus">Status</label>
                            <input type="text" class="form-control" placeholder="Status:" name="verst" id="vst" required value="<?php if(isset($resultado)) {echo $resultado['nome_status'];}//passa o valor para o formulario ?>">
                        </div>
                        <div class="form-group">
                            <label for="ativo">Ativo:</label><br>
                            <select class="form-control" id="atv" name="ativo">
                                <option value="0" <?php if($resultado['ativo'] == 0) {echo "selected";}?>>Inativo</option>
                                <option value="1" <?php if($resultado['ativo'] == 1) {echo "selected";}?>>Ativo</option><!--Verifica qual a situação no banco para fazer a seleção no opition-->
                            </select>
                        </div>
                        <input type="submit" value="Enviar" class="btn btn-primary btn-block">
                        </form>
                    </div> <!--form1-->
                </div> <!--dpc-->
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