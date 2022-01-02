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
                    <h1 class="h3 mb-2 text-gray-800">Chamados</h1>
                    <p class="mb-4">Aqui estão localizados os chamados que estão abertos.</p>

                    <form action="pesquisarChamado.php" method="POST" class="user">
                        <div class="form-group">
                            <label for="pchamado">Pesquísa</label>
                            <input type="text" class="form-control" placeholder="Numero Chamado, Usuário, Analista" name="pesquisa" id="nch">    
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-6 mb-3 mb-sm-0">
                                <div class="form-group">
                                    <label for="datafinal">Data Inicial</label>
                                    <input type="date" class="form-control" name="datain" id="din">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="datainicial">Data Final</label>
                                    <input type="date" class="form-control" name="datafim" id="dfim">
                                </div>
                            </div>
                        </div>
                        <input type="submit" value="Enviar" class="btn btn-primary btn-block">
                    </form>
                </div>
                <!-- /.container-fluid -->

                <!-- Begin Page Content -->
                <div class="container-fluid">
               
                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Gerenciar Usuários</h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTablePesquisa" width="100%" cellspacing="0" style="font-size: 14px;">
                                    <thead>
                                        <tr>
                                            <th>Chamado</th>
                                            <th>Tipo>Categoria>SubCategoria>Item</th>
                                            <th>Data Inicio</th>
                                            <th>Usuário</th>
                                            <th>Analista</th>
                                            <th>Prioridade</th>
                                            <th>Status</th>
                                        </tr>
                                    </thead>
                    <?php
                        
                        include '../Backend/conexao.php';

                        if(isset($_POST['pesquisa'])) {

                            $pesquisa = $_POST['pesquisa'];
                            $data_inicio = $_POST['datain'];
                            $data_fim = $_POST['datafim'];
                        
                            $dados = array();        

                            //Faz a consulta no banco
                            $query = $conn->prepare("SELECT * FROM chamados
                        INNER JOIN item ON item.cod_item = chamados.item_cod_item
                        INNER JOIN subcategoria ON subcategoria.cod_subcategoria = chamados.subcategoria_cod_subcategoria
                        INNER JOIN categoria ON categoria.cod_categoria = chamados.categoria_cod_categoria
                        INNER JOIN tipo ON tipo.cod_tipo = chamados.tipo_cod_tipo
                        INNER JOIN usuarios ON usuarios.matricula = chamados.usuarios_matricula
                        INNER JOIN prioridade_chamado ON prioridade_chamado.cod_prioridade = chamados.prioridade_chamado_cod_prioridade
                        INNER JOIN status_chamado ON status_chamado.cod_status = chamados.status_chamado_cod_status WHERE numero_chamado LIKE '%:pesq%' OR nome LIKE '%:pesq%' OR analista LIKE '%:pesq%' AND data_hora_abertura BETWEEN ':di' AND ':df'");
                        $query->bindValue(":pesq", $pesquisa);
                        $query->bindValue(":di", $data_inicio);
                        $query->bindValue(":df", $data_fim);
                        $query->execute();

                        echo "<tbody>";

                            //Joga os dados do banco num array e faz a leitura do array, jogando as informações no tabela
                            foreach($query->fetchAll(PDO::FETCH_ASSOC) as $dados) {
                                echo "<tr>";
                                    echo "<th>".$dados['numero_chamado']."</th>";//Busca os dados na posiçãom do vetor
                                    echo "<th>".$dados['nome_tipo'].">".$dados['nome_categoria'].">".$dados['nome_subcategoria'].">".$dados['nome_item']."</th>";
                                    echo "<th>".$dados['data_hora_abertura']."</th>";
                                    echo "<th>".$dados['nome']."</th>";
                                    echo "<th>".$dados['analista']."</th>";
                                    echo "<th>".$dados['nome_prioridade']."</th>";
                                    echo "<th>".$dados['nome_status']."</th>";
                                    //echo "<th><a href=editarChamado.php?nc_up=".$dados['numero_chamado'].">Editar<br></a>";
                                    //echo "<a href=fecharChamado.php?nc_up=".$dados['numero_chamado'].">Encerrar</a></th>";
                                echo "</tr>";
                            }
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

    <script src="JS/JQuery/jquery-3.6.0.min.js"></script>
    <script src="JS/ajaxCategoria.js"></script>
    <script src="JS/ajaxSubCat.js"></script>
    <script src="JS/ajaxItem.js"></script>
</body>

</html>