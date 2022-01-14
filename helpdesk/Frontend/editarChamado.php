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
    $query = $conn->prepare("SELECT * FROM chamados
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

        //Faz o update 
        $query = $conn->prepare("UPDATE chamados SET descricao_analista = :dn, data_prazo = :dp, status_chamado_cod_status = :cs, prioridade_chamado_cod_prioridade = :cp, tipo_atendimento_cod_tipo_atendimento = :cta WHERE numero_chamado = :nc");
        $query->bindValue(":dn",$descricao_analista);
        $query->bindValue(":dp",$data_prazo);
        $query->bindValue(":cs",$status);
        $query->bindValue(":cp",$prioridade);
        $query->bindValue(":cta",$tipo_atendimento);
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
    <title>Editar Chamado - <?php echo $resultado['numero_chamado']; ?></title>

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
                    <div class="row">
                        <div class="col">
                            <div class="sidebar-heading"><strong style="font-weight: 900">Informações do Chamado</strong></div>
                            <div class="container-sm">
                                <p style="margin-top: 3%;"><strong style="font-weight: 900;">Numero Chamado: </strong> <?php echo $resultado['numero_chamado']; ?></p>
                                <p style="margin-bottom: 3%;"><?php echo $resultado['nome_tipo'] . ">" . $resultado['nome_categoria'] . ">" . $resultado['nome_subcategoria'] . ">" .$resultado['nome_item']; ?></p>
                            </div>
                            <hr>
                            <div class="sidebar-heading"><strong style="font-weight: 900;">Informações do Usuário</strong></div>
                            <div class="container-sm">
                                <!--Passa as informações para imprimir na tela-->
                                <p style="margin-top: 3%;"><strong style="font-weight: 900;">Numero Matricula: </strong><?php echo $resultado['matricula']; ?></p>
                                <p><strong style="font-weight: 900;">Nome: </strong> <?php echo $resultado['nome']; ?></p>
                                <p><strong style="font-weight: 900;">Departamento: </strong>: <?php echo $resultado['nome_departamento']; ?>
                                <p><strong style="font-weight: 900;">Telefone: </strong> <?php echo $resultado['telefone']; ?></p>
                                <p><strong style="font-weight: 900;">E-mail: </strong> <?php echo $resultado['email']; ?></p>
                                <p><strong style="font-weight: 900;">Localização: </strong> <?php echo $resultado['localizacao']; ?></p>
                            </div>
                        </div> <!--col-->
                        <div style="height: 500px; border-left: 1px solid;"></div>
                        <div class="col">
                            <div class="container-sm">
                            <form action="editarChamado.php" method="POST">
                                <p><strong style="font-weight: 900;">Data e Hora abertura: </strong> <?php echo date('d/m/Y - H:i:s', strtotime($resultado['data_hora_abertura'])); ?></p>
                                <!--Desliga a fila geral para aparecer somente na fila do analista e passa o numero do chamado via POST para o update-->
                                <input type="hidden" name="vnc" value="<?php echo $resultado['numero_chamado']; ?>">
                                <div class="form-group">
                                    <label for="dprazo">Alterar Data Prazo</label>
                                    <input type="date" name="dprazo" id="dp" value="<?php echo $resultado['data_prazo'] ?>">
                                </div>
                            </div>
                            <hr>
                            <div class="container-sm">
                                <div class="form-group">
                                    <label for="status">Selrcione o novo status</label>
                                    <select class="form-control" id="cds" name="status">
                                <?php
                                    include '../Backend/conexao.php';

                                    $dados = array();        
                                
                                    //Faz a consulta no banco onde o status seja diferente de finalizado
                                    $query = $conn->query("SELECT * FROM status_chamado WHERE cod_status != 3");
                                
                                    //Joga os dados do banco num array e faz a leitura do array jogando as informações no opition
                                    foreach($query->fetchAll(PDO::FETCH_ASSOC) as $dados) {
                                        if($dados['cod_status'] == $resultado['cod_status']) {
                                            echo "<option selected value=".$dados['cod_status'].">".$dados['nome_status']."</option>";
                                        } else {
                                            echo "<option value=".$dados['cod_status'].">".$dados['nome_status']."</option>";
                                        }
                                    }
                                ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="status">Selrcione a Nova Prioridade</label>
                                    <select class="form-control" id="cdp" name="prioridade">
                                <?php
                                    include '../Backend/conexao.php';

                                    $dados = array();        
                                
                                    //Faz a consulta no banco
                                    $query = $conn->query("SELECT * FROM prioridade_chamado");
                                
                                    //Joga os dados do banco num array e faz a leitura do array jogando as informações no opition
                                    foreach($query->fetchAll(PDO::FETCH_ASSOC) as $dados) {
                                        if($dados['cod_prioridade'] == $resultado['cod_prioridade']) {
                                            echo "<option selected value=".$dados['cod_prioridade'].">".$dados['nome_prioridade']."</option>";
                                        } else {
                                            echo "<option value=".$dados['cod_prioridade'].">".$dados['nome_prioridade']."</option>";
                                        }
                                    }
                                ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="status">Selrcione o Novo Tipo Atendimento</label>
                                    <select class="form-control" id="cds" name="tipoa">
                                <?php
                                    include '../Backend/conexao.php';

                                    $dados = array();        
                                
                                    //Faz a consulta no banco
                                    $query = $conn->query("SELECT * FROM tipo_atendimento");
                                
                                    //Joga os dados do banco num array e faz a leitura do array jogando as informações no opition
                                    foreach($query->fetchAll(PDO::FETCH_ASSOC) as $dados) {
                                        if($dados['cod_tipo_atendimento'] == $resultado['cod_tipo_atendimento']) {
                                            echo "<option selected value=".$dados['cod_tipo_atendimento'].">".$dados['nome_tipo_atendimento']."</option>";
                                        } else {
                                            echo "<option value=".$dados['cod_tipo_atendimento'].">".$dados['nome_tipo_atendimento']."</option>";
                                        }
                                    }
                                ?>
                                    </select>
                                </div>
                            </div>
                        </div> <!--col-->
                    </div> <!--row-->
                    <hr>
                    <div class="row">
                        <div class="container-lg">
                            <h4 class="h4 mb-2 text-gray-800">Descrição: </h4>
                            <?php echo $resultado['descricao']; ?>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="container-sm">
                            <div class="form-group">
                                <label for="descricao">Faça uma breve descrição da sua resposta:</label>
                                <textarea class="form-control" rows="5" placeholder="Descrição Analista:" id="descr" name="descanalista"></textarea>
                            </div>
                            <input type="submit" value="Guardar" class="btn btn-primary btn-block"></form>
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

</body>

</html>