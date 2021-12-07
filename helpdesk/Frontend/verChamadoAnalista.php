<?php
    session_start();

    if(isset($_SESSION['usuario']) && is_array($_SESSION['usuario'])) {
        $matricula = $_SESSION['usuario'][0];
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
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ver Chamado</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="CSS/verChamadoAnalista.css">
</head>
<body>
    <main class="row justify-content-center align-items-center">
        <div id="dpc">
            <div class="row">
                <div class="col">
                    <div id="numchamado">
                        <!--Passa as informações para imprimir na tela-->
                        <p>Numero Chamado: <?php echo $resultado['numero_chamado']; ?></p>
                    </div><br>
                    <div id= "infodemanda">
                        <div class="row">
                        <!--Passa as informações para imprimir na tela-->
                        <p><?php echo $resultado['nome_tipo']; ?></p>>
                        <p><?php echo $resultado['nome_categoria']; ?></p>>
                        <p><?php echo $resultado['nome_subcategoria']; ?></p>>
                        <p><?php echo $resultado['nome_item']; ?></p>
                        </div> <!--row-->
                    </div>
                    <div id="usuario">
                        <!--Passa as informações para imprimir na tela-->
                        <p>Numero Matricula: <?php echo $resultado['matricula']; ?></p>
                        <p>Nome: <?php echo $resultado['nome']; ?></p>
                        <p>Departamento: <?php echo $resultado['nome_departamento']; ?>
                        <p>Telefone: <?php echo $resultado['telefone']; ?></p>
                        <p>E-Mail: <?php echo $resultado['email']; ?></p>
                    </div><br><br><br><br>
                    <div id="descricao">
                        Descrição <br>
                        <?php echo $resultado['descricao']; ?>
                    </div>
                </div> <!--col-->
                <div class="col">
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
                    <input type="submit" value="Mover para sua fila">
                    </form>
                </div>
            </div> <!--row-->
        </div> <!--dpc-->
    </main>
</body>
</html>