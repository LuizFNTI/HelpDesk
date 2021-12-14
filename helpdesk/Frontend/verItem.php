<?php

    session_start();

    if(isset($_SESSION['usuario']) && is_array($_SESSION['usuario'])) {
        if($_SESSION['usuario'][1] == 2) {
            $matricula = $_SESSION['usuario'][0];
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
    $cod_item_up = $_GET['item_up'];
        
    //Faz a consulta no banco de acordo com o codigo passado via URL
    $query = $conn->prepare("SELECT item.cod_item, item.nome_item, subcategoria.nome_subcategoria, categoria.nome_categoria, tipo.nome_tipo, item.ativo FROM item INNER JOIN subcategoria ON subcategoria.cod_subcategoria = item.subcategoria_cod_subcategoria INNER JOIN categoria ON categoria.cod_categoria = subcategoria.categoria_cod_categoria INNER JOIN tipo ON tipo.cod_tipo = categoria.tipo_cod_tipo WHERE cod_item = :ci");
    $query->bindValue(":ci",$cod_item_up);
    $query->execute();
    $resultado = $query->fetch(PDO::FETCH_ASSOC);

    //Verifica se existe POST
    if(isset($_POST['veritem'])) {

        //Pega os POSTs do formularios e atribue a variaveis
        $cod_item = $_POST['verci'];
        $nome_categoria = $_POST['veritem'];
        $ativo = $_POST['ativo'];
        
        //Faz o update no banco de acordo com o codigo passado via URL
        $query = $conn->prepare("UPDATE item SET nome_item = :ni, ativo = :a WHERE cod_item = :ci");
    
        $query->bindValue(":ni",$nome_item);
        $query->bindValue(":a",$ativo);
        $query->bindValue(":ci",$cod_item);
        $query->execute();
    }
    //Após o update a variavel passada pela URL fica nula, por isso é feita a verificação para voltar a página
    if($cod_item_up == null) {
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
            <li class="nav-item">
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

            <li class="nav-item">
                <a class="nav-link collapsed" href="gerenciarUsuarios.php">
                    <i class="fas fa-fw fa-user"></i>
                    <span>Gerenciar Usuários</span>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages"
                    aria-expanded="true" aria-controls="collapsePages">
                    <i class="fas fa-fw fa-plus"></i>
                    <span>Adicionar Opções</span>
                </a>
                <div id="collapsePages" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">ABERTURA DE CHAMADOS</h6>
                        <a class="collapse-item" href="adicionarTipo.php">Adicionar Tipo</a>
                        <a class="collapse-item" href="adicionarCategoria.php">Adicionar Categoria</a>
                        <a class="collapse-item" href="adicionarSubCat.php">Adicionar Sub Categoria</a>
                        <a class="collapse-item" href="adicionarItem.php">Adicionar Item</a>
                        <div class="collapse-divider"></div>
                        <h6 class="collapse-header">ATENDIMENTO</h6>
                        <a class="collapse-item" href="adicionarStatus.php">Adicionar Status</a>
                        <a class="collapse-item" href="adicionarPrioridade.php">Adicionar Prioridade</a>
                        <a class="collapse-item" href="adicionarTipoAtendimento.php">Adicionar Tipo Atendimento</a>
                        <div class="collapse-divider"></div>
                        <h6 class="collapse-header">DEPARTAMENTO</h6>
                        <a class="collapse-item" href="adicionarDepartamento.php">Adicionar Departamento</a>
                    </div>
                </div>
            </li>

            <li class="nav-item">
                <a class="nav-link collapsed" href="gerenciarAberturaChamados.php">
                    <i class="fas fa-fw fa-list"></i>
                    <span>Gerenciar Abertura</span>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link collapsed" href="gerenciarSistemaChamados.php">
                    <i class="fas fa-fw fa-list"></i>
                    <span>Sistema de Chamados</span>
                </a>
            </li>

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
                        </li>

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
                                    Perfil
                                </a>
                                <a class="dropdown-item" href="#">
                                    <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Configurações
                                </a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="../Backend/logout.php" data-toggle="modal" data-target="#logoutModal">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Sair
                                </a>
                            </div>
                        </li>
                    </ul>
                </nav>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">

                <div class="row justify-content-center align-items-center" style="margin-top: 120px;">
                    <div id="form1">
                        <form action="verItem.php" method="POST">
                        <h2>Ver Item</h2>
                        <?php echo "Tipo Associado: ".$resultado['nome_tipo']."<br>";?><!--Informa o Tipo associado-->
                        <?php echo "Categoria Associado: ".$resultado['nome_categoria']."<br>";?><!--Informa a categoria associado-->
                        <?php echo "Subcategoria Associado: ".$resultado['nome_subcategoria'];?><!--Informa a subcategoria associado-->
                        <div class="form-group">
                            <!--Passa o codigo via POST para ser possivel realizar o update-->
                            <input type="hidden" class="form-control" name="verci" id="vci" required value="<?php if(isset($resultado)) {echo $resultado['cod_item'];}//passa o valor para o formulario ?>">
                        </div>
                        <div class="form-group">
                            <label for="vcat">Categoria</label>
                            <input type="text" class="form-control" name="veritem" id="vitem" required value="<?php if(isset($resultado)) {echo $resultado['nome_item'];}//passa o valor para o formulario ?>">
                        </div>
                        <div class="form-group">
                            <label for="ativo">Ativo:</label><br>
                            <select class="form-control" id="atv" name="ativo">
                                <option value="0" <?php if($resultado['ativo'] == 0) {echo "selected";}?>>Inativo</option>
                                <option value="1" <?php if($resultado['ativo'] == 1) {echo "selected";}?>>Ativo</option><!--Verifica qual a situação no banco para fazer a seleção no opition-->
                            </select>
                        </div>
                        <a href="verrItem.php" class="btn btn-primary btn-block">Guardar</a>
                        </form>
                    </div> <!--form1-->
                </div> <!--dpc-->
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

    <!-- Page level plugins -->
    <script src="vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="js/demo/datatables-demo.js"></script>

    <script src="JS/JQuery/jquery-3.6.0.min.js"></script>
    <script src="JS/ajaxCategoria.js"></script>
    <script src="JS/ajaxSubCat.js"></script>
    <script src="JS/ajaxItem.js"></script>
</body>

</html>