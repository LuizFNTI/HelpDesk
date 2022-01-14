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

    //Pega o codigo tipo pela URL
    $cod_tipo_up = $_GET['tipo_up'];
        
    //Faz o select para passar os valores para o form
    $query = $conn->prepare("SELECT * FROM tipo WHERE cod_tipo = :ct");
    $query->bindValue(":ct",$cod_tipo_up);
    $query->execute();
    $resultado = $query->fetch(PDO::FETCH_ASSOC);

    //Verifica se existe POST
    if(isset($_POST['vert'])) {

        //Pega os POSTs do formularios e atribue a variaveis
        $cod_tipo = $_POST['verct'];
        $nome_tipo = $_POST['vert'];
        $ativo = $_POST['ativo'];
        
        //Faz o update 
        $query = $conn->prepare("UPDATE tipo SET nome_tipo = :nt, ativo = :a WHERE cod_tipo = :ct");
        $query->bindValue(":nt",$nome_tipo);
        $query->bindValue(":a",$ativo);
        $query->bindValue(":ct",$cod_tipo);
        $query->execute();
    }
    //caso a variavel seja nula, volta para a tela de gerenciamento
    if($cod_tipo_up == null) {
        header("location: gerenciarAberturaChamados.php");
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
    <title>Editar Tipo</title>

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
                            <form action="adicionarTipo.php" method="POST" class="user">
                            <h2>Editar Tipo</h2>
                            <!--form para passar o cod-tipo via POST para fazer o updadate-->  
                            <input type="hidden" name="verct" id="vct" value="<?php echo $resultado['cod_tipo']; ?>">
                                <div class="form-group">
                                    <label for="ntipo">Tipo</label>
                                    <input type="text" class="form-control" placeholder="Novo Tipo:" name="novot" id="nt" value="<?php if(isset($resultado)) {echo $resultado['nome_tipo'];} ?>">
                                </div>
                                <div class="form-group">
                                    <label for="ativo">Ativo:</label><br>
                                    <select class="form-control" id="atv" name="ativo">
                                        <option value="0" <?php if($resultado['ativo'] == 0) {echo "selected";}?>>Inativo</option>
                                        <option value="1" <?php if($resultado['ativo'] == 1) {echo "selected";}?>>Ativo</option>
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