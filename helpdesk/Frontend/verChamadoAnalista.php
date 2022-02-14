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
        $data_prazo = $_POST['dprazo'];
        $status = $_POST['status'];
        $prioridade = $_POST['prioridade'];
        $tipo_atendimento = $_POST['tipoa'];
        $fila_geral = $_POST['fgeral'];

        //Faz o update 
        $query = $conn->prepare("UPDATE chamados SET data_prazo = :dp, analista = :analista, status_chamado_cod_status = :cs, prioridade_chamado_cod_prioridade = :cp, tipo_atendimento_cod_tipo_atendimento = :cta, fila_geral = :fgeral WHERE numero_chamado = :nc");
        $query->bindValue(":dp",$data_prazo);
        $query->bindValue(":analista",$nome_analista);
        $query->bindValue(":cs",$status);
        $query->bindValue(":cp",$prioridade);
        $query->bindValue(":cta",$tipo_atendimento);
        $query->bindValue(":fgeral",$fila_geral);
        $query->bindValue(":nc",$numero_chamado);
        $query->execute();

        $para = "fellippe.nascimento@gmail.com";
        $assunto = "Atualização sobre sua solicitação";

        // Always set content-type when sending HTML email
        $headers = "MIME-Version: 1.0" . "\r\n";
        $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
        $headers .= 'From: <fellippe.nascimento@gmail.com>' . "\r\n";

        include 'emailChamadoPegoAnalista.php';

        mail($para, $assunto, $mensagem, $headers);

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
    <title>Ver Chamado - <?php echo $resultado['numero_chamado']; ?></title>

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
                                <p style="margin-top: 3%;"><strong>Numero Chamado: </strong> <?php echo $resultado['numero_chamado']; ?></p>
                                <p><?php echo $resultado['nome_tipo']."<i class='fas fa-chevron-right' style='font-size: 13px;'></i>".$resultado['nome_categoria']."<i class='fas fa-chevron-right' style='font-size: 13px;'></i>".$resultado['nome_subcategoria']."<i class='fas fa-chevron-right' style='font-size: 13px;'></i>".$resultado['nome_item']; ?></p>
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
                            <form action="" method="POST">
                                <p><strong style="font-weight: 900">Data e Hora abertura: </strong><?php echo date('d/m/Y - H:i:s', strtotime($resultado['data_hora_abertura'])); ?></p>
                                <input type="hidden" name="vnc" value="<?php echo $resultado['numero_chamado']; ?>">
                                <input type="hidden" name="fgeral" value="0">
                                <div class="form-group">
                                    <label for="dprazo">Informe a Data Prazo</label>
                                    <input type="date" name="dprazo" id="dp">
                                </div>
                            </div> 
                            <hr>
                            <div class="container-sm"> 
                                <div class="form-group">
                                    <label for="status">Selrcione o status</label>
                                    <select class="form-control" id="cds" name="status" required>
                                    <option value="">Selecione</option>
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
                                    <select class="form-control" id="cdp" name="prioridade" required>
                                    <option value="">Selecione</option>
                                    <?php
                                        include '../Backend/conexao.php';

                                        $dados = array();        
                                        
                                        //Faz a consulta no banco
                                        $query = $conn->query("SELECT * FROM prioridade_chamado");
                                        
                                        //Joga os dados do banco num array e faz a leitura do arrayjogando as informações no opition
                                        foreach($query->fetchAll(PDO::FETCH_ASSOC) as $dados) {
                                            echo "<option value=".$dados['cod_prioridade'].">".$dados['nome_prioridade']."</option>";
                                        }
                                    ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="status">Selrcione o Tipo Atendimento</label>
                                    <select class="form-control" id="cds" name="tipoa" required>
                                    <option value="">Selecione</option>
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
                            </div>
                            </form>
                        </div>
                    </div> <!--row-->
                    <hr>
                    <div class="row">
                        <div class="container-lg">
                            <h4 class="h4 mb-2 text-gray-800">Descrição: </h4>
                            <p><?php echo $resultado['descricao']; ?></p>
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