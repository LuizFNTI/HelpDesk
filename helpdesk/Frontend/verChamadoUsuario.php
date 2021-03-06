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
    WHERE numero_chamado = :nc");
    $query->bindValue(":nc",$numero_chamado_up);
    $query->execute();
    $resultado = $query->fetch(PDO::FETCH_ASSOC);

    //Verifica se existe POST
    if(isset($_POST['descricao'])) {

        //Pega os POSTs do formularios e atribue a variaveis
        $numero_chamado = $_POST["vnc"];
        $localizacao = $_POST["localizacao"];
        $descricao = $_POST["descricao"];

        //Faz o update 
        $query = $conn->prepare("UPDATE chamados SET localizacao = :locali, descricao = :du WHERE numero_chamado = :nc");
        $query->bindValue(":locali",$localizacao);
        $query->bindValue(":du",$descricao);
        $query->bindValue(":nc",$numero_chamado);
        $query->execute();

        echo "<script>window.alert('Atualização realizada com sucesso')</script>";
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
                                <p style="margin-top: 3%;"><strong style="font-weight: 900;">Numero Chamado: </strong> <?php echo $resultado['numero_chamado']; ?></p>
                                <p><strong style="font-weight: 900;">Analista: </strong><?php if($resultado['analista'] == null) {echo "Aguardando Analista...";} else{echo $resultado['analista'];}?></p>
                                <p><?php echo $resultado['nome_tipo']."<i class='fas fa-chevron-right' style='font-size: 13px;'></i>".$resultado['nome_categoria']."<i class='fas fa-chevron-right' style='font-size: 13px;'></i>".$resultado['nome_subcategoria']."<i class='fas fa-chevron-right' style='font-size: 13px;'></i>".$resultado['nome_item']; ?></p>
                                <p><strong style="font-weight: 900;">Data e Hora abertura: </strong> <?php echo date('d/m/Y - H:i:s', strtotime($resultado['data_hora_abertura'])); ?></p>
                                <p><strong style="font-weight: 900;">Data Prazo: </strong> <?php if($resultado['data_prazo'] == null) {echo "Data prazo ainda não definida pelo analista! ";} else {echo date('d/m/Y', strtotime($resultado['data_prazo']));} ?></p>
                            </div>
                        </div> <!--col-->
                        <div style="height: 400px; border-left: 1px solid;"></div>
                        <div class="col">
                            <div class="container-sm">
                            <form action="" method="POST">
                            <input type="hidden" name="vnc" value="<?php echo $resultado['numero_chamado']; ?>">
                                <div class="form-group">
                                    <label for="descricao">Localização:</label>
                                    <input class="form-control" placeholder="Local do Equipamamento:" id="local" name="localizacao" value="<?php echo $resultado['localizacao']; ?>">
                                </div>
                                <div class="form-group">
                                    <label for="descricao">Edite a descrição da sua solicitação:</label>
                                    <textarea class="form-control" rows="5" placeholder="Descrição:" id="descr" name="descricao"> <?php echo $resultado['descricao']; ?></textarea>
                                </div>
                                <input type="submit" value="Editar" class="btn btn-primary btn-block">
                            </form>
                            </div>
                        </div>
                    </div><!--row-->
                    <hr>
                    <div class="row">
                        <div class="container-sm">
                            <h4 class="h4 mb-2 text-gray-800">Resposta Analista: </h4>
                            <p><?php if($resultado['descricao_analista'] == null) {echo "Ainda não há nem uma resposta do analista! ";} else {echo $resultado['descricao_analista'];} ?></p>
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