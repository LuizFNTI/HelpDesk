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

include_once '../Backend/conexao.php';

//Verifica se existe POST
if(isset($_POST['novacat'])) {

    //Pega os POSTs do form e atribui a variaveis
    $categoria = $_POST['novacat'];
    $ativo = $_POST['ativo'];
    $cod_tipo = $_POST['ctipo']; 

    //faz a insert no banco
    $query = $conn->prepare("INSERT INTO categoria (nome_categoria, ativo, tipo_cod_tipo) VALUES (:novac, :atv, :tcd)");
    $query->bindValue(":novac",$categoria);
    $query->bindValue(":atv",$ativo);
    $query->bindValue(":tcd",$cod_tipo);
    $query->execute();

    echo "<script>window.alert('O cadastro foi realizado com sucesso no sistema!')</script>";
    echo "<script>window.location.href = 'gerenciarAberturaChamados.php'</script>";
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
<title>Adicionar Categoria</title>

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

                <div class="row justify-content-center align-items-center" style="margin-top: 120px;">
                    <div id="form1">
                    <form action="" method="POST">
                    <h2>Cadastrar Nova Categoria</h2>
                    <div class="form-group">
                        <label for="tipodemanda">Selrcione o Tipo de Demanda que Deseja Vincular a Esta Categoria</label>
                        <select class="form-control" id="cdt" name="ctipo">
                    <?php
                        include '../Backend/conexao.php';

                        $dados = array();        
                    
                        //Faz a consulta no banco
                        $query = $conn->query("SELECT cod_tipo, nome_tipo FROM tipo ORDER BY nome_tipo");
                    
                        //Joga os dados do banco num array e faz a leitura do array jogando as informações no opition
                        foreach($query->fetchAll(PDO::FETCH_ASSOC) as $dados) {
                            echo "<option value=".$dados['cod_tipo'].">".$dados['nome_tipo']."</option>";
                        }
                    ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="ncat">Digite a Nova Categoria</label>
                        <input type="text" class="form-control" placeholder="Nova Categoria:" name="novacat" id="nc" required>
                    </div>
                    <div class="form-group">
                        <label for="ativo">Ativo:</label><br>
                        <select class="form-control" id="atv" name="ativo">
                            <option value="0">Inativo</option>
                            <option value="1">Ativo</option>
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