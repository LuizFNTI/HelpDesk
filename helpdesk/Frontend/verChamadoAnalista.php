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
    $query = $conn->prepare("SELECT * FROM
        chamados
    INNER JOIN item ON item.cod_item = chamados.item_cod_item
    INNER JOIN subcategoria ON subcategoria.cod_subcategoria = chamados.subcategoria_cod_subcategoria
    INNER JOIN categoria ON categoria.cod_categoria = chamados.categoria_cod_categoria
    INNER JOIN tipo ON tipo.cod_tipo = chamados.tipo_cod_tipo
    INNER JOIN usuarios ON usuarios.matricula = chamados.usuarios_matricula
    INNER JOIN prioridade_chamado ON prioridade_chamado.cod_prioridade = chamados.prioridade_chamado_cod_prioridade
    INNER JOIN status_chamado ON status_chamado.cod_status = chamados.status_chamado_cod_status 
    INNER JOIN departamento ON departamento.cod_departamento = usuarios.departamento
    WHERE numero_chamado = :nc");
    $query->bindValue(":nc",$numero_chamado_up);
    $query->execute();
    $resultado = $query->fetch(PDO::FETCH_ASSOC);

    //Verifica se existe POST
    if(isset($_POST['status'])) {

        //Pega os POSTs do formularios e atribue a variaveis
        $numero_chamado = $_POST["vnc"];
        $descricao_analista = $_POST['descanalista'];
        $data_prazo = $_POST['dprazo'];
        $status = $_POST['status'];
        $prioridade = $_POST['prioridade'];
        $tipo_atendimento = $_POST['tipoa'];
        $fila_geral = $_POST['fgeral'];

        //Faz o update 
        $query = $conn->prepare("UPDATE chamados SET descricao_analista = :dn, data_prazo = :dp, analista = :analista, status_chamado_cod_status = :cs, prioridade_chamado_cod_prioridade = :cp, tipo_atendimento_cod_tipo_atendimento = :cta, fila_geral = :fgeral WHERE numero_chamado = :nc");
        $query->bindValue(":dn",$descricao_analista);
        $query->bindValue(":dp",$data_prazo);
        $query->bindValue(":analista",$nome_analista);
        $query->bindValue(":cs",$status);
        $query->bindValue(":cp",$prioridade);
        $query->bindValue(":cta",$tipo_atendimento);
        $query->bindValue(":fgeral",$fila_geral);
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
                    <div class="row">
                        <div class="col">
                            <div class="container-sm">
                                <!--Passa as informações para imprimir na tela-->
                                <p>Numero Chamado: <?php echo $resultado['numero_chamado']; ?></p>
                            </div>
                            
                            <div class="container-sm">
                                <!--Passa as informações para imprimir na tela-->
                                <?php echo $resultado['nome_tipo'] . ">" 
                                . $resultado['nome_categoria'] . ">" . $resultado['nome_subcategoria'] . ">" .$resultado['nome_item']; ?>
                            </div><br>

                            <div class="container-sm">
                                <!--Passa as informações para imprimir na tela-->
                                <p>Numero Matricula: <?php echo $resultado['matricula']; ?></p>
                                <p>Nome: <?php echo $resultado['nome']; ?></p>
                                <p>Departamento: <?php echo $resultado['nome_departamento']; ?>
                                <p>Telefone: <?php echo $resultado['telefone']; ?></p>
                                <p>E-Mail: <?php echo $resultado['email']; ?></p>
                            </div>
                            
                        </div> <!--col-->
                        <div class="col">
                            <div class="container-sm">
                                <p>Data e Hora abertura: <?php echo $resultado['data_hora_abertura']; ?></p>
                                <form action="verChamadoAnalista.php" method="POST">
                                <!--Desliga a fila geral para aparecer somente na fila do analista e passa o numero do chamado via POST para o update-->
                                    <input type="hidden" name="vnc" value="<?php echo $resultado['numero_chamado']; ?>">
                                    <input type="hidden" name="fgeral" value="0">
                                    <div class="form-group">
                                        <label for="dprazo">Informe a Data Prazo</label>
                                        <input type="date" name="dprazo" id="dp">
                                    </div>
                                    <div class="form-group">
                                        <label for="status">Selrcione o status</label>
                                        <select class="form-control" id="cds" name="status">
                                        <option>Selecione</option>
                                    <?php
                                        include '../Backend/conexao.php';

                                        $dados = array();        
                                    
                                        //Faz a consulta no banco
                                        $query = $conn->query("SELECT * FROM status_chamado");
                                    
                                        //Joga os dados do banco num array e faz a leitura do array jogando as informações no opition
                                        foreach($query->fetchAll(PDO::FETCH_ASSOC) as $dados) {
                                            echo "<option value=".$dados['cod_status'].">".$dados['nome_status']."</option>";
                                        }
                                    ?>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="status">Selrcione a Prioridade</label>
                                        <select class="form-control" id="cdp" name="prioridade">
                                        <option>Selecione</option>
                                    <?php
                                        include '../Backend/conexao.php';

                                        $dados = array();        
                                    
                                        //Faz a consulta no banco
                                        $query = $conn->query("SELECT * FROM prioridade_chamado");
                                    
                                        //Joga os dados do banco num array e faz a leitura do array jogando as informações no opition
                                        foreach($query->fetchAll(PDO::FETCH_ASSOC) as $dados) {
                                            echo "<option value=".$dados['cod_prioridade'].">".$dados['nome_prioridade']."</option>";
                                        }
                                    ?>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="status">Selrcione o Tipo Atendimento</label>
                                        <select class="form-control" id="cds" name="tipoa">
                                        <option>Selecione</option>
                                    <?php
                                        include '../Backend/conexao.php';

                                        $dados = array();        
                                    
                                        //Faz a consulta no banco
                                        $query = $conn->query("SELECT * FROM tipo_atendimento");
                                    
                                        //Joga os dados do banco num array e faz a leitura do array jogando as informações no opition
                                        foreach($query->fetchAll(PDO::FETCH_ASSOC) as $dados) {
                                            echo "<option value=".$dados['cod_tipo_atendimento'].">".$dados['nome_tipo_atendimento']."</option>";
                                        }
                                    ?>
                                        </select>       
                                    </div>
                                    <input type="submit" value="Mover Param Sua Fila" class="btn btn-primary btn-block">
                                </form>
                            </div>
                        </div>
                    </div><br> <!--row-->
                    <div class="row">
                        <div class="container-lg">
                            Descrição <br><br>
                            <?php echo $resultado['descricao']; ?>
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