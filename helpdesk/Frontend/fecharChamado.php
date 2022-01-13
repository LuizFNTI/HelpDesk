<?php
    session_start();

    if(isset($_SESSION['usuario']) && is_array($_SESSION['usuario'])) {
        $matricula = $_SESSION['usuario'][0];
        $nivel = $_SESSION['usuario'][1];
        $nome_usuario = $_SESSION['usuario'][2];
        $nome_analista = $_SESSION['usuario'][2];
    } else {
        header("location: ../index.php");
    }

    include '../Backend/conexao.php';

    $resultado = array();

    //Pega o codigo tipo pela URL
    $numero_chamado_up = $_GET['nc_up'];

    //Faz o select para passar os valores para o form
    $query = $conn->prepare("SELECT * FROM chamados WHERE numero_chamado = :nc");
    $query->bindValue(":nc",$numero_chamado_up);
    $query->execute();
    $resultado = $query->fetch(PDO::FETCH_ASSOC);

    //Verifica se existe POST
    if(isset($_POST['descanalista'])) {

        //Pega os POSTs do formularios e atribue a variaveis
        $numero_chamado = $_POST["vnc"];
        $descricao_analista = $_POST['descanalista'];
        $aberto = $_POST['aberto'];

        //Faz o update 
        $query = $conn->prepare("UPDATE chamados SET descricao_analista = :dn, data_hora_fechamento = NOW(), aberto = :stfinalizado WHERE numero_chamado = :nc");
        $query->bindValue(":dn",$descricao_analista);
        $query->bindValue(":stfinalizado",$aberto);
        $query->bindValue(":nc",$numero_chamado);
        $query->execute();
    }
    //caso a variavel seja nula, volta para a tela de gerenciamento
    if($numero_chamado_up == null) {
        header("location: listaChamadoAnalista.php");
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
    <title>Fechar Chamado</title>

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
                    <form action="fecharChamado.php" method="POST">
                        <input type="hidden" name="vnc" value="<?php echo $resultado['numero_chamado']; ?>">
                        <input type="hidden" name="aberto" value="3">
                        <div class="form-group">
                            <label for="descricao">Faça uma breve descrição sobre o encerramento:</label>
                            <textarea class="form-control" rows="5" placeholder="Descrição Analista:" id="descr" name="descanalista"></textarea>
                        </div>
                        <input type="submit" value="Encerrar" class="btn btn-primary btn-block">
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