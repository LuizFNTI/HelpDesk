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

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <?php include 'topbar.php'; ?>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Visão Geral</h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTableVisaoGeral" width="100%" cellspacing="0" style="font-size: 14px;">
                                    <thead>
                                        <tr>
                                            <th>Tipo</th>
                                            <th>Categoria</th>
                                            <th>SubCategoria</th>
                                            <th>Item</th>
                                        </tr>
                                    </thead>
                    <?php
                        
                        include '../Backend/conexao.php';

                        $dados = array();        

                        //Faz a consulta no banco
                        $query = $conn->query("SELECT tipo.nome_tipo, categoria.nome_categoria, subcategoria.nome_subcategoria, item.nome_item FROM item INNER JOIN subcategoria ON subcategoria.cod_subcategoria = item.subcategoria_cod_subcategoria INNER JOIN categoria ON categoria.cod_categoria = subcategoria.categoria_cod_categoria INNER JOIN tipo ON tipo.cod_tipo = categoria.tipo_cod_tipo");

                    echo "<tbody>";

                        //Joga os dados do banco num array e faz a leitura do array, jogando as informações no tabela
                        foreach($query->fetchAll(PDO::FETCH_ASSOC) as $dados) {
                            echo "<tr>";
                                echo "<th>".$dados['nome_tipo']."</th>";//Busca os dados na posiçãom do vetor
                                echo "<th>".$dados['nome_categoria']."</th>";
                                echo "<th>".$dados['nome_subcategoria']."</th>";
                                echo "<th>".$dados['nome_item']."</th>";
                            echo "</tr>";
                        }
                    ?>
                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.container-fluid -->

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Gerenciar Status</h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTableStatus" width="100%" cellspacing="0" style="font-size: 14px;">
                                    <thead>
                                        <tr>
                                            <th>Codigo</th>
                                            <th>Status</th>
                                            <th>Ativo</th>
                                            <th>Ação</th>
                                        </tr>
                                    </thead>
                    <?php
                        
                        include '../Backend/conexao.php';

                        $dados = array();        

                        //Faz a consulta no banco
                        $query = $conn->query("SELECT * FROM status_chamado ORDER BY nome_status");

                    echo "<tbody>";

                        //Joga os dados do banco num array e faz a leitura do array, jogando as informações no tabela
                        foreach($query->fetchAll(PDO::FETCH_ASSOC) as $dados) {
                            echo "<tr>";
                                echo "<th>".$dados['cod_status']."</th>";//Busca os dados na posiçãom do vetor
                                echo "<th>".$dados['nome_status']."</th>";
                                if($dados['ativo'] == 1) {echo "<th>Ativo</th>";} else {echo "<th>Inativo</th>";}
                                echo "<th><a href=verStatus.php?status_up=".$dados['cod_status'].">Ver</a></th>";
                            echo "</tr>";
                        }
                    ?>
                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                </div>
                <!-- /.container-fluid -->

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Gerenciar Tipo Atendimento</h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTableTipoAtendimento" width="100%" cellspacing="0" style="font-size: 14px;">
                                    <thead>
                                        <tr>
                                            <th>Codigo</th>
                                            <th>Tipo Atendimento</th>
                                            <th>Ativo</th>
                                            <th>Ação</th>
                                        </tr>
                                    </thead>
                    <?php
                        
                        include '../Backend/conexao.php';

                        $dados = array();        

                        //Faz a consulta no banco
                        $query = $conn->query("SELECT * FROM tipo_atendimento ORDER BY nome_tipo_atendimento");

                    echo "<tbody>";

                        //Joga os dados do banco num array e faz a leitura do array, jogando as informações no tabela
                        foreach($query->fetchAll(PDO::FETCH_ASSOC) as $dados) {
                            echo "<tr>";
                                echo "<th>".$dados['cod_tipo_atendimento']."</th>";//Busca os dados na posiçãom do vetor
                                echo "<th>".$dados['nome_tipo_atendimento']."</th>";
                                if($dados['ativo'] == 1) {echo "<th>Ativo</th>";} else {echo "<th>Inativo</th>";}
                                echo "<th><a href=verTipoAtendimento.php?tipoa_up=".$dados['cod_tipo_atendimento'].">Ver</a></th>";
                            echo "</tr>";
                        }
                    ?>
                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.container-fluid -->

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Gerenciar Prioridade</h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTablePrioridade" width="100%" cellspacing="0" style="font-size: 14px;">
                                    <thead>
                                        <tr>
                                            <th>Codigo</th>
                                            <th>Prioridade</th>
                                            <th>Ativo</th>
                                            <th>Ação</th>
                                        </tr>
                                    </thead>
                    <?php
                        
                        include '../Backend/conexao.php';

                        $dados = array();        

                        //Faz a consulta no banco
                        $query = $conn->query("SELECT * FROM prioridade_chamado ORDER BY nome_prioridade");

                    echo "<tbody>";

                        //Joga os dados do banco num array e faz a leitura do array, jogando as informações no tabela
                        foreach($query->fetchAll(PDO::FETCH_ASSOC) as $dados) {
                            echo "<tr>";
                                echo "<th>".$dados['cod_prioridade']."</th>";//Busca os dados na posiçãom do vetor
                                echo "<th>".$dados['nome_prioridade']."</th>";
                                if($dados['ativo'] == 1) {echo "<th>Ativo</th>";} else {echo "<th>Inativo</th>";}
                                echo "<th><a href=verPrioridade.php?prioridade_up=".$dados['cod_prioridade'].">Ver</a></th>";
                            echo "</tr>";
                        }
                    ?>
                    </tbody>
                                </table>
                            </div>
                        </div>
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

    <!-- Logout Modal-->
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

    <!-- Page level plugins -->
    <script src="vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="js/demo/datatables-demo.js"></script>

</body>

</html>