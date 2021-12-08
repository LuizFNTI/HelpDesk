<?php
    session_start();

    if(isset($_SESSION['usuario']) && is_array($_SESSION['usuario'])) {
        $matricula = $_SESSION['usuario'][0];
        $nome_usuario = $_SESSION['usuario'][2];
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
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
                <div class="sidebar-brand-icon rotate-n-15">
                    <i class="fas fa-laugh-wink"></i>
                </div>
                <div class="sidebar-brand-text mx-3">SB Admin <sup>2</sup></div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                USUÁRIO
            </div>

            <!-- Nav Item - Pages Collapse Menu -->

            <!-- Nav Item - Charts -->
            <li class="nav-item">
                <a class="nav-link" href="abrirChamado.php">
                    <i class="fas fa-fw fa-plus"></i>
                    <span>Abrir Chamado</span></a>
            </li>

            <!-- Nav Item - Tables -->
            <li class="nav-item active">
                <a class="nav-link" href="listaChamadoUsuario.php">
                    <i class="fas fa-fw fa-table"></i>
                    <span>Meus Chamados</span></a>
            </li>

            <li class="nav-item">
                <a class="nav-link collapsed" href="pesquisarChamado.php">
                    <i class="fas fa-fw fa-search"></i>
                    <span>Pesquisar Chamado</span>
                </a>
            </li>

            <div class="sidebar-heading">
                ANALISTA
            </div>

            <li class="nav-item">
                <a class="nav-link collapsed" href="listaChamadoAnalista.php">
                    <i class="fas fa-fw fa-list"></i>
                    <span>Atendimento Chamados</span>
                </a>
            </li>

            <div class="sidebar-heading">
                ADMINISTRADOR
            </div>

            <!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block">

            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>

        </ul>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                    <!-- Sidebar Toggle (Topbar) -->
                    <form class="form-inline">
                        <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                            <i class="fa fa-bars"></i>
                        </button>
                    </form>

                    <!-- Topbar Search -->
                    <form
                        class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
                        <div class="input-group">
                            <input type="text" class="form-control bg-light border-0 small" placeholder="Search for..."
                                aria-label="Search" aria-describedby="basic-addon2">
                            <div class="input-group-append">
                                <button class="btn btn-primary" type="button">
                                    <i class="fas fa-search fa-sm"></i>
                                </button>
                            </div>
                        </div>
                    </form>

                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">

                        <!-- Nav Item - Search Dropdown (Visible Only XS) -->
                        <li class="nav-item dropdown no-arrow d-sm-none">
                            <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-search fa-fw"></i>
                            </a>
                            <!-- Dropdown - Messages -->
                            <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in"
                                aria-labelledby="searchDropdown">
                                <form class="form-inline mr-auto w-100 navbar-search">
                                    <div class="input-group">
                                        <input type="text" class="form-control bg-light border-0 small"
                                            placeholder="Search for..." aria-label="Search"
                                            aria-describedby="basic-addon2">
                                        <div class="input-group-append">
                                            <button class="btn btn-primary" type="button">
                                                <i class="fas fa-search fa-sm"></i>
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </li>
                        
                        <div class="topbar-divider d-none d-sm-block"></div>

                        <!-- Nav Item - User Information -->
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small"><?php echo $nome_usuario; ?></span>
                                <img class="img-profile rounded-circle"
                                    src="img/undraw_profile.svg">
                            </a>
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="userDropdown">
                                <a class="dropdown-item" href="#">
                                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Profile
                                </a>
                                <a class="dropdown-item" href="#">
                                    <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Settings
                                </a>
                                <a class="dropdown-item" href="#">
                                    <i class="fas fa-list fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Activity Log
                                </a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Logout
                                </a>
                            </div>
                        </li>
                    </ul>
                </nav>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Meus Chamados Abertos</h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0" style="font-size: 14px;">
                                    <thead>
                                        <tr>
                                            <th>Chamado</th>
                                            <th>Tipo>Categoria>SubCategoria>Item</th>
                                            <th>Descrição</th>
                                            <th>Data Inicio</th>
                                            <th>Data Prazo</th>
                                            <th>Analista Respossável</th>
                                            <th>Status</th>
                                            <th>Ação</th>
                                        </tr>
                                    </thead>
                    <?php
                        
                        include '../Backend/conexao.php';

                        $dados = array();        

                        //Faz a consulta no banco
                        $query = $conn->prepare("SELECT * FROM chamados
                    INNER JOIN item ON item.cod_item = chamados.item_cod_item
                    INNER JOIN subcategoria ON subcategoria.cod_subcategoria = chamados.subcategoria_cod_subcategoria
                    INNER JOIN categoria ON categoria.cod_categoria = chamados.categoria_cod_categoria
                    INNER JOIN tipo ON tipo.cod_tipo = chamados.tipo_cod_tipo
                    INNER JOIN usuarios ON usuarios.matricula = chamados.usuarios_matricula
                    INNER JOIN prioridade_chamado ON prioridade_chamado.cod_prioridade = chamados.prioridade_chamado_cod_prioridade
                    INNER JOIN status_chamado ON status_chamado.cod_status = chamados.status_chamado_cod_status WHERE status_chamado_cod_status != 3 AND matricula = ?");
                    $query->execute(array($matricula));

                    echo "<tbody>";

                        //Joga os dados do banco num array e faz a leitura do array, jogando as informações no tabela
                        foreach($query->fetchAll(PDO::FETCH_ASSOC) as $dados) {
                            echo "<tr>";
                                echo "<th>".$dados['numero_chamado']."</th>";//Busca os dados na posiçãom do vetor
                                echo "<th>".$dados['nome_tipo'].">".$dados['nome_categoria'].">".$dados['nome_subcategoria'].">".$dados['nome_item']."</th>";
                                echo "<th>".$dados['descricao']."</th>";
                                echo "<th>".$dados['data_hora_abertura']."</th>";
                                echo "<th>".$dados['data_prazo']."</th>";
                                echo "<th>".$dados['analista']."</th>";
                                echo "<th>".$dados['nome_status']."</th>";
                                echo "<th><a href=verChamadoUsuario.php?nc_up=".$dados['numero_chamado'].">Editar</a><br>";
                                echo "<a href=cancelarChamado.php?nc_up=".$dados['numero_chamado'].">Cancelar</a></th>";
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
                    <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-primary" href="login.html">Logout</a>
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