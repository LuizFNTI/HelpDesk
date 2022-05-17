<?php
include_once '../Backend/conexao.php';

session_start();

if(isset($_SESSION['usuario']) && is_array($_SESSION['usuario'])) {
    $matricula = $_SESSION['usuario'][0];
    $nivel = $_SESSION['usuario'][1];
    $nome_usuario = $_SESSION['usuario'][2];
} else {
    header("location: ../index.php");
}

//Verifica se existe POST
if(isset($_POST['descricao'])) {

    //Pega os POSTs do form e atribui a variaveis
    $tipo = $_POST['ctipo'];
    $categoria = $_POST['ccat'];
    $subcategoria = $_POST['cscat'];
    $item = $_POST['item']; 
    $localizacao = $_POST['localizacao'];
    $descricao = $_POST['descricao'];
    $status = $_POST['status'];
    $prioridade = $_POST['prioridade'];
    $tipo_atendimento = $_POST['tipoa'];

    //faz a consulta no banco
    $query = $conn->prepare("INSERT INTO chamados (localizacao, descricao, data_hora_abertura, usuarios_matricula, status_chamado_cod_status, prioridade_chamado_cod_prioridade, tipo_atendimento_cod_tipo_atendimento, tipo_cod_tipo, categoria_cod_categoria, subcategoria_cod_subcategoria, item_cod_item) VALUES (:locali, :descr, NOW(), :mat, :sts, :pri, :tpa, :tipo, :categoria, :subcat, :item)");
    $query->bindValue(":locali",$localizacao);
    $query->bindValue(":descr",$descricao);
    $query->bindValue("mat",$matricula);
    $query->bindValue(":sts",$status);
    $query->bindValue(":pri",$prioridade);
    $query->bindValue(":tpa",$tipo_atendimento);
    $query->bindValue(":tipo",$tipo);
    $query->bindValue(":categoria",$categoria);
    $query->bindValue(":subcat",$subcategoria);
    $query->bindValue(":item",$item);
    $query->execute();

    echo "<script>window.alert('Seu chamado foi aberto no sistema, em breve será atendido por um de nossos analistas!')</script>";
    echo "<script>window.location.href = 'listaChamadoUsuario.php'</script>";
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
    <title>Abrir Chamado</title>

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

        <?php include 'navbar.php'; ?>

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Begin Page Content -->
                <div class="container-fluid" style="margin-top: 2%;">

                    <!-- Page Heading -->
                    <h1 class="h3 mb-2 text-gray-800">Abrir Novo Chamado</h1>
                    <p class="mb-4">Selecione as opções que melhor se encaixão a sua solicitação</p>

                    <form action="" method="POST" class="user">
                        <div class="form-group row">
                            <input type="hidden" name="status" value="1">
                            <input type="hidden" name="prioridade" value="1">
                            <input type="hidden" name="tipoa" value="1">
                            <div class="col">
                                <div class="container-sm">
                                    <?php 
                                        include 'carregarTipo.php';
                                        include 'carregarCategoria.php';
                                        include 'carregarSubCat.php';
                                        include 'carregarItem.php'; 
                                    ?>
                                </div>
                            </div>
                            <div style="height: 400px; border-left: 1px solid;"></div>
                            <div class="col">
                                <div class="container-sm">
                                    <div class="form-group">
                                        <label for="descricao">Localização:</label>
                                        <input class="form-control" placeholder="Local do Equipamamento:" id="local" name="localizacao" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="descricao">Faça uma breve descrição da sua solicitação:</label>
                                        <textarea class="form-control" rows="8" placeholder="Descrição:" id="descr" name="descricao" required></textarea>
                                    </div>
                                    <input type="submit" value="Enviar" class="btn btn-primary btn-block"> 
                                </div>   
                            </div>
                        </div>
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

    <!-- Ajax -->
    <script src="js/ajaxCategoria.js"></script>
    <script src="js/ajaxSubCat.js"></script>
    <script src="js/ajaxItem.js"></script>

    <!--Active Navbar-->
    <script>$("#abrirChamado").addClass("active")</script>
</body>

</html>