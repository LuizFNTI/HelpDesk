<?php
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
    <title>Lista Chamados - Atendimento</title>

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

                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Minha Fila</h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTableFilaAnalista" width="100%" cellspacing="0" style="font-size: 14px;">
                                    <thead>
                                        <tr>
                                            <th>Chamado</th>
                                            <th>Tipo<i class='fas fa-chevron-right' style='font-size: 12px;'></i>Categoria<i class='fas fa-chevron-right' style='font-size: 12px;'></i>Subcategoria<i class='fas fa-chevron-right' style='font-size: 12px;'></i>Item</th>
                                            <th>Data Inicio</th>
                                            <th>Data Prazo</th>
                                            <th>Usuário</th>
                                            <th>Prioridade</th>
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
                    INNER JOIN status_chamado ON status_chamado.cod_status = chamados.status_chamado_cod_status WHERE analista = ? AND fila_geral = 0 AND status_chamado_cod_status != 3");
                    $query->execute(array($nome_usuario));

                    echo "<tbody>";

                        //Joga os dados do banco num array e faz a leitura do array, jogando as informações no tabela
                        foreach($query->fetchAll(PDO::FETCH_ASSOC) as $dados) {
                            echo "<tr>";
                                echo "<th>".$dados['numero_chamado']."</th>";//Busca os dados na posiçãom do vetor
                                echo "<th>".$dados['nome_tipo']."<i class='fas fa-chevron-right' style='font-size: 12px;'></i>".$dados['nome_categoria']."<i class='fas fa-chevron-right' style='font-size: 12px;'></i>".$dados['nome_subcategoria']."<i class='fas fa-chevron-right' style='font-size: 12px;'></i>".$dados['nome_item']."</th>";
                                echo "<th>".date('d/m/Y - H:i:s', strtotime($dados['data_hora_abertura']))."</th>";
                                if($dados['data_prazo'] == null) {echo "<th>Sem Data Prazo</th> ";} else {echo "<th>".date('d/m/Y', strtotime($dados['data_prazo']))."</th>";}
                                echo "<th>".$dados['nome']."</th>";
                                switch ($dados['cod_prioridade']) {
                                    case 1:
                                        echo "<th>"."<i class='fas fa-fw fa-square' style='color: green;'></i>".$dados['nome_prioridade']."</th>";
                                        break;
                                    case 2:
                                        echo "<th>"."<i class='fas fa-fw fa-square' style='color: yellow;'></i>".$dados['nome_prioridade']."</th>";
                                        break;
                                    case 3:
                                        echo "<th>"."<i class='fas fa-fw fa-square' style='color: red;'></i>".$dados['nome_prioridade']."</th>";
                                        break;
                                    case 4:
                                        echo "<th>"."<i class='fas fa-fw fa-square' style='color: #ff8700;'></i>".$dados['nome_prioridade']."</th>";
                                        break;
                                    default:
                                        echo "<th>"."<i class='fas fa-fw fa-square' style='color: white;'></i>".$dados['nome_prioridade']."</th>";
                                }
                                switch ($dados['cod_status']) {
                                    case 1:
                                        echo "<th>"."<i class='fas fa-fw fa-circle' style='color: red;'></i>".$dados['nome_status']."</th>";
                                        break;
                                    case 2:
                                        echo "<th>"."<i class='fas fa-fw fa-circle' style='color: yellow;'></i>".$dados['nome_status']."</th>";
                                        break;
                                    case 3:
                                        echo "<th>"."<i class='fas fa-fw fa-circle' style='color: green;'></i>".$dados['nome_status']."</th>";
                                        break;
                                    case 4:
                                        echo "<th>"."<i class='fas fa-fw fa-circle' style='color: black;'></i>".$dados['nome_status']."</th>";
                                        break;
                                    case 5:
                                        echo "<th>"."<i class='fas fa-fw fa-circle' style='color: orange;'></i>".$dados['nome_status']."</th>";
                                        break;
                                    case 6:
                                        echo "<th>"."<i class='fas fa-fw fa-circle' style='color: blue;'></i>".$dados['nome_status']."</th>";
                                        break;
                                    case 7:
                                        echo "<th>"."<i class='fas fa-fw fa-circle' style='color: gray;'></i>".$dados['nome_status']."</th>";
                                        break;
                                    case 8:
                                        echo "<th>"."<i class='fas fa-fw fa-circle' style='color: tomato;'></i>".$dados['nome_status']."</th>";
                                        break;
                                    case 9:
                                        echo "<th>"."<i class='fas fa-fw fa-circle' style='color: dodgerBlue;'></i>".$dados['nome_status']."</th>";
                                        break;
                                    case 10:
                                        echo "<th>"."<i class='fas fa-fw fa-circle' style='color: brown;'></i>".$dados['nome_status']."</th>";
                                        break;
                                    case 11:
                                        echo "<th>"."<i class='fas fa-fw fa-circle' style='color: purple;'></i>".$dados['nome_status']."</th>";
                                        break;
                                    default:
                                        echo "<th>"."<i class='fas fa-fw fa-circle' style='color: white;'></i>".$dados['nome_status']."</th>";
                                }
                                echo "<th><a href=editarChamado.php?nc_up=".$dados['numero_chamado']."<i class='fas fa-fw fa-wrench' style='font-size: 20px;' title='Editar'></i></a>";
                                echo "<a href=fecharChamado.php?nc_up=".$dados['numero_chamado']."<i class='fas fa-fw fa-times' style='color: red; font-size: 20px;' title='Encerrar'></i></a>";
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

                <div class="container-fluid">

                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Fila Geral</h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTableFilaGeral" width="100%" cellspacing="0" style="font-size: 14px;">
                                    <thead>
                                        <tr>
                                            <th>Chamado</th>
                                            <th>Tipo<i class='fas fa-chevron-right' style='font-size: 12px;'></i>Categoria<i class='fas fa-chevron-right' style='font-size: 12px;'></i>Subcategoria<i class='fas fa-chevron-right' style='font-size: 12px;'></i>Item</th>
                                            <th>Data Inicio</th>
                                            <th>Usuário</th>
                                            <th>Prioridade</th>
                                            <th>Status</th>
                                            <th>Ação</th>
                                        </tr>
                                    </thead>
                    <?php
                        
                        include '../Backend/conexao.php';

                        $dados = array();        

                        //Faz a consulta no banco
                        $query = $conn->query("SELECT * FROM chamados
                    INNER JOIN item ON item.cod_item = chamados.item_cod_item
                    INNER JOIN subcategoria ON subcategoria.cod_subcategoria = chamados.subcategoria_cod_subcategoria
                    INNER JOIN categoria ON categoria.cod_categoria = chamados.categoria_cod_categoria
                    INNER JOIN tipo ON tipo.cod_tipo = chamados.tipo_cod_tipo
                    INNER JOIN usuarios ON usuarios.matricula = chamados.usuarios_matricula
                    INNER JOIN prioridade_chamado ON prioridade_chamado.cod_prioridade = chamados.prioridade_chamado_cod_prioridade
                    INNER JOIN status_chamado ON status_chamado.cod_status = chamados.status_chamado_cod_status WHERE fila_geral = 1 AND status_chamado_cod_status != 3");

                    echo "<tbody>";

                        //Joga os dados do banco num array e faz a leitura do array, jogando as informações no tabela
                        foreach($query->fetchAll(PDO::FETCH_ASSOC) as $dados) {
                            echo "<tr>";
                                echo "<th>".$dados['numero_chamado']."</th>";//Busca os dados na posiçãom do vetor
                                echo "<th>".$dados['nome_tipo']."<i class='fas fa-chevron-right' style='font-size: 12px;'></i>".$dados['nome_categoria']."<i class='fas fa-chevron-right' style='font-size: 12px;'></i>".$dados['nome_subcategoria']."<i class='fas fa-chevron-right' style='font-size: 12px;'></i>".$dados['nome_item']."</th>";
                                echo "<th>".date('d/m/Y - H:i:s', strtotime($dados['data_hora_abertura']))."</th>";
                                echo "<th>".$dados['nome']."</th>";
                                switch ($dados['cod_prioridade']) {
                                    case 1:
                                        echo "<th>"."<i class='fas fa-fw fa-square' style='color: green;'></i>".$dados['nome_prioridade']."</th>";
                                        break;
                                    case 2:
                                        echo "<th>"."<i class='fas fa-fw fa-square' style='color: yellow;'></i>".$dados['nome_prioridade']."</th>";
                                        break;
                                    case 3:
                                        echo "<th>"."<i class='fas fa-fw fa-square' style='color: red;'></i>".$dados['nome_prioridade']."</th>";
                                        break;
                                    case 4:
                                        echo "<th>"."<i class='fas fa-fw fa-square' style='color: #ff8700;'></i>".$dados['nome_prioridade']."</th>";
                                        break;
                                    default:
                                        echo "<th>"."<i class='fas fa-fw fa-square' style='color: white;'></i>".$dados['nome_prioridade']."</th>";
                                }
                                switch ($dados['cod_status']) {
                                    case 1:
                                        echo "<th>"."<i class='fas fa-fw fa-circle' style='color: red;'></i>".$dados['nome_status']."</th>";
                                        break;
                                    case 2:
                                        echo "<th>"."<i class='fas fa-fw fa-circle' style='color: yellow;'></i>".$dados['nome_status']."</th>";
                                        break;
                                    case 3:
                                        echo "<th>"."<i class='fas fa-fw fa-circle' style='color: green;'></i>".$dados['nome_status']."</th>";
                                        break;
                                    case 4:
                                        echo "<th>"."<i class='fas fa-fw fa-circle' style='color: black;'></i>".$dados['nome_status']."</th>";
                                        break;
                                    case 5:
                                        echo "<th>"."<i class='fas fa-fw fa-circle' style='color: orange;'></i>".$dados['nome_status']."</th>";
                                        break;
                                    case 6:
                                        echo "<th>"."<i class='fas fa-fw fa-circle' style='color: blue;'></i>".$dados['nome_status']."</th>";
                                        break;
                                    case 7:
                                        echo "<th>"."<i class='fas fa-fw fa-circle' style='color: gray;'></i>".$dados['nome_status']."</th>";
                                        break;
                                    case 8:
                                        echo "<th>"."<i class='fas fa-fw fa-circle' style='color: tomato;'></i>".$dados['nome_status']."</th>";
                                        break;
                                    case 9:
                                        echo "<th>"."<i class='fas fa-fw fa-circle' style='color: dodgerBlue;'></i>".$dados['nome_status']."</th>";
                                        break;
                                    case 10:
                                        echo "<th>"."<i class='fas fa-fw fa-circle' style='color: brown;'></i>".$dados['nome_status']."</th>";
                                        break;
                                    case 11:
                                        echo "<th>"."<i class='fas fa-fw fa-circle' style='color: purple;'></i>".$dados['nome_status']."</th>";
                                        break;
                                    default:
                                        echo "<th>"."<i class='fas fa-fw fa-circle' style='color: white;'></i>".$dados['nome_status']."</th>";
                                }
                                echo "<th style='text-align: center'><a href=verChamadoAnalista.php?nc_up=".$dados['numero_chamado']."<i class='fas fa-fw fa-arrow-up' style='font-size: 20px;' title='Mover Para Sua Fila'></i></a>";
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

    <!-- Page level plugins -->
    <script src="vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="js/demo/datatables-demo.js"></script>

    <!--active navbar-->
    <script>$("#atenderChamado").addClass("active")</script>
</body>

</html>